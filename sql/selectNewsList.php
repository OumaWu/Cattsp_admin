<?php

require_once ("./Page.class.php");

$page = new Page("news", "id", 10, 1);

include("connection.php");

$url = $_SERVER["HTTP_REFERER"];


$sql = "SELECT news.id, news.title, news.date, news_category.title category "
        ."FROM `news`, `news_category` WHERE news.category = news_category.id "
        ."LIMIT {$page->offset},{$page->pageSize}";
try {
    $result = $pdo->prepare($sql);
    if ($result->execute()) {
    } else {
        echo "<script> alert('提取新闻列表失败！！\\n{$pdo->errorInfo()}');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0.5;url=$url\">";
    }
} catch (PDOException $e) {
    die("错误!!: " . $e->getMessage() . "<br>");
}

?>