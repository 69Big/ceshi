<?php
require_once __DIR__ . '/../配置/网站配置.php';
?>
<nav class="main-nav">
    <div class="nav-container">
        <a href="/" class="logo"><?= 获取网站配置('网站名称') ?></a>
        <ul class="nav-menu">
            <?php foreach(获取导航菜单() as $item): ?>
            <li class="<?= $_SERVER['REQUEST_URI'] == $item['path'] ? 'active' : '' ?>">
                <a href="<?= $item['path'] ?>"><?= $item['name'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>