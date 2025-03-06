<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 获取网站配置('网站名称'); ?> - 产品列表</title>
    <link rel="stylesheet" href="/视图/产品列表视图/css/style.css">
</head>
<body>
    <header>
        <?php require_once ROOT_PATH . '/通用模块/导航栏/导航栏.php'; ?>
    </header>
    
    <main>
        <h1>产品列表</h1>

        <div class="product-grid">
            <?php
            $产品列表 = 执行查询("SELECT * FROM 产品");
            if ($产品列表->num_rows > 0) {
                while ($产品 = $产品列表->fetch_assoc()) {
                    echo "<div class='product-card'>
                            <img src='{$产品['图片']}' alt='{$产品['名称']}'>
                            <h2>{$产品['名称']}</h2>
                            <p>{$产品['描述']}</p>
                            <p class='price'>￥{$产品['价格']}</p>
                            <button>了解更多</button>
                          </div>";
                }
            } else {
                echo "<p>暂无产品</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 <?php echo 获取网站配置('网站名称'); ?>. 保留所有权利。</p>
    </footer>

    <script src="/视图/产品列表视图/js/main.js"></script>
</body>
</html>

