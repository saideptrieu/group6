<?php

defined('APPPATH') or exit('Không được quyền truy cập phần này');

if (!function_exists('get_list_customers')) {
    function get_list_customers()
    {
        return db_fetch_array("SELECT * FROM tbl_orders ORDER BY id DESC");
    }
}

if (!function_exists('get_customer_by_id')) {
    function get_customer_by_id($id)
    {
        return db_fetch_row("SELECT * FROM tbl_orders WHERE id = {$id}");
    }
}

if (!function_exists('add_customer_db')) {
    function add_customer_db($data)
    {
        if (!empty($data['fullname'])) {
            db_insert("tbl_orders", $data);
        }
    }
}

if (!function_exists('update_customer')) {
    function update_customer($data, $id)
    {
        return db_update('tbl_orders', $data, "`id` = {$id}");
    }
}

if (!function_exists('delete_customer_db')) {
    function delete_customer_db($id)
    {
        return db_delete('tbl_orders', "`id` = {$id}");
    }
}
if (!function_exists('count_rows')) {
    function count_rows($table, $where = "1=1")
    {
        $sql = "SELECT COUNT(*) AS total FROM {$table} WHERE {$where}";
        $row = db_fetch_row($sql);
        return $row['total'] ?? 0;
    }
}
