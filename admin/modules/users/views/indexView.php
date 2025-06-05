<?php
$error = [];


if (isset($_POST['btn_login'])) {
    # Kiểm tra username
    if (empty($_POST['username'])) {
        $error['username'] = "Không được để trống username";
    } else {
        $partten = '/^[A-Za-z0-9_\.]{6,32}$/';
        if (!preg_match($partten, $_POST['username'])) {
            $error['username'] = "Username không đúng định dạng";
        } else {
            $username = $_POST['username'];
        }
    }

    # Kiểm tra password
    if (empty($_POST['password'])) {
        $error['password'] = "Không được để trống password";
    } else {
        $partten = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
        if (!preg_match($partten, $_POST['password'])) {
            $error['password'] = "Password không đúng định dạng";
        } else {
            $password = $_POST['password'];
        }
    }

    # Kiểm tra đăng nhập
    if (empty($error)) {
        if (check_login($username, $password)) {
            $_SESSION['is_login'] = true;
            $_SESSION['user_login'] = $username;
            redirect("?mod=home&controller=index");
        } else {
            $error['account'] = "Username hoặc password không tồn tại";
        }
    }
}

?>

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
            <input type="text" id="username" name="username" value="" placeholder="username">
            <?php
            if (!empty($error['username'])) {
            ?>
                <p class="error"><?php echo $error['username']; ?></p>
            <?php
            }
            ?>
            <input type="password" id="password" name="password" value="" placeholder="password">
            <?php
            if (!empty($error['password'])) {
            ?>
                <p class="error"><?php echo $error['password']; ?></p>
            <?php
            }
            ?>
            <input type="submit" id="btn-login" name="btn_login" value="Đăng nhập">
            <?php
            if (!empty($error['account'])) {
            ?>
                <p class="error"><?php echo $error['account']; ?></p>
            <?php
            }
            ?>
        </form>
    </div>
</body>

</html>