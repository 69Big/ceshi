<h1>欢迎来到<?php echo 获取网站配置('网站名称'); ?></h1>
<p><?php echo 获取网站配置('网站描述'); ?></p>

<section class="latest-news">
    <h2>最新新闻</h2>
    <?php
    $最新新闻 = 执行查询("SELECT * FROM 新闻 ORDER BY 发布日期 DESC LIMIT 3");
    if ($最新新闻->num_rows > 0) {
        echo "<ul>";
        while ($新闻 = $最新新闻->fetch_assoc()) {
            echo "<li>
                    <h3>{$新闻['标题']}</h3>
                    <p>{$新闻['内容']}</p>
                    <span class='date'>{$新闻['发布日期']}</span>
                  </li>";
        }
        echo "</ul>";
    } else {
        echo "<p>暂无新闻</p>";
    }
    ?>
</section>

