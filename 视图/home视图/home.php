<?php
echo "<!-- 调试：正在加载首页内容 -->\n";
?>
<section class="hero-section d-flex align-items-center">
    <div class="container text-white">
        <h1 class="display-4">欢迎来到<?= 获取网站配置('公司名称') ?></h1>
        <p class="lead">我们致力于提供最优质的科技解决方案</p>
        <a href="/?页面=products" class="btn btn-primary btn-lg">查看产品</a>
    </div>
</section>

<section class="container my-5">
    <h2 class="text-center mb-4">我们的优势</h2>
    <div class="row">
        <div class="col-md-4 text-center">
            <h3>创新技术</h3>
            <p>采用最新技术，保持行业领先</p>
        </div>
        <div class="col-md-4 text-center">
            <h3>专业团队</h3>
            <p>经验丰富的技术团队</p>
        </div>
        <div class="col-md-4 text-center">
            <h3>优质服务</h3>
            <p>7*24小时客户支持</p>
        </div>
    </div>
</section>
<?php
echo "<!-- 调试：首页内容加载完成 -->\n";
?>