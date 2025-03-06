<?php $pageTitle = '联系我们'; ?>
<section class="container my-5">
    <h1>联系我们</h1>
    
    <div class="row">
        <div class="col-md-6">
            <h3>联系方式</h3>
            <p>电话：<?= 获取网站配置('联系电话') ?></p>
            <p>邮箱：<?= 获取网站配置('邮箱地址') ?></p>
            <p>地址：<?= 获取网站配置('公司地址') ?></p>
        </div>
        
        <div class="col-md-6">
            <h3>留言反馈</h3>
            <form>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="您的姓名">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="电子邮箱">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" rows="5" placeholder="留言内容"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</section>