    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>联系我们</h5>
                    <p>电话：<?= 获取网站配置('联系电话') ?></p>
                    <p>邮箱：<?= 获取网站配置('邮箱地址') ?></p>
                    <p>地址：<?= 获取网站配置('公司地址') ?></p>
                </div>
                <div class="col-md-4">
                    <h5>关注我们</h5>
                    <?php foreach (获取网站配置('社交媒体') as $平台 => $内容): ?>
                        <a href="<?= $内容 ?>" class="text-white me-2"><?= $平台 ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <p>&copy; <?= date('Y') ?> <?= 获取网站配置('公司名称') ?>. 保留所有权利。</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.bootcdn.net/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>