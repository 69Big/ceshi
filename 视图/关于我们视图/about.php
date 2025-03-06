<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 获取网站配置('网站名称'); ?> - 关于我们</title>
    <link rel="stylesheet" href="/视图/关于我们视图/css/style.css">
</head>
<body>
    <header>
        <?php require_once ROOT_PATH . '/通用模块/导航栏/导航栏.php'; ?>
    </header>
    
    <main>
        <h1>关于我们</h1>

        <section class="company-intro">
            <h2>公司简介</h2>
            <p>南国鼎峰是一家专注于创新科技的领先企业,致力于为客户提供高质量的产品和服务。我们的使命是通过技术创新改善人们的生活质���,为社会创造更大的价值。</p>
        </section>

        <section class="team">
            <h2>我们的团队</h2>
            <div class="team-grid">
                <?php
                $团队成员 = 执行查询("SELECT * FROM 团队成员");
                if ($团队成员->num_rows > 0) {
                    while ($成员 = $团队成员->fetch_assoc()) {
                        echo "<div class='team-member'>
                                <img src='{$成员['照片']}' alt='{$成员['姓名']}'>
                                <h3>{$成员['姓名']}</h3>
                                <p class='position'>{$成员['职位']}</p>
                                <p>{$成员['简介']}</p>
                              </div>";
                    }
                } else {
                    echo "<p>暂无团队成员信息</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 <?php echo 获取网站配置('网站名称'); ?>. 保留所有权利。</p>
    </footer>

    <script src="/视图/关于我们视图/js/main.js"></script>
</body>
</html>

