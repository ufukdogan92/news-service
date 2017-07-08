<?php include "../includes/autoload.php";
include "../includes/config.db.php";
include "../includes/functions.php";
$tb_current		= "news_category";
$date			= date("Y-m-d H:i:s");
$dataArr	    = $_POST['data'];
$dataID		 	= $_POST["dataID"];
$process     	= $_POST["process"];
if(isset($dataArr["status"]) and $dataArr["status"] == TRUE) $dataArr["status"] = 1; else $dataArr["status"] = 0;
switch($process) {
    case "add":
        $datas  = array(
            "category_name" => $dataArr["category_name"],
            "status" => $dataArr["status"],
        );
        $rowID 	= $mysql->insert($tb_current,$datas);
        if(!empty($rowID)){
            $res_arr 	= array("durum" => 1, "image" => "<script type='text/javascript'>window.location='index.php?path=updateCategory&objectID=$rowID'</script>");
        }else{
            $res_arr 	= array("durum" => 0,"image" => "<img title='İşlem Gerçekleştirilirken Hata Oluştu :(' src='images/icons/error.png' alt='' class='durum-icon' />");
        }
        echo json_encode($res_arr);
        break;
    case "update":
        if(empty($dataID)){
            $resArr 	= array("durum" => 0, "image" => "<img title='İşlem Gerçekleştirilirken Hata Oluştu :($dataID' src='images/icons/error.png' alt='' class='durum-icon' />");
            echo json_encode($resArr);
            exit;
        }
        foreach($dataArr as $val){
            $datas  = array(
                "category_name" => $dataArr["category_name"],
                "status" => $dataArr["status"]
            );
            $mysql->update($tb_current,$datas,"id = '$dataID'");
        }
        $resArr 	= array("durum" => 1, "image" => "<img title='İşlem Başarı İle Gerçekleştirildi :)' src='images/icons/success.png' alt='' class='durum-icon' />");
        echo json_encode($resArr);
        break;
    case "delete":
        $dataID		 = mysql_guvenlik($_POST["dataID"]);
        $result = $mysql->delete($tb_current,"id='$dataID'");
        if($result){
            echo "ok";
        }else{
            echo "-";
        }
        break;
}//switch	 */
//log kayıt
//include "process_log.php";
