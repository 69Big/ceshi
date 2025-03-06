<?php
// index.php
// 引入配置文件（假设包含数据库连接信息等）
require_once './mysql/链接mysql.php';

// 定义一个常量来控制是否开启日志记录
define('ENABLE_LOGGING', false);

// 中文命名的变量，统一放置在顶部
// 默认的头部文件路径
$默认头部文件路径 = './通用模块/1.页面头部/header.php';
// 默认的首页模块文件路径
$默认首页模块文件路径 = './前端页面模块/1.首页模块/home.php';
// 从 URL 获取的模块名称，默认为 'home'
$模块名称 = $_GET['module'] ?? 'home';
// 存储从数据库查询得到的模块信息
$模块信息 = null;
// 存储最终要加载的模块文件路径
$模块文件路径 = '';
// 日志文件路径
$日志文件路径 = __DIR__ . '/logs/index.log';

// 日志记录函数
function logMessage($message, $日志文件路径) {
    if (ENABLE_LOGGING) {
        // 确保日志目录存在
        $日志目录 = dirname($日志文件路径);
        if (!is_dir($日志目录)) {
            mkdir($日志目录, 0755, true);
        }
        $日志内容 = date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;
        file_put_contents($日志文件路径, $日志内容, FILE_APPEND);
    }
}

try {
    // 从数据库中查询模块信息
    $stmt = $pdo->prepare("SELECT module_path FROM modules WHERE module_name = :模块名称");
    $stmt->bindParam(':模块名称', $模块名称, PDO::PARAM_STR);
    $stmt->execute();
    $模块信息 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($模块信息) {
        $模块文件路径 = __DIR__ . $模块信息['module_path'];
    } else {
        // 如果数据库中没有找到对应的模块，默认加载 home 模块
        $模块文件路径 = __DIR__ . $默认首页模块文件路径;
        logMessage("模块 '{$模块名称}' 在数据库中未找到，加载默认首页模块。", $日志文件路径);
    }

    // 加载页面头部
    if (file_exists($默认头部文件路径)) {
        include $默认头部文件路径;
    } else {
        throw new Exception("头部文件 '{$默认头部文件路径}' 不存在。");
    }

    // 加载模块内容
    if (file_exists($模块文件路径)) {
        include $模块文件路径;
    } else {
        echo '<p>请求的页面不存在。</p>';
        logMessage("模块文件 '{$模块文件路径}' 不存在。", $日志文件路径);
    }

    // 加载页面底部
    $默认底部文件路径 = './通用模块/2.页面底部/footer.php';
    if (file_exists($默认底部文件路径)) {
        include $默认底部文件路径;
    } else {
        throw new Exception("底部文件 '{$默认底部文件路径}' 不存在。");
    }
} catch (PDOException $e) {
    // 捕获 PDO 异常并输出错误信息
    echo '<p>数据库错误：' . $e->getMessage() . '</p>';
    logMessage("数据库错误: " . $e->getMessage(), $日志文件路径);
} catch (Exception $e) {
    // 捕获其他异常并输出错误信息
    echo '<p>发生错误：' . $e->getMessage() . '</p>';
    logMessage("一般错误: " . $e->getMessage(), $日志文件路径);
}
?>