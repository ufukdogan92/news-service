<?php if($pageCount > 1){ ?>
<a href="<?php echo $fileName;  if(!empty($getParentID))echo '&parentID='.$getParentID; ?>">İlk Sayfa</a>
|
 <a href="<?php if($page > 1){
     echo $fileName.'&page='.($page-1);
     if(!empty($getParentID))echo '&parentID='.$getParentID;
    }else{ echo "javascript:void(0);"; } ?>">Önceki Sayfa</a>
|
<select name="sayfa" id="sayfa"
           onchange="javascript:window.location='<?php echo $fileName; ?>&page='+this.value+'<?php if(!empty($getParentID))echo '&parentID='.$getParentID; ?>'">
	<?php 
		for($s=0; $s < $pageCount; $s++){
	?>
    <option value="<?php echo $s+1; ?>" <?php if($s+1 == $page)echo'selected="selected"'; ?>><?php echo $s+1; ?></option>
	<?php } ?>
</select>
|
 <a href="<?php if($page != ($pageCount)){
     echo $fileName.'&page='.($page+1);
     if(!empty($getParentID))echo '&parentID='.$getParentID;
    }else{ echo "javascript:void(0);"; } ?>">Sonraki Sayfa</a>
|
<a href="<?php echo $fileName.'&page='.($pageCount);  if(!empty($getParentID))echo '&parentID='.$getParentID; ?>">Son Sayfa</a>
<?php } ?>