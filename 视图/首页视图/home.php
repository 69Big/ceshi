<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 获取网站配置('网站名称'); ?> - 首页</title>
    <link rel="stylesheet" href="/视图/首页视图/css/style.css">
</head>
<body>
    <header>
        <?php require_once ROOT_PATH . '/通用模块/导航栏/导航栏.php'; ?>
    </header>
    
    <main>
        <section class="hero">
            <h1>欢迎来到<?php echo 获取网站配置('网站名称'); ?></h1>
            <p><?php echo 获取网站配置('网站描述'); ?></p>
        </section>

        <section class="latest-news">
            <h2>最新新闻</h2>
            <?php
            $最新新闻 = 执行查询("SELECT * FROM 新闻 ORDER BY 发布日期 DESC LIMIT 3");
            if ($最新新闻->num_rows > 0) {
                echo "<ul>";
                while ($新闻 = $最新新闻->fetch_assoc()) {
                    echo "<li>
                            <h3>{$新闻['标题']}</h3>
                            <p>{$新闻['内容']}</p>
                            <span class='date'>{$新闻['发布日期']}</span>
                          </li>";
                }
                echo "</ul>";
            } else {
                echo "<p>暂无新闻</p>";
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 <?php echo 获取网站配置('网站名称'); ?>. 保留所有权利。</p>
    </footer>

    <script src="/视图/首页视图/js/main.js"></script>
</body>
</html>

