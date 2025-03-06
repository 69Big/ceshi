<?php
// 确保 ROOT_PATH 已定义
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__);
}

// 引入数据库连接文件
require_once ROOT_PATH . '/mysql/数据库连接.php';

session_start();

// 预处理所需的数据库表格
function 创建测试数据() {
    // 创建新闻表
    $createNewsTableSql = "
        CREATE TABLE IF NOT EXISTS 新闻 (
            id INT AUTO_INCREMENT PRIMARY KEY,
            标题 VARCHAR(255) NOT NULL,
            内容 TEXT,
            发布日期 DATE
        )
    ";
    执行查询($createNewsTableSql);

    // 插入新闻测试数据
    $insertNewsDataSql = "
        INSERT INTO 新闻 (标题, 内容, 发布日期) VALUES 
        ('南国鼎峰荣获行业创新奖', '我公司凭借优秀的产品和服务,荣获2023年度行业创新奖...', '2023-05-15'),
        ('新产品发布会圆满成功', '南国鼎峰于上周成功举办了新产品发布会,吸引了众多业内人士...', '2023-04-20'),
        ('南国鼎峰参加国际贸易展', '我公司代表团已启程参加在德国举行的国际贸易展,展示最新技术...', '2023-03-10')
    ";
    执行查询($insertNewsDataSql);

    // 创建产品表
    $createProductTableSql = "
        CREATE TABLE IF NOT EXISTS 产品 (
            id INT AUTO_INCREMENT PRIMARY KEY,
            名称 VARCHAR(255) NOT NULL,
            描述 TEXT,
            价格 DECIMAL(10, 2),
            图片 VARCHAR(255)
        )
    ";
    执行查询($createProductTableSql);

    // 插入产品测试数据
    $insertProductDataSql = "
        INSERT INTO 产品 (名称, 描述, 价格, 图片) VALUES 
        ('智能家居系统', '全方位智能家居解决方案,让您的生活更加便捷', 9999.99, '/视图/产品列表视图/images/product1.jpg'),
        ('新能源电池', '高效环保的新能源电池,为您的设备提供持久动力', 1999.99, '/视图/产品列表视图/images/product2.jpg'),
        ('智能监控摄像头', '高清晰度,远程控制,让您随时掌握情况', 599.99, '/视图/产品列表视图/images/product3.jpg')
    ";
    执行查询($insertProductDataSql);

    // 创建团队成员表
    $createTeamMemberTableSql = "
        CREATE TABLE IF NOT EXISTS 团队成员 (
            id INT AUTO_INCREMENT PRIMARY KEY,
            姓名 VARCHAR(50) NOT NULL,
            职位 VARCHAR(100),
            简介 TEXT,
            照片 VARCHAR(255)
        )
    ";
    执行查询($createTeamMemberTableSql);

    // 插入团队成员测试数据
    $insertTeamMemberDataSql = "
        INSERT INTO 团队成员 (姓名, 职位, 简介, 照片) VALUES 
        ('张三', '首席执行官', '拥有20年行业经验,曾成功领导多个大型项目', '/视图/关于我们视图/images/team1.jpg'),
        ('李四', '技术总监', '技术专家,多项发明专利持有人', '/视图/关于我们视图/images/team2.jpg'),
        ('王五', '市场总监', '深谙市场运作,擅长品牌推广和客户关系管理', '/视图/关于我们视图/images/team3.jpg')
    ";
    执行查询($insertTeamMemberDataSql);
}

// 执行预处理
创建测试数据();

