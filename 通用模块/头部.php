<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 获取网站配置('网站名称'); ?> - <?php echo ucfirst($页面); ?></title>
    <link rel="stylesheet" href="/视图/通用/css/style.css">
    <link rel="stylesheet" href="/视图/<?php echo $页面; ?>视图/css/style.css">
</head>
<body>
    <header>
        <?php require_once ROOT_PATH . '/通用模块/导航栏/导航栏.php'; ?>
    </header>
    <main>

