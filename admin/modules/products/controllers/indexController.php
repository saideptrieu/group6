<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function listPostAction()
{
    load_view('listPost');
}

function addPageAction()
{
    load_view('addPage');
}

function listPageAction()
{
    load_view('listPage');
}

function addPostAction()
{
    load_view('addPost');
}

function listCatAction()
{
    load_view('listCat');
}

function listProductAction()
{
    $search = isset($_GET['s']) ? $_GET['s'] : '';
    $data = [
        'products' => list_products($search),
        'total_products' => count_products()
    ];
    load_view('listProduct', $data);
}

function addProductAction()
{
    global $error;
    $error = [];

    if (isset($_POST['btn-submit'])) {
        // Validate dữ liệu
        if (empty($_POST['product_title'])) {
            $error['product_title'] = "Không được để trống tên sản phẩm";
        }

        if (empty($_POST['price_new'])) {
            $error['price_new'] = "Không được để trống giá mới";
        } elseif (!is_numeric($_POST['price_new'])) {
            $error['price_new'] = "Giá phải là số";
        }

        if (!empty($_POST['price_old']) && !is_numeric($_POST['price_old'])) {
            $error['price_old'] = "Giá cũ phải là số";
        }

        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Bạn cần chọn danh mục";
        }

        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống mô tả";
        }

        // Xử lý link ảnh
        $product_thumb = isset($_POST['product_image']) ? trim($_POST['product_image']) : '';
        if (empty($product_thumb)) {
            $error['product_thumb'] = "Bạn cần nhập link ảnh.";
        } elseif (!filter_var($product_thumb, FILTER_VALIDATE_URL)) {
            $error['product_thumb'] = "Link ảnh không hợp lệ.";
        }

        // Nếu không có lỗi, thêm sản phẩm
        if (empty($error)) {
            $data = [
                'product_title' => $_POST['product_title'],
                'price_new' => $_POST['price_new'],
                'price_old' => !empty($_POST['price_old']) ? $_POST['price_old'] : 0,
                'product_desc' => $_POST['product_desc'],
                'product_content' => $_POST['product_content'],
                'product_thumb' => $product_thumb,
                'cat_id' => $_POST['cat_id'],
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0
            ];

            add_product($data);
            redirect("?mod=products&action=listProduct");
        }
    }

    $data = [
        'categories' => get_categories(),
        'form_values' => $_POST,
        'error' => $error
    ];

    load_view('addProduct', $data);
}


function editProductAction()
{
    global $error;
    $error = [];

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        redirect("?mod=products&action=listProduct");
    }

    $product = get_product_by_id($id);
    if (!$product) {
        redirect("?mod=products&action=listProduct");
    }

    if (isset($_POST['btn-update'])) {
        // Validate dữ liệu
        if (empty($_POST['product_title'])) {
            $error['product_title'] = "Không được để trống tên sản phẩm";
        }

        if (empty($_POST['price_new'])) {
            $error['price_new'] = "Không được để trống giá mới";
        } elseif (!is_numeric($_POST['price_new'])) {
            $error['price_new'] = "Giá phải là số";
        }

        if (!empty($_POST['price_old']) && !is_numeric($_POST['price_old'])) {
            $error['price_old'] = "Giá cũ phải là số";
        }

        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Bạn cần chọn danh mục";
        }

        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống mô tả";
        }

        $product_thumb = isset($_POST['product_image']) ? trim($_POST['product_image']) : '';
        if (empty($product_thumb)) {
            $error['product_thumb'] = "Bạn cần nhập link ảnh sản phẩm.";
        } elseif (!filter_var($product_thumb, FILTER_VALIDATE_URL)) {
            $error['product_thumb'] = "Link ảnh không hợp lệ.";
        }

        // Nếu không có lỗi, cập nhật sản phẩm
        if (empty($error)) {
            $data = [
                'product_title' => $_POST['product_title'],
                'price_new' => $_POST['price_new'],
                'price_old' => !empty($_POST['price_old']) ? $_POST['price_old'] : 0,
                'product_desc' => $_POST['product_desc'],
                'product_content' => $_POST['product_content'],
                'product_thumb' => $product_thumb,
                'cat_id' => $_POST['cat_id'],
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0
            ];

            update_product($id, $data);
            redirect("?mod=products&action=listProduct");
        }
    }

    $data = [
        'product' => $product,
        'categories' => get_categories(),
        'form_values' => $_POST,
        'error' => $error
    ];

    load_view('editProduct', $data);
}


function deleteProductAction()
{
    $id = (int)$_GET['id'];
    if ($id) {
        delete_product($id);
    }

    redirect("?mod=products&action=listProduct");
}

function toggleFeaturedAction()
{
    $id = (int)$_GET['id'];
    $status = (int)$_GET['status'];

    if ($id) {
        toggle_featured($id, $status ? 0 : 1);
    }

    redirect("?mod=products&action=listProduct");
}

function listCustomerAction()
{
    load_view('listCustomer');
}

function listOrderAction()
{
    load_view('listOrder');
}

function menuAction()
{
    load_view('menu');
}

function addSliderAction()
{
    load_view('addSlider');
}

function listSliderAction()
{
    load_view('listSlider');
}

function addWidgetAction()
{
    load_view('addWidget');
}

function listWidgetAction()
{
    load_view('listWidget');
}

function updateAction() {}
