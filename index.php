<?php
// 设置错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 定义网站根目录的绝对路径
define('ROOT_PATH', __DIR__);

// 定义通用模块目录的绝对路径
define('COMMON_MODULE_PATH', ROOT_PATH. '/通用模块');

// 定义视图目录的绝对路径
define('VIEW_PATH', ROOT_PATH. '/视图');

// 定义配置目录的绝对路径
define('CONFIG_PATH', ROOT_PATH. '/配置');

// 引入配置文件
require_once CONFIG_PATH. '/网站配置.php';

// 引入预处理文件
require_once ROOT_PATH. '/预处理.php';

// 定义所有界面的路径信息
$pagePaths = [
    'home' => VIEW_PATH. '/首页视图/home.php',
    '产品列表' => VIEW_PATH. '/产品列表视图/products.php',
    '关于我们' => VIEW_PATH. '/关于我们视图/about.php',
    '联系我们' => VIEW_PATH. '/联系我们视图/contact.php'
    // 可以继续添加其他界面的路径信息，格式为 '界面名称' => '对应的视图文件路径'
];

// 获取请求的页面
$页面 = isset($_GET['页面']) ? urldecode($_GET['页面']) : 'home';

// 根据请求的页面加载相应的内容
function 加载页面($页面, $pagePaths) {
    $文件路径 = $pagePaths[$页面]?? VIEW_PATH. '/404/404.php';
    if (file_exists($文件路径)) {
        require_once COMMON_MODULE_PATH. '/头部.php';
        require_once $文件路径;
        require_once COMMON_MODULE_PATH. '/底部.php';
    } else {
        require_once VIEW_PATH. '/404/404.php';
    }
}

// 加载请求的页面
加载页面($页面, $pagePaths);
