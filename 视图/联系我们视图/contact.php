<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 获取网站配置('网站名称'); ?> - 联系我们</title>
    <link rel="stylesheet" href="/视图/联系我们视图/css/style.css">
</head>
<body>
    <header>
        <?php require_once ROOT_PATH . '/通用模块/导航栏/导航栏.php'; ?>
    </header>
    
    <main>
        <h1>联系我们</h1>

        <section class="contact-info">
            <h2>联系方式</h2>
            <p><strong>地址：</strong><?php echo 获取网站配置('地址'); ?></p>
            <p><strong>电话：</strong><?php echo 获取网站配置('联系电话'); ?></p>
            <p><strong>邮箱：</strong><?php echo 获取网站配置('联系邮箱'); ?></p>
        </section>

        <section class="contact-form">
            <h2>给我们留言</h2>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">姓名：</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">留言：</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">提交</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 <?php echo 获取网站配置('网站名称'); ?>. 保留所有权利。</p>
    </footer>

    <script src="/视图/联系我们视图/js/main.js"></script>
</body>
</html>

