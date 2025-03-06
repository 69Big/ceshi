<?php
require_once __DIR__ . '/../../通用模块/配置/网站配置.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?= 获取网站配置('网站名称') ?> - 首页</title>
    <link rel="stylesheet" href="/通用模块/导航栏/css/style.css">
    <link rel="stylesheet" href="/视图/首页视图/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../../通用模块/导航栏/导航栏.php'; ?>
    
    <main class="home-main">
        <section class="hero-banner">
            <div class="hero-content">
                <h1>创新驱动未来</h1>
                <p>专业科技解决方案提供商</p>
                <a href="/contact" class="cta-button">立即咨询</a>
            </div>
        </section>

        <section class="feature-section">
            <div class="feature-grid">
                <div class="feature-card">
                    <img src="/public/icons/chip.svg" alt="芯片技术">
                    <h3>核心科技</h3>
                    <p>自主研发的芯片技术解决方案</p>
                </div>
                <div class="feature-card">
                    <img src="/public/icons/cloud.svg" alt="云服务">
                    <h3>云端智能</h3>
                    <p>安全可靠的云计算服务平台</p>
                </div>
                <div class="feature-card">
                    <img src="/public/icons/ai.svg" alt="人工智能">
                    <h3>AI赋能</h3>
                    <p>行业领先的人工智能解决方案</p>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../../通用模块/底部.php'; ?>
</body>
</html>