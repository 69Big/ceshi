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
        <section class="hero bg-light text-center py-5">
            <div class="container">
                <h1 class="display-4">欢迎来到<?php echo 获取网站配置('网站名称'); ?></h1>
                <p class="lead"><?php echo 获取网站配置('网站描述'); ?></p>
                <a href="#" class="btn btn-primary btn-lg">了解更多</a>
            </div>
        </section>

        <section class="latest-news container my-5">
            <h2 class="mb-4">最新新闻</h2>
            <?php
            $最新新闻 = 执行查询("SELECT * FROM 新闻 ORDER BY 发布日期 DESC LIMIT 3");
            if ($最新新闻->num_rows > 0) {
                echo '<div class="row">';
                while ($新闻 = $最新新闻->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">'.$新闻['标题'].'</h3>
                                    <p class="card-text">'.$新闻['内容'].'</p>
                                    <span class="date text-muted">'.$新闻['发布日期'].'</span>
                                </div>
                            </div>
                          </div>';
                }
                echo '</div>';
            } else {
                echo '<p class="text-center">暂无新闻</p>';
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> <?php echo 获取网站配置('网站名称'); ?>. 保留所有权利。</p>
    </footer>

    <script src="/视图/首页视图/js/main.js"></script>
</body>
</html>
