<?php
// 网站基础配置
define('ROOT_PATH', realpath(__DIR__ . '/../../'));
$database_config = require ROOT_PATH . '/mysql/mysql配置项.php';

function 获取网站配置($key) {
    $config = [
        '网站名称' => '科技先锋',
        '客服电话' => '400-1234-5678',
        '公司地址' => '北京市海淀区科技大厦A座'
    ];
    return $config[$key] ?? '';
}

function 获取导航菜单() {
    global $database_config;
    $pdo = new PDO(
        "mysql:host={$database_config['db_host']};dbname={$database_config['db_name']}",
        $database_config['db_user'],
        $database_config['db_pass']
    );
    return $pdo->query("SELECT module_name AS name, module_path AS path FROM modules")->fetchAll(PDO::FETCH_ASSOC);
}
?>