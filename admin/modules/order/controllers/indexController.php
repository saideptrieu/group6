<?php

defined('APPPATH') or exit('Không được quyền truy cập phần này');

require_once __DIR__ . '/../models/indexModel.php';

if (!function_exists('construct')) {
    function construct()
    {
        load_model('index');
    }
}

function listAction()
{
    // Danh sách tất cả chi tiết đơn hàng (không phân trang)
    $order_items = db_fetch_array("SELECT * FROM tbl_order_items ORDER BY id DESC");
    load_view('orderView', compact('order_items'));
}

function add_itemAction() //Thêm sản phẩm
{
    if (isset($_POST['btn_add'])) {
        $order_id   = (int)$_POST['order_id'];
        $product_id = (int)$_POST['product_id'];
        $quantity   = (int)$_POST['quantity'];
        $sub_total  = (float)$_POST['sub_total'];

        if ($order_id && $product_id && $quantity && $sub_total) {
            $data = [
                'order_id'   => $order_id,
                'product_id' => $product_id,
                'quantity'   => $quantity,
                'sub_total'  => $sub_total
            ];
            db_insert('tbl_order_items', $data);
            update_order_summary($order_id); // Nếu bạn có bảng tổng
            redirect('?mod=order&action=list');
        }
    }
    load_view('addOrder'); // Gọi form phía trên
}


function delete_itemAction()
{
    // Xoá một item khỏi đơn hàng
    $item_id  = isset($_GET['item_id']) ? (int)$_GET['item_id'] : 0;
    $order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

    if ($item_id > 0 && $order_id > 0) {
        db_delete('tbl_order_items', "`id` = {$item_id}");
        update_order_summary($order_id);
    }

    redirect("?mod=order&controller=index&action=list");
}

function edit_itemAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $item = db_fetch_row("SELECT * FROM tbl_order_items WHERE id = {$id}");

    if (isset($_POST['btn_update'])) {
        $data = [
            'order_id'   => (int)$_POST['order_id'],
            'product_id' => (int)$_POST['product_id'],
            'quantity'   => (int)$_POST['quantity'],
            'sub_total'  => (float)$_POST['sub_total']
        ];
        db_update('tbl_order_items', $data, "`id` = {$id}");
        update_order_summary($data['order_id']); // nếu có dùng bảng tổng
        redirect("?mod=order&controller=index&action=list");
    }

    load_view('editOrder', compact('item'));
}


function detail_itemAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $item = db_fetch_row("SELECT * FROM tbl_order_items WHERE id = {$id}");
    load_view('detailOrder', compact('item'));
}
