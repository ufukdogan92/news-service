<div class="mainbox-title">
    Firma Bilgileri
    <div class="float-right">
    	<span class="action-add">
			<a href="index.php?path=addSetting">Bilgi Ekle</a>
		</span>
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
        <th width="20%">
            Başlık
        </th>
        <th width="10%" align="right"> İşlemler </th>
    </tr>
    <?php
    $tb_current = DBPREFIX."settings";
    $whereStr   = " 1 ";
    $fileName   = "?path=settings";
    include "includes/calculatePage.php";

    $rows = $mysql->select($tb_current,"$whereStr limit $startRow,$limit");
    foreach($rows as $row){
        $ID		 		= $row["settingID"];
        $title		 	= $row["title"];
        $descr		 	= $row["descr"];
        $update_path    = "index.php?path=updateSetting&objectID=".$ID;
        ?>
        <tr id="satir_<?php echo $ID; ?>">
            <td valign="middle">
                <?php echo $ID; ?>
            </td>
            <td valign="middle">
                <a class="strong" href="<?php echo $update_path; ?>"><?php echo $title; ?></a>
            </td>
            <td width="10%" align="right" valign="middle">
                <a href="<?php echo $update_path; ?>">Düzenle</a>
                |
                <a href="javascript:void(0);" onclick="javascript:deleteItem('proSetting','<?php echo $ID; ?>','');">Sil</a>
            </td>
        </tr>
    <?php } ?>
</table>
<div class="clear"></div>
<div class="table-tools">
    <?php include "includes/pagination.php"; ?>

</div>