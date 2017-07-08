<?php
$back_path 	= "index.php?path=categories";
$tb_current = "news_category";
$page_title = "Kategori Ekle";
 
$process 		= "add";
if(!empty($ID)){
    $rows = $mysql->select($tb_current,"id='$ID'");
    foreach ($rows as $row) {
        $title	= $row['category_name'];
        $status	= $row['status'];
    }
    $page_title = "Kategori Düzenle : ".$title;
    $process 		= "update";
}
?>
<div class="mainbox-title">
    <?php echo $page_title; ?>
</div>
<?php if($process == "update"){ ?>
    <div class="extra-tools">
        <a href="index.php?path=addCategory">Yeni Kategori Ekle</a>
    </div>
<?php } ?>

<form action="javascript:submit_form('controller/proCategory.php','datas','');" id="datas" name="datas" method="post">
    <input type="hidden" value="<?php echo $process; ?>" name="process" />
    <input type="hidden" value="<?php if($ID)echo $ID; else echo 0; ?>" name="dataID" />
    <h2 class="subheader"> Kategori Bilgileri </h2>

    <div>
        <div class="form-field">
            <label class="" for="category_name">Başlık:</label>
            <span class="input-helper">
            <input type="text" value="<?php if(isset($title))echo $title; ?>" class="input-text-large main-input" size="55" id="category_name" name="data[category_name]" />
            </span>
        </div>

        <div class="form-field">
            <label class="" for="descr">Durum:</label>
            <span class="input-helper">
                <input type="checkbox" name="data[status]" <?php if(isset($status) and ($status==1) ) echo "checked"; ?>/>  
            </span>
        </div>
    </div>
    <?php include "includes/submit_buttons.php"; ?>
</form>