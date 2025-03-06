<?php
// 联系我们模块 - 完全独立的模块
$page_title = '联系我们';
$page_description = '欢迎联系信泰新型建材有限公司，我们期待与您合作';

// 处理表单提交
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单数据
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $content = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // 简单验证
    if (empty($name) || empty($email) || empty($content)) {
        $message = '请填写必填字段';
        $message_type = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '请输入有效的电子邮件地址';
        $message_type = 'danger';
    } else {
        // 获取数据库连接
        $conn = getDbConnection();
        
        // 保存到数据库
        $sql = "INSERT INTO contact_messages (name, email, phone, subject, message, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $phone, $subject, $content);
        
        if ($stmt->execute()) {
            $message = '您的消息已成功提交，我们将尽快与您联系';
            $message_type = 'success';
            
            // 清空表单
            $name = $email = $phone = $subject = $content = '';
        } else {
            $message = '提交失败，请稍后再试';
            $message_type = 'danger';
        }
        
        $stmt->close();
        $conn->close();
    }
}

// 获取数据库连接
$conn = getDbConnection();

// 获取公司联系信息
$contact_sql = "SELECT * FROM company_info WHERE id = 1";
$contact_result = $conn->query($contact_sql);
$contact = [];
if ($contact_result && $contact_result->num_rows > 0) {
    $contact = $contact_result->fetch_assoc();
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
                <li class="breadcrumb-item active" aria-current="page">联系我们</li>
            </ol>
        </nav>
    </div>
</section>

<!-- 联系信息 -->
<section class="contact-info py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-box text-center">
                    <div class="contact-icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <h3>公司地址</h3>
                    <p><?php echo !empty($contact['address']) ? $contact['address'] : '中国某省某市某区某街道123号'; ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-box text-center">
                    <div class="contact-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h3>联系电话</h3>
                    <p><?php echo !empty($contact['phone']) ? $contact['phone'] : '+86 123 4567 8910'; ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-box text-center">
                    <div class="contact-icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <h3>电子邮箱</h3>
                    <p><?php echo !empty($contact['email']) ? $contact['email'] : 'info@xintai.com'; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 联系表单 -->
<section class="contact-form py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-wrapper">
                    <h2 class="section-title">发送消息</h2>
                    <p class="mb-4">如果您有任何问题或需求，请填写下面的表单，我们将尽快回复您。</p>
                    
                    <?php if(!empty($message)): ?>
                    <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                        <?php echo $message; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo SITE_URL; ?>/contact" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">姓名 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">电子邮箱 <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">电话</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">主题</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo isset($subject) ? $subject : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">消息内容 <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" required><?php echo isset($content) ? $content : ''; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-wrapper">
                    <h2 class="section-title">我们的位置</h2>
                    <p class="mb-4">欢迎访问我们的公司，以下是我们的地理位置。</p>
                    <div class="map">
                        <!-- 替换为实际的地图嵌入代码 -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.7710973650286!2d-73.98261868459468!3d40.758895279326224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1635739442289!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// 加载底部
include_once 'includes/footer.php';
?>

