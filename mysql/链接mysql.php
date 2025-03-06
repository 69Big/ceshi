<?php
// mysql\链接mysql.php

// 设置响应头的字符编码为 UTF-8
header('Content-Type: text/html; charset=utf-8');

// 引入配置文件，修改文件名
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
    echo "数据库连接成功";
} catch (PDOException $e) {
    // 连接失败时输出错误信息
    die("数据库连接失败: " . $e->getMessage());
}
?>