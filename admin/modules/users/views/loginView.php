<html>

<head>
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/loginn.css">
</head>

<body>
    <div id="wp-form-login">
        <h1 id="title">ĐĂNG NHẬP</h1>
        <form id="form-login" action="" method="POST">
            <input type="text" id="username" name="username" value="<?php echo set_value('username') ?>" placeholder="Username" autocomplete="false">
            <?php echo form_error('username'); ?>
            <input type="password" id="password" name="password" value="" placeholder="Password" autocomplete="false">
            <?php echo form_error('password'); ?>
            <input type="submit" id="btn-login" name="btn-login" value="ĐĂNG NHẬP">
            <?php echo form_error('account'); ?>
        </form>
        
    </div>
</body>

</html>