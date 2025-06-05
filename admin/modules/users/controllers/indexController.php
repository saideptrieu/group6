<?php
function construct()
{
  load_model('index');
  load('lib', 'validation');
}

function indexAction()
{
  load_view('index');
}

function loginAction()
{
  // echo time();
  // echo date('d/m/y h:m:s');
  global $error, $username, $password;
  if (isset($_POST['btn-login'])) {
    $error = array();

    #Kiểm tra username
    if (empty($_POST['username'])) {
      $error['username'] = "Không được để trống tên đăng nhập";
    } else {
      if (!is_username($_POST['username'])) {
        $error['username'] = "Tên đăng nhập không đúng định dạng";
      } else {
        $username = $_POST['username'];
      }
    }

    #Kiểm tra password
    if (empty($_POST['password'])) {
      $error['password'] = "Không được để trống password";
    } else {
      if (!is_password($_POST['password'])) {
        $error['password'] = "Mật khẩu không đúng định dạng";
      } else {
        $password = md5($_POST['password']);
      }
    }

    #Kết luận
    if (empty($error)) {
      if (check_login($username, $password)) {
        //Lưu trữ phiên đăng nhập
        $_SESSION['is_login'] = true;
        $_SESSION['user_login'] = $username;
        //chuyển hướng vào trong hệ thống
        redirect();
      } else {
        $error['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
      }
    }
  }
  load_view('login');
}

function logoutAction()
{
  unset($_SESSION['is_login']);
  unset($_SESSION['user_login']);
  redirect("?mod=users&action=login");
}

function resetAction()
{
  load_view('reset');
}
