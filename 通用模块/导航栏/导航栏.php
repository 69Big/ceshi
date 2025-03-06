<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <!-- 网站品牌标识 -->
        <a class="navbar-brand" href="?page=home">
            <img src="https://via.placeholder.com/50" alt="<?php echo 获取网站配置('网站名称'); ?>" width="30" height="30" class="d-inline-block align-top me-2">
            <?php echo 获取网站配置('网站名称'); ?>
        </a>
        <!-- 移动端导航按钮 -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- 导航链接列表 -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'home')? 'active': ''; ?>" href="?page=home">
                        <i class="fas fa-home me-2"></i>首页
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'products')? 'active': ''; ?>" href="?page=products">
                        <i class="fas fa-box me-2"></i>产品列表
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'about')? 'active': ''; ?>" href="?page=about">
                        <i class="fas fa-info-circle me-2"></i>关于我们
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'contact')? 'active': ''; ?>" href="?page=contact">
                        <i class="fas fa-envelope me-2"></i>联系我们
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
