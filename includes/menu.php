<?php
//get file path
$path = (empty($_GET["path"]) ? '' : trim($_GET['path']) );

//get page number
$page = (empty($_GET["page"]) or !is_numeric($_GET['page'])) ? 1 : trim($_GET['page']);

//get object id if it calls update page
$ID = (empty($_GET["objectID"]) ? '' : (int)$_GET['objectID'] );

$file = "view/dashboard.php";
$currentMenu = "dashboard";
switch($path){
     
    case "news":
        $file = "view/news.php";
        $currentMenu = "news";
        break;
    case "addNews":
    case "updateNews":
        $file = "forms/news.php";
        $currentMenu = "news";
        break;
   
    case "categories":
        $file = "view/categories.php";
        $currentMenu = "categories";
        break;
    case "addCategory":
    case "updateCategory":
        $file = "forms/category.php";
        $currentMenu = "categories";
        break;

    default:
        $file = "view/dashboard.php";
        $currentMenu = "dashboard";
}
?>
<div id="menu_tabs">
      <ul>
        <li><a href="index.php" class="<?php if($currentMenu == "dashboard")echo "current"; ?>"><span>Durum Paneli</span></a></li>
        <li><a href="index.php?path=news" class="<?php if($currentMenu == "products")echo "current"; ?>"><span>Haberler</span></a></li>
        <li><a href="index.php?path=categories" class="<?php if($currentMenu == "categories")echo "current"; ?>"><span>Kategoriler</span></a></li>
    </ul>
</div>