<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - 页面未找到 - <?php echo 获取网站配置('网站名称'); ?></title>
    <link rel="stylesheet" href="/视图/404/css/style.css">
</head>
<body>
    <div class="error-container">
        <h1>404 - 页面未找到</h1>
        <p>抱歉，您请求的页面不存在。</p>
        <p><a href="?页面=home">返回首页</a></p>
    </div>
</body>
</html>

