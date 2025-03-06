<?php
// 开启详细错误提示
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// 定义路径常量
define('ROOT_PATH', __DIR__);
define('DS', DIRECTORY_SEPARATOR);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST']);

// 调试信息
echo "<!-- 调试：开始加载页面 -->\n";

// 检查配置文件
if (!file_exists(ROOT_PATH . DS . '配置' . DS . '网站配置.php')) {
    die("<!-- 错误：网站配置文件缺失 -->");
}

// 加载配置
require_once ROOT_PATH . DS . '配置' . DS . '网站配置.php';

// 初始化路由参数
$合法页面 = ['home', 'about', 'products', 'contact'];
$页面 = $_GET['页面'] ?? 'home';

// 安全过滤
if (!in_array($页面, $合法页面)) {
    $页面 = '404';
}

// 调试信息
echo "<!-- 当前页面：{$页面} -->\n";

// 加载页面函数
function 加载页面(string $页面) {
    // 调试信息
    echo "<!-- 调试：正在加载页面 {$页面} -->\n";

    // 设置全局变量
    $GLOBALS['base_url'] = BASE_URL;
    $GLOBALS['page'] = $页面;

    // 加载头部
    $头部路径 = ROOT_PATH . DS . '通用模块' . DS . '头部' . DS . '头部.php';
    if (file_exists($头部路径)) {
        require_once $头部路径;
    } else {
        die("<!-- 错误：头部文件缺失 -->");
    }

    // 加载主体
    $视图路径 = ROOT_PATH . DS . '视图' . DS . "{$页面}视图" . DS . "{$页面}.php";
    if (file_exists($视图路径)) {
        require_once $视图路径;
    } else {
        die("<!-- 错误：视图文件缺失 -->");
    }

    // 加载底部
    $底部路径 = ROOT_PATH . DS . '通用模块' . DS . '底部' . DS . '底部.php';
    if (file_exists($底部路径)) {
        require_once $底部路径;
    } else {
        die("<!-- 错误：底部文件缺失 -->");
    }
}

// 执行加载
加载页面($页面);

echo "<!-- 调试：页面加载完成 -->\n";
?>