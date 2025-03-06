<?php
// 产品列表模块 - 完全独立的模块
$page_title = '产品中心';
$page_description = '信泰新型建材有限公司提供多种高品质建筑材料产品';

// 获取数据库连接
$conn = getDbConnection();

// 分页设置
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

// 获取分类
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// 获取分类列表
$category_sql = "SELECT * FROM product_categories WHERE status = 1 ORDER BY sort_order ASC";
$category_result = $conn->query($category_sql);
$categories = [];
if ($category_result && $category_result->num_rows > 0) {
    while($row = $category_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// 构建产品查询
$where = "WHERE status = 1";
if ($category_id > 0) {
    $where .= " AND category_id = $category_id";
}

// 获取产品总数
$count_sql = "SELECT COUNT(*) as total FROM products $where";
$count_result = $conn->query($count_sql);
$total_products = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_products / $limit);

// 获取产品列表
$product_sql = "SELECT * FROM products $where ORDER BY id DESC LIMIT $offset, $limit";
$product_result = $conn->query($product_sql);
$products = [];
if ($product_result && $product_result->num_rows > 0) {
    while($row = $product_result->fetch_assoc()) {
        $products[] = $row;
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
                <li class="breadcrumb-item active" aria-current="page">产品中心</li>
            </ol>
        </nav>
    </div>
</section>

<!-- 产品列表 -->
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            <!-- 侧边栏分类 -->
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <h3>产品分类</h3>
                    <ul class="category-list">
                        <li class="<?php echo $category_id == 0 ? 'active' : ''; ?>">
                            <a href="<?php echo SITE_URL; ?>/products">全部产品</a>
                        </li>
                        <?php foreach($categories as $category): ?>
                        <li class="<?php echo $category_id == $category['id'] ? 'active' : ''; ?>">
                            <a href="<?php echo SITE_URL; ?>/products?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <!-- 产品列表 -->
            <div class="col-lg-9">
                <div class="row">
                    <?php if(empty($products)): ?>
                        <div class="col-12 text-center">
                            <p>暂无产品数据</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($products as $product): ?>
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
                
                <!-- 分页 -->
                <?php if($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo SITE_URL; ?>/products?<?php echo $category_id > 0 ? 'category=' . $category_id . '&' : ''; ?>page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo SITE_URL; ?>/products?<?php echo $category_id > 0 ? 'category=' . $category_id . '&' : ''; ?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php endfor; ?>
                        
                        <?php if($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo SITE_URL; ?>/products?<?php echo $category_id > 0 ? 'category=' . $category_id . '&' : ''; ?>page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// 加载底部
include_once 'includes/footer.php';
?>

