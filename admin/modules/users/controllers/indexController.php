<?php
function construct()
{
  load_model('index');
  load('lib', 'validation');
  load('lib', 'email');
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

function updateAction()
{
  if (isset($_POST['btn-update'])) {
    // show_array($_POST);
    $error = array();

    #Kiểm tra fullname
    if (empty($_POST['fullname'])) {
      $error['fullname'] = "Không được để trống tên hiển thị";
    } else {
      if (!is_fullname($_POST['fullname'])) {
        $error['fullname'] = "Tên hiển thị không đúng định dạng";
      } else {
        $fullname = $_POST['fullname'];
      }
    }

    #Kiểm tra phone_number
    if (empty($_POST['phone_number'])) {
      $error['phone_number'] = "Lỗi";
    } else {
      if (!is_phone_number($_POST['phone_number'])) {
        $error['phone_number'] = "Số điện thoại không đúng định dạng";
      } else {
        $phone_number = $_POST['phone_number'];
      }
    }

    #Kiểm tra address
    if (empty($_POST['address'])) {
      $error['address'] = "Lỗi";
    } else {
      if (!is_address($_POST['address'])) {
        $error['address'] = "Địa chỉ không đúng định dạng";
      } else {
        $address = $_POST['address'];
      }
    }

    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    
    #update

    if (empty($error)) {
      $data = array(
        'fullname' => $fullname,
        'phone_number' => $phone_number,
        'address' => $address
      );
      show_array($data);
      update_user_login(user_login(), $data);
    }
  }
  // show_array($_SESSION);
  $info_user = get_user_by_username(user_login());
  // show_array($info_user);
  $data['info_user'] = $info_user;
  load_view('update', $data);
}
