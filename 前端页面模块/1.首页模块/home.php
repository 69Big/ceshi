<?php
// ./前端页面模块/1.首页模块/home.php
// 首页模块 - 完全独立的模块
$page_title = '首页';
$page_description = '信泰新型建材有限公司 - 专业提供高质量建筑材料的领先企业';

// 获取数据库连接
$conn = getDbConnection();

// 检查连接是否成功
if (!$conn) {
    die("数据库连接失败");
}

// 获取轮播图数据
$slider_sql = "SELECT * FROM sliders WHERE status = 1 ORDER BY sort_order ASC LIMIT 5";
$slider_result = $conn->query($slider_sql);
$sliders = [];
if ($slider_result && $slider_result->num_rows > 0) {
    while($row = $slider_result->fetch_assoc()) {
        $sliders[] = $row;
    }
}

// 获取首页产品数据
$product_sql = "SELECT * FROM products WHERE featured = 1 AND status = 1 ORDER BY id DESC LIMIT 6";
$product_result = $conn->query($product_sql);
$featured_products = [];
if ($product_result && $product_result->num_rows > 0) {
    while($row = $product_result->fetch_assoc()) {
        $featured_products[] = $row;
    }
}

// 获取最新新闻
$news_sql = "SELECT * FROM news WHERE status = 1 ORDER BY created_at DESC LIMIT 3";
$news_result = $conn->query($news_sql);
$latest_news = [];
if ($news_result && $news_result->num_rows > 0) {
    while($row = $news_result->fetch_assoc()) {
        $latest_news[] = $row;
    }
}

// 关闭数据库连接
$conn->close();

// 加载头部
include_once 'includes/header.php';
?>

<!-- 轮播图部分 -->
<section class="hero-slider">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach($sliders as $key => $slider): ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo $key; ?>" <?php echo $key === 0 ? 'class="active"' : ''; ?>></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach($sliders as $key => $slider): ?>
            <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
                <img src="<?php echo SITE_URL . $slider['image']; ?>" class="d-block w-100" alt="<?php echo $slider['title']; ?>">
                <div class="carousel-caption">
                    <h2><?php echo $slider['title']; ?></h2>
                    <p><?php echo $slider['description']; ?></p>
                    <?php if(!empty($slider['button_text'])): ?>
                    <a href="<?php echo $slider['button_link']; ?>" class="btn btn-primary"><?php echo $slider['button_text']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- 关于我们简介 -->
<section class="about-intro py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <h2 class="section-title">关于信泰新型建材</h2>
                    <p>信泰新型建材有限公司是一家专业从事新型建筑材料研发、生产和销售的企业。公司致力于为全球客户提供高品质、环保、节能的建筑材料解决方案。</p>
                    <p>我们拥有先进的生产设备和技术团队，产品远销欧美、东南亚等多个国家和地区，深受客户好评。</p>
                    <a href="<?php echo SITE_URL; ?>/about" class="btn btn-primary">了解更多</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="<?php echo SITE_URL; ?>/assets/images/about-home.jpg" alt="关于信泰新型建材" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 产品展示 -->
<section class="featured-products py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">精选产品</h2>
            <p>我们提供多种高品质建筑材料，满足您的各种需求</p>
        </div>
        <div class="row">
            <?php if(empty($featured_products)): ?>
                <div class="col-12 text-center">
                    <p>暂无产品数据</p>
                </div>
            <?php else: ?>
                <?php foreach($featured_products as $product): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="<?php echo SITE_URL; ?>/product?id=<?php echo $product['id']; ?>">
                                <img src="<?php echo SITE_URL . $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3><a href="<?php echo SITE_URL; ?>/product?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h3>
                            <p><?php echo substr($product['description'], 0, 100) . '...'; ?></p>
                            <a href="<?php echo SITE_URL; ?>/product?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">查看详情</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/products" class="btn btn-primary">查看全部产品</a>
        </div>
    </div>
</section>

<!-- 公司优势 -->
<section class="features py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">我们的优势</h2>
            <p>为什么选择信泰新型建材</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box text-center">
                    <div class="feature-icon">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h3>品质保证</h3>
                    <p>严格的质量控制体系，确保每一件产品都符合国际标准</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box text-center">
                    <div class="feature-icon">
                        <i class="fa fa-flask"></i>
                    </div>
                    <h3>技术创新</h3>
                    <p>持续研发新技术，不断推出更环保、更高效的产品</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box text-center">
                    <div class="feature-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <h3>全球服务</h3>
                    <p>完善的销售网络，为全球客户提供及时、专业的服务</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box text-center">
                    <div class="feature-icon">
                        <i class="fa fa-leaf"></i>
                    </div>
                    <h3>环保节能</h3>
                    <p>所有产品符合环保标准，助力绿色建筑发展</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 最新新闻 -->
<section class="latest-news py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">最新资讯</h2>
            <p>了解我们的最新动态和行业资讯</p>
        </div>
        <div class="row">
            <?php if(empty($latest_news)): ?>
                <div class="col-12 text-center">
                    <p>暂无新闻数据</p>
                </div>
            <?php else: ?>
                <?php foreach($latest_news as $news): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="news-card">
                        <div class="news-image">
                            <a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $news['id']; ?>">
                                <img src="<?php echo SITE_URL . $news['image']; ?>" alt="<?php echo $news['title']; ?>" class="img-fluid">
                            </a>
                        </div>
                        <div class="news-info">
                            <div class="news-date"><?php echo date('Y-m-d', strtotime($news['created_at'])); ?></div>
                            <h3><a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a></h3>
                            <p><?php echo substr($news['content'], 0, 100) . '...'; ?></p>
                            <a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $news['id']; ?>" class="read-more">阅读更多</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/news" class="btn btn-primary">查看全部新闻</a>
        </div>
    </div>
</section>

<!-- 合作伙伴 -->
<section class="partners py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">合作伙伴</h2>
            <p>我们与全球知名企业建立了长期稳定的合作关系</p>
        </div>
        <div class="partner-logos">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="partner-logo">
                        <img src="<?php echo SITE_URL; ?>/assets/images/partners/partner1.png" alt="Partner 1" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="partner-logo">
                        <img src="<?php echo SITE_URL; ?>/assets/images/partners/partner2.png" alt="Partner 2" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="partner-logo">
                        <img src="<?php echo SITE_URL; ?>/assets/images/partners/partner3.png" alt="Partner 3" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="partner-logo">
                        <img src="<?php echo SITE_URL; ?>/assets/images/partners/partner4.png" alt="Partner 4" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="partner-logo">
                        <img src="<?php echo SITE_URL; ?>/assets/images/partners/partner5.png" alt="Partner 5" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="partner-logo">
                        <img src="<?php echo SITE_URL; ?>/assets/images/partners/partner6.png" alt="Partner 6" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// 加载底部
include_once 'includes/footer.php';
?>

