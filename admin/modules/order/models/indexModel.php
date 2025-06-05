<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

// Lấy danh sách đơn hàng
if (!function_exists('get_list_orders')) {
    function get_list_orders() {
        return db_fetch_array("SELECT * FROM `tbl_orders`");
    }
}

if (!function_exists('get_order_by_id')) {
    function get_order_by_id($id) {
        return db_fetch_row("SELECT * FROM `tbl_orders` WHERE `id` = {$id}");
    }
}

if (!function_exists('add_order')) {
    function add_order($data) {
        if (!empty($data['fullname'])) {
            db_insert("tbl_customers", $data);
        }
        return db_insert('tbl_orders', $data);
    }
}

if (!function_exists('update_order')) {
    function update_order($data, $id) {
        return db_update('tbl_orders', $data, "`id` = {$id}");
    }
}

if (!function_exists('delete_order')) {
    function delete_order($id) {
        return db_delete('tbl_orders', "`id` = {$id}");
    }
}

if (!function_exists('count_orders')) {
    function count_orders($where = "1=1") {
        $sql = "SELECT COUNT(*) as total FROM `tbl_orders` WHERE {$where}";
        $result = db_fetch_row($sql);
        return $result['total'];
    }
}

if (!function_exists('get_orders_paged')) {
    function get_orders_paged($where = "1=1", $limit = 7, $offset = 0) {
        $sql = "SELECT * FROM `tbl_orders` WHERE {$where} ORDER BY `created_at` DESC LIMIT {$offset}, {$limit}";
        return db_fetch_array($sql);
    }
}

if (!function_exists('calculate_order_summary')) {
    function calculate_order_summary($order_id) {
        $sql = "
            SELECT 
                SUM(quantity) AS quantity,
                SUM(sub_total) AS sub_total
            FROM tbl_order_items
            WHERE order_id = {$order_id}";
        return db_fetch_row($sql);
    }
}

if (!function_exists('update_order_summary')) {
    function update_order_summary($order_id) {
        $summary = calculate_order_summary($order_id);
        if ($summary) {
            $data = [
                'quantity' => $summary['quantity'],
                'sub_total'    => $summary['sub_total']
            ];
            return db_update('tbl_orders', $data, "`id` = {$order_id}");
        }
        return false;
    }
}
