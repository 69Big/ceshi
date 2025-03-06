<?php
// 关于我们模块 - 完全独立的模块
$page_title = '关于我们';
$page_description = '信泰新型建材有限公司是一家专业从事新型建筑材料研发、生产和销售的企业';

// 获取数据库连接
$conn = getDbConnection();

// 获取公司信息
$company_sql = "SELECT * FROM company_info WHERE id = 1";
$company_result = $conn->query($company_sql);
$company = [];
if ($company_result && $company_result->num_rows > 0) {
    $company = $company_result->fetch_assoc();
}

// 获取团队成员
$team_sql = "SELECT * FROM team_members WHERE status = 1 ORDER BY sort_order ASC";
$team_result = $conn->query($team_sql);
$team_members = [];
if ($team_result && $team_result->num_rows > 0) {
    while($row = $team_result->fetch_assoc()) {
        $team_members[] = $row;
    }
}

// 关闭数据库连接
$conn->close();

// 加载头部
include_once 'includes/header.php';
?>

<!-- 页面标题 -->
<section class="page-header">
    <div class="container">
        <h1><?php echo $page_title; ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/home">首页</a></li>
                <li class="breadcrumb-item active" aria-current="page">关于我们</li>
            </ol>
        </nav>
    </div>
</section>

<!-- 公司简介 -->
<section class="company-intro py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <h2 class="section-title">公司简介</h2>
                    <?php if(!empty($company['description'])): ?>
                        <?php echo $company['description']; ?>
                    <?php else: ?>
                        <p>信泰新型建材有限公司成立于2005年，是一家专业从事新型建筑材料研发、生产和销售的企业。公司总部位于中国，拥有现代化的生产基地和研发中心。</p>
                        <p>经过多年的发展，公司已成为行业内具有较强竞争力的企业之一。我们的产品包括环保节能墙材、防水材料、保温材料、装饰材料等多个系列，广泛应用于住宅、商业、工业等各类建筑工程。</p>
                        <p>公司秉承"质量第一、客户至上"的经营理念，致力于为全球客户提供高品质、环保、节能的建筑材料解决方案。我们的产品远销欧美、东南亚等多个国家和地区，深受客户好评。</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <?php if(!empty($company['image'])): ?>
                        <img src="<?php echo SITE_URL . $company['image']; ?>" alt="公司简介" class="img-fluid">
                    <?php else: ?>
                        <img src="<?php echo SITE_URL; ?>/assets/images/about-company.jpg" alt="公司简介" class="img-fluid">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 公司历史 -->
<section class="company-history py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">发展历程</h2>
            <p>我们的成长与创新之路</p>
        </div>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-year">2005</div>
                <div class="timeline-content">
                    <h3>公司成立</h3>
                    <p>信泰新型建材有限公司在中国成立，开始专注于建筑材料的研发和生产。</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2008</div>
                <div class="timeline-content">
                    <h3>扩大生产规模</h3>
                    <p>公司投资建设新的生产基地，扩大生产规模，增加产品线。</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2012</div>
                <div class="timeline-content">
                    <h3>国际市场拓展</h3>
                    <p>产品开始出口到东南亚市场，迈出国际化发展的第一步。</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2015</div>
                <div class="timeline-content">
                    <h3>研发中心成立</h3>
                    <p>成立专业研发中心，加大技术创新力度，推出多项专利产品。</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2018</div>
                <div class="timeline-content">
                    <h3>欧美市场突破</h3>
                    <p>产品成功进入欧美市场，获得国际认证，品牌影响力不断提升。</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2022</div>
                <div class="timeline-content">
                    <h3>智能制造升级</h3>
                    <p>引入智能制造技术，提升生产效率和产品质量，实现可持续发展。</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 企业文化 -->
<section class="company-culture py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">企业文化</h2>
            <p>我们的价值观与使命</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="culture-box text-center">
                    <div class="culture-icon">
                        <i class="fa fa-eye"></i>
                    </div>
                    <h3>愿景</h3>
                    <p>成为全球领先的新型建材解决方案提供商</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="culture-box text-center">
                    <div class="culture-icon">
                        <i class="fa fa-bullseye"></i>
                    </div>
                    <h3>使命</h3>
                    <p>为全球客户提供高品质、环保、节能的建筑材料</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="culture-box text-center">
                    <div class="culture-icon">
                        <i class="fa fa-heart"></i>
                    </div>
                    <h3>核心价值观</h3>
                    <p>诚信、创新、品质、共赢</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="culture-box text-center">
                    <div class="culture-icon">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                    <h3>经营理念</h3>
                    <p>质量第一、客户至上、持续创新</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 团队介绍 -->
<?php if(!empty($team_members)): ?>
<section class="team-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">管理团队</h2>
            <p>专业的团队是我们成功的关键</p>
        </div>
        <div class="row">
            <?php foreach($team_members as $member): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-member">
                    <div class="member-image">
                        <img src="<?php echo SITE_URL . $member['image']; ?>" alt="<?php echo $member['name']; ?>" class="img-fluid">
                    </div>
                    <div class="member-info">
                        <h3><?php echo $member['name']; ?></h3>
                        <p class="position"><?php echo $member['position']; ?></p>
                        <p class="description"><?php echo $member['description']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 荣誉资质 -->
<section class="certificates py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">荣誉资质</h2>
            <p>我们的专业能力得到广泛认可</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="certificate-item">
                    <img src="<?php echo SITE_URL; ?>/assets/images/certificates/cert1.jpg" alt="ISO 9001" class="img-fluid">
                    <h3>ISO 9001</h3>
                    <p>质量管理体系认证</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="certificate-item">
                    <img src="<?php echo SITE_URL; ?>/assets/images/certificates/cert2.jpg" alt="ISO 14001" class="img-fluid">
                    <h3>ISO 14001</h3>
                    <p>环境管理体系认证</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="certificate-item">
                    <img src="<?php echo SITE_URL; ?>/assets/images/certificates/cert3.jpg" alt="CE认证" class="img-fluid">
                    <h3>CE认证</h3>
                    <p>欧盟产品安全认证</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="certificate-item">
                    <img src="<?php echo SITE_URL; ?>/assets/images/certificates/cert4.jpg" alt="高新技术企业" class="img-fluid">
                    <h3>高新技术企业</h3>
                    <p>国家级高新技术企业认定</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// 加载底部
include_once 'includes/footer.php';
?>

