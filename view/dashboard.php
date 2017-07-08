<?php 

$catCount 	= $mysql->rowCount("news_category",'');
$newsCount 	= $mysql->rowCount("news",'');
$authorCount 	= $mysql->rowCount("author",'');

?>
<div class="mainbox-title">Durum Paneli</div>
<br />
<table id="" width="100%">
	<tr>
    	<td>
            <div class="statistics-box">
                <h2>Haber Bilgisi</h2>
                <?php if($newsCount > 0 ){ ?>
                	<p class="dashbaorditem">Sisteme kayıtlı <span class="dashboard_number_format"><?php echo $newsCount; ?></span> haber bulunmaktadır.</p>
                <?php }else{ ?>
                	<p class="no-items">Haber Bulunamadı</p> 
                <?php } ?>
            </div>
        </td>
        <td>    	
        <div class="statistics-box">
            <h2>Yazar Bilgisi</h2>
                <?php if($authorCount > 0 ){ ?>
                	<p class="dashbaorditem">Sisteme kayıtlı <span class="dashboard_number_format"><?php echo $authorCount; ?></span> yazar bulunmaktadır.</p>
                <?php }else{ ?>
                	<p class="no-items">Yazar Bulunamadı</p> 
                <?php } ?>
        </div>	
		</td>
     </tr>
	<tr>
    	<td colspan="2">
            <div class="statistics-box">
                <h2>Haber Kategorisi Bilgisi</h2>
                <?php if($catCount > 0 ){ ?>
                	<p class="dashbaorditem">Sisteme kayıtlı <span class="dashboard_number_format"><?php echo $catCount; ?></span> haber kaktegorisi bulunmaktadır.</p>
                <?php }else{ ?>
                	<p class="no-items">Kategori Bulunamadı</p>
                <?php } ?>
            </div>
        </td>
     </tr>


    <?php /*?>

     <tr>
    	<td>   
        <div class="statistics-box">
            <h2>Ürün Sayısı</h2>
                <?php if($urun_sayisi > 0 ){ ?>
                	<p class="dashbaorditem">Sisteme Kayıtlı <span class="dashboard_number_format"><?php echo $urun_sayisi; ?></span> urun bulunmaktadır.</p>
                <?php }else{ ?>
                	<p class="no-items">Ürün Bulunamadı</p> 
                <?php } ?>
        </div>	
    </td>
    <td>
        <div class="statistics-box">
            <h2>Diller</h2>
                <?php if($dil_sayisi > 0 ){ ?>
                	<p class="dashbaorditem">Sistemde <span class="dashboard_number_format"><?php echo $dil_sayisi; ?></span> farklı dil bulunmaktadır.<br />
               
                    <?php 
						for($i=0; $i < $dil_sayisi; $i++){
							$dil_adi = $mysql->get_data("isim",$i);							
							$dil_drm = $mysql->get_data("durum",$i);
					?>
                    	<span class="dashbaorditem"><?php echo $i+1; ?>) <?php echo $dil_adi; if($dil_drm == "Y")echo "(varsayılan)"; ?> </span> <br />
					<?php } ?>             
                     </p>       
                <?php }else{ ?>
                	<p class="no-items">Ürün Bulunamadı</p> 
                <?php } ?>
        </div>	
     </td>
	 
  </tr><?php */?>
 <!-- <tr>	
    <td colspan="2">
        <div class="statistics-box">
        <h2>Kısayollar</h2>
        <p class="no-items">Haber Bulunamadı</p>
        </div>	
    </td>
  </tr> --> 
</table>   
    <div class="clear"></div>