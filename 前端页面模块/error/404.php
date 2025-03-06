<?php
// 404错误页面模块 - 完全独立的模块
$page_title = '页面未找到';
$page_description = '您访问的页面不存在';

// 加载头部
include_once 'includes/header.php';
?>

<!-- 404内容 -->
<section class="error-404 py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="error-content">
                    <h1 class="error-title">404</h1>
                    <h2 class="error-subtitle">页面未找到</h2>
                    <p class="error-text">抱歉，您访问的页面不存在或已被移除。</p>
                    <a href="<?php echo SITE_URL; ?>/home" class="btn btn-primary">返回首页</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// 加载底部
include_once 'includes/footer.php';
?>

