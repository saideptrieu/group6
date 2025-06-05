<html>

<head>
    <title>Thiết lập mật khẩu mới</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/loginn.css">
</head>

<body>
    <div id="wp-form-login">
        <h1 id="title">MẬT KHẨU MỚI</h1>
        <form id="form-login" action="" method="POST">
            <input type="password" id="password" name="password" value="" placeholder="Password" autocomplete="false">
            <?php echo form_error('password'); ?>
            <input type="submit" id="btn-login" name="btn-new-pass" value="LƯU MẬT KHẨU">
            <?php echo form_error('account'); ?>
        </form>
    </div>
</body>

</html>