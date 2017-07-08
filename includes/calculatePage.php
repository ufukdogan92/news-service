<?php
$pg = new pagination($page);

$rowCount = $mysql->rowCount($tb_current,$whereStr);
$limit    = PAGE_LIMIT;
$pageInfo = $pg->calculatePage($rowCount, $limit);
$startRow = $pageInfo['startRow'];
$pageCount = $pageInfo['pageCount'];