<?php

$back_path 	= "index.php?path=news";


$page_title = "Haber Ekle";

$process 		= "add";	if(!empty($ID)){

    $tb_current = "news";

    $rows = $mysql->select($tb_current,"id='$ID'");

    foreach($rows as $row){
        $title		 		= $row["title"];

        $def		 		= $row["def"];

        $text	 		= $row["text"];

        $status		 		= $row["status"];

        $categoryID		 	    = $row["category"];

        $authorID		 	    = $row["author"];
        $authorObj = new author();
        $authorObj->getAuthor($authorID);

        $video_url		 	    = $row["video_url"];
        $photo_album		 	    = $row["photo_album"];

        $created_date		 	    = $row["created_date"];    
    
    }		
    $page_title = "Haber Düzenle : ".$title;		
    $process 		= "update"; 	}
    ?>

    <form action="javascript:submit_form('controller/proNews.php','datas','');" id="datas" name="datas" method="post">
    <div class="mainbox-title">	<?php echo $page_title; ?></div>	<?php if($process == "edit"){ ?>    <div class="extra-tools">   
     	<a href="index.php?path=addProduct">Haber Ekle</a>    </div> 
            <?php } ?><script>var nesne_id = "<?php echo $ID; ?>";
            var table_name = "<?php echo $tb_current; ?>";</script>
            <h2 class="subheader"> Haber Bilgileri </h2>
    <div class="form-field">

        <label class="" for="product">Başlık :</label>

        <span class="input-helper">

            <input type="text" value="<?php if(isset($title))echo $title; ?>" class="input-text-large main-input"  size="55" id="title" name="data[title]">
            <input type="hidden" value="<?php if($ID)echo $ID; else echo 0; ?>" name="dataID" />
            <input type="hidden" value="<?php echo $process; ?>" name="process" />
     

    </div>

    <div class="form-field">

        <label class="" for="product">Video :</label>

        <span class="input-helper">

            <input type="text" value="<?php if(isset($video_url))echo $video_url; ?>" class="input-text-large main-input"  size="55" id="video_url" name="data[video_url]">

    </div>

    <div class="form-field">

        <label class="" for="product">Albüm :</label>

        <span class="input-helper">

            <input type="text" value="<?php if(isset($photo_album))echo $photo_album; ?>" class="input-text-large main-input"  size="55" id="photo_album" name="data[photo_album]">

    </div>



    <div class="form-field">

        <label class="" for="product">Ön Yazı :</label>

        <span class="input-helper">

            <input type="text" value="<?php if(isset($def))echo $def; ?>" class="input-text-large main-input"  size="55" id="def" name="data[def]">
 
    </div>


    <div class="form-field">

        <label class="" for="product">Kategori :</label>
        <select name="data[category]">
            <option value="0">Kategori Seçiniz</option>           
                <?php
                $tb_currentCat = "news_category";  
                            $rowsCat = $mysql->select($tb_currentCat," status = 1");
                                    foreach($rowsCat as $rowCat){ 
                                    $categoryTitle	= $rowCat["category_name"];                    
                                    $catID = $rowCat["id"];                    
    ?>                    
    <option <?php if(isset($categoryID) and $categoryID == $catID)
    { ?> selected="selected" <?php } ?>
        value="<?php echo $catID; ?>"><?php echo $categoryTitle; ?></option>
                        <?php } ?>            </select> 

        
 
    </div>

    



    <div class="form-field"> 
        <label class="" for="">Eklenme Tarihi :</label>
        <?php if(isset($created_date))echo $created_date; ?>
    </div>



    <div class="form-field"> 
        <label class="" for="">Yazar :</label>
        <?php if(isset($authorID))echo $authorObj->first_name; ?>
    </div>



    <div class="form-field">

        <label class="" for="icerik_aciklama">Haber:</label>



        <span class="input-helper">



            <textarea id="icerik_aciklama" name="data[text]" cols="55" rows="8" class="tinymce input-text-long"><?php if(isset($text))echo stripslashes($text); ?></textarea>



        </span>

    </div>

    <div class="form-field">
        <label class="" for="descr">Durum:</label>
        <span class="input-helper">
            <input type="checkbox" name="data[status]" <?php if(isset($status) and ($status==1) ) echo "checked"; ?>/>  
        </span>
    </div>


 	<?php include "includes/submit_buttons.php"; ?>    
 
</form>