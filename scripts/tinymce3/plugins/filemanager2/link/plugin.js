/**
 * plugin.js
 *
 * Copyright, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/*global tinymce:true */

tinymce.PluginManager.add('link', function(editor) {
    function openmanager() {
        var win, data, dom = editor.dom,
        imgElm = editor.selection.getNode();
        var width, height, imageListCtrl;
	var title="RESPONSIVE FileManager";
        if (typeof tinymce.settings.filemanager_title !== "undefined" && tinymce.settings.filemanager_title) {
            title=tinymce.settings.filemanager_title;
        }
        win = editor.windowManager.open({
            title: title,
            data: data,
            classes: 'filemanager',
            file: tinyMCE.baseURL + '/plugins/filemanager/dialog.php?type=2&editor=' + editor.id + '&lang=' + tinymce.settings.language,
            filetype: 'file',
            width: 900,
            height: 600,
            inline: 1
        })
    }
	function createLinkList(callback) {
		return function() {
			var linkList = editor.settings.link_list;

			if (typeof(linkList) == "string") {
				tinymce.util.XHR.send({
					url: linkList,
					success: function(text) {
						callback(tinymce.util.JSON.parse(text));
					}
				});
			} else {
				callback(linkList);
			}
		};
	}

	function showDialog(linkList) {
		var data = {}, selection = editor.selection, dom = editor.dom, selectedElm, anchorElm, initialText;
		var win, linkListCtrl, relListCtrl, targetListCtrl;

		function linkListChangeHandler(e) {
			var textCtrl = win.find('#text');

			if (!textCtrl.value() || (e.lastControl && textCtrl.value() == e.lastControl.text())) {
				textCtrl.value(e.control.text());
			}

			win.find('#href').value(e.control.value());
		}

		function buildLinkList() {
			var linkListItems = [{text: 'None', value: ''}];

			tinymce.each(linkList, function(link) {
				linkListItems.push({
					text: link.text || link.title,
					value: link.value || link.url,
					menu: link.menu
				});
			});

			return linkListItems;
		}

		function buildRelList(relValue) {
			var relListItems = [{text: 'None', value: ''}];

			tinymce.each(editor.settings.rel_list, function(rel) {
				relListItems.push({
					text: rel.text || rel.title,
					value: rel.value,
					selected: relValue === rel.value
				});
			});

			return relListItems;
		}

		function buildTargetList(targetValue) {
			var targetListItems = [{text: 'None', value: ''}];

			if (!editor.settings.target_list) {
				targetListItems.push({text: 'New window', value: '_blank'});
			}

			tinymce.each(editor.settings.target_list, function(target) {
				targetListItems.push({
					text: target.text || target.title,
					value: target.value,
					selected: targetValue === target.value
				});
			});

			return targetListItems;
		}

		function buildAnchorListControl(url) {
			var anchorList = [];

			tinymce.each(editor.dom.select('a:not([href])'), function(anchor) {
				var id = anchor.name || anchor.id;

				if (id) {
					anchorList.push({
						text: id,
						value: '#' + id,
						selected: url.indexOf('#' + id) != -1
					});
				}
			});

			if (anchorList.length) {
				anchorList.unshift({text: 'None', value: ''});

				return {
					name: 'anchor',
					type: 'listbox',
					label: 'Anchors',
					values: anchorList,
					onselect: linkListChangeHandler
				};
			}
		}

		function updateText() {
			if (!initialText && data.text.length === 0) {
				this.parent().parent().find('#text')[0].value(this.value());
			}
		}

		selectedElm = selection.getNode();
		anchorElm = dom.getParent(selectedElm, 'a[href]');

		data.text = initialText = anchorElm ? (anchorElm.innerText || anchorElm.textContent) : selection.getContent({format: 'text'});
		data.href = anchorElm ? dom.getAttrib(anchorElm, 'href') : '';
		data.target = anchorElm ? dom.getAttrib(anchorElm, 'target') : '';
		data.rel = anchorElm ? dom.getAttrib(anchorElm, 'rel') : '';

		if (selectedElm.nodeName == "IMG") {
			data.text = initialText = " ";
		}

		if (linkList) {
			linkListCtrl = {
				type: 'listbox',
				label: 'Link list',
				values: buildLinkList(),
				onselect: linkListChangeHandler
			};
		}

		if (editor.settings.target_list !== false) {
			targetListCtrl = {
				name: 'target',
				type: 'listbox',
				label: 'Target',
				values: buildTargetList(data.target)
			};
		}

		if (editor.settings.rel_list) {
			relListCtrl = {
				name: 'rel',
				type: 'listbox',
				label: 'Rel',
				values: buildRelList(data.rel)
			};
		}
                var clean_id=editor.id.replace('[','').replace(']','');
		win = editor.windowManager.open({
			title: 'Insert link',
			data: data,
            body: [{
                type: 'container',
                layout: 'flex',
                classes: 'combobox has-open',
                label: 'Source',
                direction: 'row',
                align: 0,
                items: [{
                    name: 'href',
                    type: 'textbox',
                    filetype: 'file',
                    size: 35,
                    classes: 'link_' + clean_id,
                    autofocus: true,
                    label: 'Url',
                    onchange: updateText,
                    onkeyup: updateText
                }, {
                    name: 'upl_img',
                    type: 'button',
                    classes: 'btn open',
                    icon: 'browse',
                    onclick: openmanager,
                    tooltip: 'Select file'
                }]
            } , {name: 'text', type: 'textbox', classes: 'text_' + clean_id, size: 40, label: 'Text to display', onchange: function() {
					data.text = this.value();
				}},
				buildAnchorListControl(data.href),
				linkListCtrl,
				relListCtrl,
				targetListCtrl
			],
			onSubmit: function(e) {
				var data = e.data, href = data.href;

				// Delay confirm since onSubmit will move focus
				function delayedConfirm(message, callback) {
					window.setTimeout(function() {
						editor.windowManager.confirm(message, callback);
					}, 0);
				}

				function insertLink() {
                                    console.log(data.text);
					if (data.text != initialText) {
						if (anchorElm) {
							editor.focus();
							anchorElm.innerHTML = data.text;

							dom.setAttribs(anchorElm, {
								href: href,
								target: data.target ? data.target : null,
								rel: data.rel ? data.rel : null
							});

							selection.select(anchorElm);
						} else {
							editor.insertContent(dom.createHTML('a', {
								href: href,
								target: data.target ? data.target : null,
								rel: data.rel ? data.rel : null
							}, data.text));
						}
					} else {
						editor.execCommand('mceInsertLink', false, {
							href: href,
							target: data.target,
							rel: data.rel ? data.rel : null
						});
					}
				}

				if (!href) {
					editor.execCommand('unlink');
					return;
				}

				// Is email and not //user@domain.com
				if (href.indexOf('@') > 0 && href.indexOf('//') == -1 && href.indexOf('mailto:') == -1) {
					delayedConfirm(
						'The URL you entered seems to be an email address. Do you want to add the required mailto: prefix?',
						function(state) {
							if (state) {
								href = 'mailto:' + href;
							}

							insertLink();
						}
					);

					return;
				}

				// Is www. prefixed
				if (/^\s*www\./i.test(href)) {
					delayedConfirm(
						'The URL you entered seems to be an external link. Do you want to add the required http:// prefix?',
						function(state) {
							if (state) {
								href = 'http://' + href;
							}

							insertLink();
						}
					);

					return;
				}

				insertLink();
			}
		});
	}

	editor.addButton('link', {
		icon: 'link',
		tooltip: 'Insert/edit link',
		shortcut: 'Ctrl+K',
		onclick: createLinkList(showDialog),
		stateSelector: 'a[href]'
	});

	editor.addButton('unlink', {
		icon: 'unlink',
		tooltip: 'Remove link',
		cmd: 'unlink',
		stateSelector: 'a[href]'
	});

	editor.addShortcut('Ctrl+K', '', createLinkList(showDialog));

	this.showDialog = showDialog;

	editor.addMenuItem('link', {
		icon: 'link',
		text: 'Insert link',
		shortcut: 'Ctrl+K',
		onclick: createLinkList(showDialog),
		stateSelector: 'a[href]',
		context: 'insert',
		prependToContext: true
	});
});

