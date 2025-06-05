<?php

require_once 'helper/url.php';
require_once 'helper/users.php';

//Kiểm tra xem ngfunction redirect($url)
if (!is_login() && get_action() != 'login') {
    redirect("?mod=users&action=login");
}

$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller() . 'Controller.php';

if (file_exists($request_path)) {
    require $request_path;
} else {
    echo "Không tìm thấy:$request_path ";
}

$action_name = get_action() . 'Action';

// Kiểm tra nếu hàm gọi được xác định
call_function(array('construct', $action_name));

