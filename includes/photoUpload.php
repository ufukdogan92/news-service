<?php include "autoload.php";
include "config.db.php";
include "functions.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sayi = time();
    $path = $_FILES['file']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $table = $_GET["table"];
    $id = $_GET["id"];
    $tipi		=$_FILES['file']['type'];
    $klasor = "../../uploads/$table/";

    if($table == "albums") {
        $tableID = "albumID";
    }
    if($table == "contents") {
        $tableID = "contentID";
    }
    if($table == "products") {
        $tableID = "productID";
    }

    $title = $mysql->select("pro_$table"," $tableID = '$id'","","title");
    $datas  = array(
        "file" => "",
        "tableName" => $table,
        "table_id" => $id,
        "title" => $title[0]["title"]

    );

    $rowID 	= $mysql->insert("pro_photos",$datas);
    $adi = "$sayi-$id-$rowID.".$ext;

    $dizin = "../../uploads/$table/".$adi;
    $small = "../../uploads/$table/small-".$adi;
    $medium = "../../uploads/$table/medium-".$adi;
    if(move_uploaded_file($_FILES['file']['tmp_name'], "../../uploads/$table/$adi")){
        echo($_POST['index']);
        $say = $mysql->rowCount(DBPREFIX."photos","file = '$adi'");
        if($say < 1) {
            $resizeObj = new resize($dizin);

            $resizeObj -> resizeImage(800,600,'auto');
            $resizeObj -> saveImage($dizin);

            $resizeObj -> resizeImage(420,300,'crop');
            $resizeObj -> saveImage($small);

            $resizeObj -> resizeImage(220,220,'crop');
            $resizeObj -> saveImage($medium);

            $datas  = array(
                "file" => $adi

            );

            $rowID 	= $mysql->update("pro_photos",$datas," photoID = $rowID");
         }

    }
    exit;
}
exit;
?>