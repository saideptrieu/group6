<?php

function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function get_info_order($id)
{
    // Lấy thông tin đơn hàng
    $order = db_fetch_row("SELECT * FROM `tbl_orders` WHERE `id` = {$id}");

    // Lấy chi tiết sản phẩm trong đơn
    $items = db_fetch_array("SELECT * FROM `tbl_order_items` WHERE `order_id` = {$id}");

    // Gộp dữ liệu lại thành 1 mảng
    $order['items'] = $items;

    return $order;
}

// Lấy tất cả sản phẩm trong đơn hàng (product_id, quantity, sub_total)
function get_order_items($order_id)
{
    $sql = "SELECT product_id, quantity, sub_total FROM tbl_order_items WHERE order_id = {$order_id}";
    $result = db_fetch_array($sql); // giả sử trả về mảng nhiều row
    return $result;
}

// Lấy thông tin sản phẩm theo id sản phẩm (ảnh, tên, giá)
function get_product_info($product_id)
{
    $sql = "SELECT product_thumb, product_title, price_new FROM list_products WHERE id = {$product_id}";
    $result = db_fetch_row($sql); // giả sử trả về 1 row assoc
    return $result;
}

// function get_order_summary($order_id)
// {
//     $items = db_fetch_array("SELECT quantity, sub_total FROM tbl_order_items WHERE order_id = {$order_id}");

//     $quantity = 0;
//     $sub_total = 0;

//     foreach ($items as $item) {
//         $quantity += $item['quantity'];
//         $sub_total += $item['sub_total'];
//     }

//     return [
//         'quantity' => $quantity,
//         'sub_total' => $sub_total,
//     ];
// }

function get_order_summary($order_id)
{
    $order = db_fetch_row("SELECT quantity, sub_total FROM tbl_orders WHERE id = {$order_id}");
    return [
        'quantity' => $order['quantity'] ?? 0,
        'sub_total' => $order['sub_total'] ?? 0,
    ];
}
