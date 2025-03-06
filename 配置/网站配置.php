<?php
// 检查函数是否已定义，避免重复声明
if (!function_exists('获取网站配置')) {
    // 网站基础配置
    $网站配置 = [
        '网站名称' => '企业官网',
        '公司名称' => 'XX科技有限公司',
        '联系电话' => '400-123-4567',
        '公司地址' => '北京市朝阳区XX路XX号',
        '邮箱地址' => 'info@company.com',
        '社交媒体' => [
            '微信' => 'images/wechat.png',
            '微博' => '#',
            '抖音' => '#'
        ]
    ];

    /**
     * 获取网站配置项
     * @param string $key 配置键名
     * @return mixed|null 返回配置值，如果键名不存在则返回 null
     */
    function 获取网站配置($key) {
        global $网站配置;
        return $网站配置[$key] ?? null;
    }
}
?>