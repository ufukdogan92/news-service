/* 
 2012
*/

$(document).ready(function(){
 
	
});//ready


function trim(s) {
    return s.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}
 
function logOut(){
	$(function(){
		 
		$.ajax({
			url:"controller/proLogout.php",
			data:"",
			type:"post",
			success:function(c){
				window.location.reload();
			}	
		});
	});//ready	
}
function submit_form(islem_sayfasi,form_id,req_elms){
	$(function(){   
		$("#form-loader").html("<img src='images/loader.gif' alt='' style='width:25px;' />");
		$.ajax({
			type: "POST",
			url: islem_sayfasi,
			data: $("#"+form_id).serialize(),
			dataType:"json",		   
			success: function(cvp){	 
			 $("#form-loader").html(cvp.image);  
			}
		});
	});
}

function resim_sil(sayfa_adi,id,div_id){
	if(!id){
		alert("Resim Silinirken Hata Oluştu!");	
		return false;	
	}
	$.prompt("Resmi silmek istediğinizden emin misiniz?",{ 
			buttons:{Sil:true, Çıkış:false},
			callback: function(v,m,f){	
				if(v){	 	
				    $.ajax({
				    type: "POST",
				  	url: 'islemler/'+sayfa_adi+'.php',
					data: "islem=resim_sil&id="+id,		   
					success: function(cvp){		 
						if(trim(cvp) == "ok") 
							$(div_id).remove();
						else
							alert("Kayıt Silinirken Hata Oluştu!");				       	
					  	}
					});
				}else{
				//hayır ise yapılacaklar
				}
			}//if v
		});
		$("#jqi").css({'height':"auto" , "overflow":"hidden"});
}

function deleteItem(page,id){
	if(!id){
		alert("Kayıt Silinirken Hata Oluştu!");	
		return false;	
	}
	$.prompt("Kaydı silmek istediğinizden emin misiniz?",{ 
			buttons:{Sil:true, Çıkış:false},
			submit: function(e,v){
				if(v){	 	
				    $.ajax({
				    type: "POST",
				  	url: 'controller/'+page+'.php',
					data: "process=delete&dataID="+id,
					success: function(cvp){		 
						if(trim(cvp) == "ok") 
							$('#satir_'+id).remove();
						else
							alert("Kayıt Silinirken Hata Oluştu!");				       	
					  	}
					});
				}else{
				//hayır ise yapılacaklar
				}
			}//if v
		});
		$("#jqi").css({'height':"auto" , "overflow":"hidden"});
}
function form_temizle(form_adi){
	document.getElementById(form_adi).reset();
}

 
 
function input_ekle(class_tutamac){
	$(function(){	 
	var sayi = $('p[class^="'+class_tutamac+'"]').length;
	$('p[class^="'+class_tutamac+'"]:last').after('<script type="text/javascript"> $( "#odeme_tarihi'+(sayi+1)+'" ).datepicker(); </script><p class="'+class_tutamac+'"><label style="cursor:pointer;">Ödeme '+(sayi+1)+', tarih:<input type="text" class="odeme_tarihi" id="odeme_tarihi'+(sayi+1)+'" name="odeme_tarihi[]" /></label><input class="text-input small-input" type="text" id="odeme'+(sayi+1)+'" name="odeme[]" /> TL</p>');
	});
}//input_ekle
  
 
 
function pencere_ac(form_dosyasi,form_id,id,islem_dosyasi){ 
var dzn_id = id;
var DUZENLE_FORM_LABEL = "<div id='form_alan'>Yükleniyor...</div>"; 
		$.ajax({ //formu Yükle
				type: "POST", 
				url:  "formlar/"+form_dosyasi, 
				data: "id="+dzn_id,		    
				success: function(c){	 
					$("#form_alan").html(trim(c)); 
				} 
		});//ajax 
//pencere
$.prompt( 
	DUZENLE_FORM_LABEL
	,
	{  
		buttons: { Kaydet:true, Çıkış: false } , 
		submit:function(snc){
			if(snc == true){
			$.ajax({ //kayıt düznle
				type: "POST", 
				url: 'islemler/'+islem_dosyasi, 
				data: $("#"+form_id).serialize(),		    
				success: function(cvp){	  
					 window.location.reload();
				   } //success
				   
				});
			}//snc  
		}//submit  
	}); 
//pencere	
}

 