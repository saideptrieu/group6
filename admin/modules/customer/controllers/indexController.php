<?php

defined('APPPATH') or exit('Không được quyền truy cập phần này');
require_once __DIR__ . '/../models/indexModel.php';

if (!function_exists('construct')) {
    function construct()
    {
        load_model('index'); // indexModel.php
    }
}

function list_customerAction()
{
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $per_page = 10;
    $offset = ($page - 1) * $per_page;

    $where = "1=1";
    if (!empty($status)) {
        $where .= " AND status = '" . addslashes($status) . "'";
    }

    $total = count_rows("tbl_orders", $where);
    $total_pages = ceil($total / $per_page);

    $sql = "SELECT * FROM tbl_orders WHERE {$where} ORDER BY id DESC LIMIT {$offset}, {$per_page}";
    $customers = db_fetch_array($sql);

    // ❗ Thêm dòng này: truyền $status, $page, $total_pages
    load_view('customerList', compact('customers', 'status', 'page', 'total_pages'));
}

function add_customerAction()
{
    if (isset($_POST['btn_add'])) {
        $data = [
            'fullname'       => $_POST['fullname'],
            'email'          => $_POST['email'],
            'address'        => $_POST['address'],
            'phone'          => $_POST['phone'],
            'quantity' => (int)$_POST['quantity'],
            'sub_total'    => (float)$_POST['sub_total'],
            'status'         => $_POST['status'],
            'note'           => $_POST['note'],
            'payment_method' => $_POST['payment_method'],
            'created_at'     => date('Y-m-d H:i:s')
        ];
        add_customer_db($data);
        redirect('?mod=customer&action=list_customer');
    }
    load_view('addCustomer');
}

function edit_customerAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $customer = get_customer_by_id($id);

    if (isset($_POST['btn_update'])) {
        $data = [
            'code'           => $_POST['code'],
            'fullname'       => $_POST['fullname'],
            'email'          => $_POST['email'],
            'address'        => $_POST['address'],
            'phone'          => $_POST['phone'],
            'note'           => $_POST['note'],
            'status'         => $_POST['status'],
            'payment_method' => $_POST['payment_method']
        ];
        update_customer($data, $id);
        redirect('?mod=customer&action=list_customer');
    }

    load_view('editCustomer', compact('customer'));
}

function detail_customerAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $customer = get_customer_by_id($id);
    load_view('detailCustomer', compact('customer'));
}

function delete_customerAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    delete_customer_db($id);
    redirect('?mod=customer&action=list_customer');
}
