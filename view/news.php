<?php

$catID = !empty($_GET['catID'])
    ? (int)$_GET['catID']
    : ''; 

$catStrID = !empty($_GET['catID'])
    ? 'category = '.(int)$_GET['catID']
    : ' 1 ';
?>
<div class="mainbox-title">
    Haberler
    <div class="float-right">
    	<span class="action-add">
			<a href="index.php?path=addNews">Haber Ekle</a>
             |
            <a href="index.php?path=addCategory&tableName=news">Kategori Ekle</a>
            |
            <a href="index.php?path=categories&tableName=news">Haber Kategorileri</a>
		</span>
    </div>
</div>
<div id="catSelect">
    <div id="catTitle"> Kategori Seç: </div>
    <div id="catSel">
        <select onchange="javascript:document.location.replace('?path=news&catID='+this.value);" name="catID">
            <option value="">Kategori Seç </option>
            <?php
            $tb_currentCat = "news_category";
            $rowsCat = $mysql->select($tb_currentCat," status = 1 ");
            foreach($rowsCat as $rowCat){
                $categoryTitle	= $rowCat["category_name"];
                $categoryID = $rowCat["id"];
                ?>
                <option value="<?php echo $categoryID; ?>"><?php echo $categoryTitle; ?></option>
            <?php } ?>
        </select>
    </div>
    <div id="aktifCat">
        <?php
        if(!empty($catID)) {
            $tb_currentCat2 = "news_category";
            $rowsCat2 = $mysql->select($tb_currentCat2," id = $catID ");
            foreach($rowsCat2 as $rowCat2){
                $categoryTitle2	= $rowCat2["category_name"];
                ?>
                aktif : <font style="color: #900"><?php echo $categoryTitle2; ?></font>
            <?php }  }?>
    </div>
</div>
<div class="extra-tools" style="color:#999;">
</div>
<br />
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table">
    <tr>
        <th width="5%">
            No
        </th>
        <th width="40%">
            Başlık
        </th>
        <th width="30%">
            Kategori
        </th>
       
        <th width="10%" align="right"> İşlemler </th>
    </tr>
    <?php
    $tb_current = "news";
    $whereStr   = $catStrID;
    $fileName   = "?path=news";
    if(!empty($catID))
        $fileName   .= "&catID=".$catID;
    include "includes/calculatePage.php";
    $rows   = $mysql->select($tb_current,"$whereStr limit $startRow,$limit");
    foreach($rows as $row){
        $ID		 		= $row["id"];
        $title		 	= $row["title"];
        $author		 	= $row["author"];
        $created_date		 	= $row["created_date"];
        $categoryID		 	= $row["category"];
        $update_path    = "index.php?path=updateNews&objectID=".$ID;  
        ?>
        <tr id="satir_<?php echo $ID; ?>">
            <td valign="middle">
                <?php echo $ID; ?>
            </td>
            <td valign="middle">
                <a class="strong" href="<?php echo $update_path; ?>"><?php echo $title; ?></a>
            </td>
            <td valign="middle">
                <?php
                $tb_currentCat = "news_category";
                $rowsCat = $mysql->select($tb_currentCat," id = $categoryID");
                echo $rowsCat[0]["category_name"]; 
                ?>
            </td>
           
            <td width="20%" align="right" valign="middle">
                <a href="<?php echo $update_path; ?>">Düzenle</a>
                | 
                <a href="javascript:void(0);" onclick="javascript:deleteItem('proNews','<?php echo $ID; ?>','');">Sil</a>
            </td>
        </tr>
    <?php } ?>
</table>
<div class="clear"></div>
<div class="table-tools">
    <?php include "includes/pagination.php"; ?>
</div>