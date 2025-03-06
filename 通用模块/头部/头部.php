<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 获取网站配置('网站名称') ?> - <?= $pageTitle ?? '首页' ?></title>
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/"><?= 获取网站配置('网站名称') ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'home' ? 'active' : '' ?>" href="/?页面=home">首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'about' ? 'active' : '' ?>" href="/?页面=about">关于我们</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'products' ? 'active' : '' ?>" href="/?页面=products">产品展示</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'contact' ? 'active' : '' ?>" href="/?页面=contact">联系我们</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>