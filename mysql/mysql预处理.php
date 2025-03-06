<?php
// 设置响应头的字符编码为 UTF-8
header('Content-Type: text/html; charset=utf-8');

// 引入数据库配置文件
$config = require_once 'mysql配置项.php';

try {
    // 使用 PDO 连接数据库
    $pdo = new PDO(
        "mysql:host=" . $config['db_host'] . ";dbname=" . $config['db_name'] . ";charset=utf8mb4",
        $config['db_user'],
        $config['db_pass']
    );
    // 设置 PDO 错误模式为异常模式
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 修改 modules 表结构的 SQL 语句，添加 sort_order 字段
    $alterTableSql = "
        ALTER TABLE modules
        ADD COLUMN sort_order INT NOT NULL DEFAULT 0
    ";
    // 尝试执行修改表结构的 SQL 语句，如果表不存在则先创建表
    try {
        $pdo->exec($alterTableSql);
        echo "表 'modules' 结构修改成功，已添加排序字段。\n";
    } catch (PDOException $alterException) {
        // 如果表不存在，捕获异常并创建表
        if ($alterException->getCode() == '42S02') {
            // 创建 modules 表的 SQL 语句，包含 sort_order 字段
            $createTableSql = "
                CREATE TABLE IF NOT EXISTS modules (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    module_name VARCHAR(50) NOT NULL,
                    module_path VARCHAR(255) NOT NULL,
                    sort_order INT NOT NULL DEFAULT 0
                )
            ";
            // 执行创建表的 SQL 语句
            $pdo->exec($createTableSql);
            echo "表 'modules' 创建成功。\n";
        } else {
            // 如果是其他异常，重新抛出异常
            throw $alterException;
        }
    }

    // 插入数据的 SQL 语句，包含 sort_order 字段的值
    $insertDataSql = "
        INSERT INTO modules (module_name, module_path, sort_order) VALUES
        ('home', '/modules/home/home.php', 1),
        ('products', '/modules/products/products.php', 2),
        ('about', '/modules/about/about.php', 3),
        ('contact', '/modules/contact/contact.php', 4)
    ";

    // 执行插入数据的 SQL 语句
    $pdo->exec($insertDataSql);
    echo "数据插入成功。\n";

    // 创建 sliders 表
    $createSlidersTableSql = "
        CREATE TABLE IF NOT EXISTS sliders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            image VARCHAR(255) NOT NULL,
            button_text VARCHAR(255),
            button_link VARCHAR(255),
            status TINYINT(1) DEFAULT 1,
            sort_order INT DEFAULT 0
        )
    ";
    $pdo->exec($createSlidersTableSql);
    echo "表 'sliders' 创建成功。\n";

    // 插入 sliders 测试数据
    $insertSlidersDataSql = "
        INSERT INTO sliders (title, description, image, button_text, button_link, status, sort_order)
        VALUES 
        ('轮播图1', '这是轮播图1的描述', '/assets/images/slider1.jpg', '了解更多', '/about', 1, 1),
        ('轮播图2', '这是轮播图2的描述', '/assets/images/slider2.jpg', '查看产品', '/products', 1, 2),
        ('轮播图3', '这是轮播图3的描述', '/assets/images/slider3.jpg', NULL, NULL, 1, 3),
        ('轮播图4', '这是轮播图4的描述', '/assets/images/slider4.jpg', '联系我们', '/contact', 1, 4),
        ('轮播图5', '这是轮播图5的描述', '/assets/images/slider5.jpg', '新闻资讯', '/news', 1, 5)
    ";
    $pdo->exec($insertSlidersDataSql);
    echo "表 'sliders' 数据插入成功。\n";

    // 创建 products 表
    $createProductsTableSql = "
        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            image VARCHAR(255) NOT NULL,
            featured TINYINT(1) DEFAULT 0,
            status TINYINT(1) DEFAULT 1
        )
    ";
    $pdo->exec($createProductsTableSql);
    echo "表 'products' 创建成功。\n";

    // 插入 products 测试数据
    $insertProductsDataSql = "
        INSERT INTO products (name, description, image, featured, status)
        VALUES 
        ('产品1', '这是产品1的详细描述', '/assets/images/product1.jpg', 1, 1),
        ('产品2', '这是产品2的详细描述', '/assets/images/product2.jpg', 1, 1),
        ('产品3', '这是产品3的详细描述', '/assets/images/product3.jpg', 1, 1),
        ('产品4', '这是产品4的详细描述', '/assets/images/product4.jpg', 1, 1),
        ('产品5', '这是产品5的详细描述', '/assets/images/product5.jpg', 1, 1),
        ('产品6', '这是产品6的详细描述', '/assets/images/product6.jpg', 1, 1)
    ";
    $pdo->exec($insertProductsDataSql);
    echo "表 'products' 数据插入成功。\n";

    // 创建 news 表
    $createNewsTableSql = "
        CREATE TABLE IF NOT EXISTS news (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            content TEXT,
            image VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            status TINYINT(1) DEFAULT 1
        )
    ";
    $pdo->exec($createNewsTableSql);
    echo "表 'news' 创建成功。\n";

    // 插入 news 测试数据
    $insertNewsDataSql = "
        INSERT INTO news (title, content, image, created_at, status)
        VALUES 
        ('新闻标题1', '这是新闻1的详细内容', '/assets/images/news1.jpg', '2025-03-01 10:00:00', 1),
        ('新闻标题2', '这是新闻2的详细内容', '/assets/images/news2.jpg', '2025-03-02 10:00:00', 1),
        ('新闻标题3', '这是新闻3的详细内容', '/assets/images/news3.jpg', '2025-03-03 10:00:00', 1)
    ";
    $pdo->exec($insertNewsDataSql);
    echo "表 'news' 数据插入成功。\n";

    // 创建 company_info 表
    $createCompanyInfoTableSql = "
        CREATE TABLE IF NOT EXISTS company_info (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT
        )
    ";
    $pdo->exec($createCompanyInfoTableSql);
    echo "表 'company_info' 创建成功。\n";

    // 插入 company_info 测试数据
    $insertCompanyInfoDataSql = "
        INSERT INTO company_info (name, description)
        VALUES ('信泰新型建材有限公司', '专业从事新型建筑材料研发、生产和销售的企业')
    ";
    $pdo->exec($insertCompanyInfoDataSql);
    echo "表 'company_info' 数据插入成功。\n";

    // 创建 team_members 表
    $createTeamMembersTableSql = "
        CREATE TABLE IF NOT EXISTS team_members (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            position VARCHAR(255) NOT NULL,
            image VARCHAR(255),
            status TINYINT(1) DEFAULT 1,
            sort_order INT DEFAULT 0
        )
    ";
    $pdo->exec($createTeamMembersTableSql);
    echo "表 'team_members' 创建成功。\n";

    // 插入 team_members 测试数据
    $insertTeamMembersDataSql = "
        INSERT INTO team_members (name, position, image, status, sort_order)
        VALUES ('张三', '研发经理', '/assets/images/team1.jpg', 1, 1),
               ('李四', '销售经理', '/assets/images/team2.jpg', 1, 2)
    ";
    $pdo->exec($insertTeamMembersDataSql);
    echo "表 'team_members' 数据插入成功。\n";

    // 创建 news_categories 表
    $createNewsCategoriesTableSql = "
        CREATE TABLE IF NOT EXISTS news_categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            status TINYINT(1) DEFAULT 1,
            sort_order INT DEFAULT 0
        )
    ";
    $pdo->exec($createNewsCategoriesTableSql);
    echo "表 'news_categories' 创建成功。\n";

    // 插入 news_categories 测试数据
    $insertNewsCategoriesDataSql = "
        INSERT INTO news_categories (name, status, sort_order)
        VALUES ('行业动态', 1, 1),
               ('公司新闻', 1, 2)
    ";
    $pdo->exec($insertNewsCategoriesDataSql);
    echo "表 'news_categories' 数据插入成功。\n";

    // 创建 product_categories 表
    $createProductCategoriesTableSql = "
        CREATE TABLE IF NOT EXISTS product_categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            status TINYINT(1) DEFAULT 1,
            sort_order INT DEFAULT 0
        )
    ";
    $pdo->exec($createProductCategoriesTableSql);
    echo "表 'product_categories' 创建成功。\n";

    // 插入 product_categories 测试数据
    $insertProductCategoriesDataSql = "
        INSERT INTO product_categories (name, status, sort_order)
        VALUES ('建材产品1', 1, 1),
               ('建材产品2', 1, 2)
    ";
    $pdo->exec($insertProductCategoriesDataSql);
    echo "表 'product_categories' 数据插入成功。\n";

} catch (PDOException $e) {
    // 捕获异常并输出错误信息
    echo "操作失败: " . $e->getMessage();
}
?>