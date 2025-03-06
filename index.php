<?php
// 设置错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 定义网站根目录
define('ROOT_PATH', __DIR__);

// 引入配置文件
require_once ROOT_PATH . '/配置/网站配置.php';

// 引入预处理文件
require_once ROOT_PATH . '/预处理.php';

// 获取请求的页面
$页面 = isset($_GET['页面']) ? $_GET['页面'] : 'home';

// 根据请求的页面加载相应的内容
function 加载页面($页面) {
    $文件路径 = ROOT_PATH . "/视图/{$页面}视图/{$页面}.php";
    if (file_exists($文件路径)) {
        require_once ROOT_PATH . '/通用模块/头部.php';
        require_once $文件路径;
        require_once ROOT_PATH . '/通用模块/底部.php';
    } else {
        require_once ROOT_PATH . '/视图/404/404.php';
    }
}

// 加载请求的页面
加载页面($页面);

