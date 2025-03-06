<?php
// 新闻列表模块 - 完全独立的模块
$page_title = '新闻资讯';
$page_description = '了解信泰新型建材有限公司的最新动态和行业资讯';

// 获取数据库连接
$conn = getDbConnection();

// 分页设置
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

// 获取分类
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// 获取分类列表
$category_sql = "SELECT * FROM news_categories WHERE status = 1 ORDER BY sort_order ASC";
$category_result = $conn->query($category_sql);
$categories = [];
if ($category_result && $category_result->num_rows > 0) {
    while($row = $category_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// 构建新闻查询
$where = "WHERE status = 1";
if ($category_id > 0) {
    $where .= " AND category_id = $category_id";
}

// 获取新闻总数
$count_sql = "SELECT COUNT(*) as total FROM news $where";
$count_result = $conn->query($count_sql);
$total_news = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_news / $limit);

// 获取新闻列表
$news_sql = "SELECT n.*, c.name as category_name FROM news n 
             LEFT JOIN news_categories c ON n.category_id = c.id 
             $where ORDER BY n.created_at DESC LIMIT $offset, $limit";
$news_result = $conn->query($news_sql);
$news_list = [];
if ($news_result && $news_result->num_rows > 0) {
    while($row = $news_result->fetch_assoc()) {
        $news_list[] = $row;
    }
}

// 获取最新新闻
$latest_sql = "SELECT * FROM news WHERE status = 1 ORDER BY created_at DESC LIMIT 5";
$latest_result = $conn->query($latest_sql);
$latest_news = [];
if ($latest_result && $latest_result->num_rows > 0) {
    while($row = $latest_result->fetch_assoc()) {
        $latest_news[] = $row;
    }
}

// 关闭数据库连接
$conn->close();

// 加载头部
include_once 'includes/header.php';
?>

<!-- 页面标题 -->
<section class="page-header">
    <div class="container">
        <h1><?php echo $page_title; ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/home">首页</a></li>
                <li class="breadcrumb-item active" aria-current="page">新闻资讯</li>
            </ol>
        </nav>
    </div>
</section>

<!-- 新闻列表 -->
<section class="news-section py-5">
    <div class="container">
        <div class="row">
            <!-- 新闻列表 -->
            <div class="col-lg-8">
                <div class="news-list">
                    <?php if(empty($news_list)): ?>
                        <div class="text-center">
                            <p>暂无新闻数据</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($news_list as $news): ?>
                        <div class="news-item">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="news-image">
                                        <a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $news['id']; ?>">
                                            <img src="<?php echo SITE_URL . $news['image']; ?>" alt="<?php echo $news['title']; ?>" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="news-info">
                                        <div class="news-meta">
                                            <span class="news-date"><i class="fa fa-calendar"></i> <?php echo date('Y-m-d', strtotime($news['created_at'])); ?></span>
                                            <?php if(!empty($news['category_name'])): ?>
                                            <span class="news-category"><i class="fa fa-folder"></i> <?php echo $news['category_name']; ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="news-title"><a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a></h3>
                                        <div class="news-excerpt">
                                            <p><?php echo substr(strip_tags($news['content']), 0, 200) . '...'; ?></p>
                                        </div>
                                        <a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $news['id']; ?>" class="read-more">阅读更多 <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <!-- 分页 -->
                <?php if($total_pages > 1): ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo SITE_URL; ?>/news?<?php echo $category_id > 0 ? 'category=' . $category_id . '&' : ''; ?>page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo SITE_URL; ?>/news?<?php echo $category_id > 0 ? 'category=' . $category_id . '&' : ''; ?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php endfor; ?>
                        
                        <?php if($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo SITE_URL; ?>/news?<?php echo $category_id > 0 ? 'category=' . $category_id . '&' : ''; ?>page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
            
            <!-- 侧边栏 -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- 分类 -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">新闻分类</h3>
                        <ul class="category-list">
                            <li class="<?php echo $category_id == 0 ? 'active' : ''; ?>">
                                <a href="<?php echo SITE_URL; ?>/news">全部新闻</a>
                            </li>
                            <?php foreach($categories as $category): ?>
                            <li class="<?php echo $category_id == $category['id'] ? 'active' : ''; ?>">
                                <a href="<?php echo SITE_URL; ?>/news?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- 最新新闻 -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">最新新闻</h3>
                        <ul class="latest-news-list">
                            <?php foreach($latest_news as $latest): ?>
                            <li>
                                <div class="news-thumb">
                                    <a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $latest['id']; ?>">
                                        <img src="<?php echo SITE_URL . $latest['image']; ?>" alt="<?php echo $latest['title']; ?>" class="img-fluid">
                                    </a>
                                </div>
                                <div class="news-info">
                                    <h4><a href="<?php echo SITE_URL; ?>/news-detail?id=<?php echo $latest['id']; ?>"><?php echo $latest['title']; ?></a></h4>
                                    <span class="date"><?php echo date('Y-m-d', strtotime($latest['created_at'])); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
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

