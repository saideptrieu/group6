<?php

function construct()
{
    // Bắt đầu session nếu chưa được khởi tạo
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    load_model('index');
}

function indexAction()
{
    echo 'Chưa làm';
}

function successAction()
{
    $mess = 'Đặt hàng thành công!';
    load_view('success', $mess);
}

// Hàm hỗ trợ chuyển hướng
function redirect($url)
{
    header("Location: {$url}");
    exit;
}
