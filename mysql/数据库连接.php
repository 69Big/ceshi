<?php
// 数据库配置
$数据库配置 = [
    'host' => '8.138.131.199',
    'username' => 'root',
    'password' => '123rgE123',
    'dbname' => 'ceshi',
    'port' => 3306,
    '字符集' => 'utf8mb4'
];

function 获取数据库连接() {
    global $数据库配置;
    
    $连接 = new mysqli(
        $数据库配置['host'],
        $数据库配置['username'],
        $数据库配置['password'],
        $数据库配置['dbname'],
        $数据库配置['port']
    );

    if ($连接->connect_error) {
        die("数据库连接失败: " . $连接->connect_error);
    }

    $连接->set_charset($数据库配置['字符集']);

    return $连接;
}

function 执行查询($sql, $参数 = []) {
    $连接 = 获取数据库连接();
    $语句 = $连接->prepare($sql);

    if ($语句 === false) {
        die("准备查询失败: " . $连接->error);
    }

    if (!empty($参数)) {
        $类型 = str_repeat('s', count($参数));
        $语句->bind_param($类型, ...$参数);
    }

    $语句->execute();
    $结果 = $语句->get_result();

    $语句->close();
    $连接->close();

    return $结果;
}

