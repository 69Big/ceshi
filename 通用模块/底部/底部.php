<?php
require_once __DIR__ . '/配置/网站配置.php';
?>
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4>联系我们</h4>
            <p><?= 获取网站配置('公司地址') ?></p>
            <p>电话：<?= 获取网站配置('客服电话') ?></p>
        </div>
        
        <div class="footer-section">
            <h4>快速链接</h4>
            <ul class="footer-links">
                <?php foreach(获取导航菜单() as $item): ?>
                <li><a href="<?= $item['path'] ?>"><?= $item['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>关注我们</h4>
            <div class="social-icons">
                <img src="/public/social-wechat.png" alt="微信">
                <img src="/public/social-weibo.png" alt="微博">
            </div>
        </div>
    </div>
    
    <div class="copyright">
        &copy; <?= date('Y') ?> <?= 获取网站配置('网站名称') ?> 保留所有权利
    </div>
</footer>