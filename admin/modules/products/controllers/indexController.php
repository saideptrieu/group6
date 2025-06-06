<?php

function construct()
{
    load_model('index');
}

function listProductAction()
{
    $search = isset($_GET['s']) ? $_GET['s'] : '';
    $data = [
        'products' => list_products($search),
        'total_products' => count_products(),
        'search' => $search 
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

function listCatAction()
{
    $search = isset($_GET['s']) ? $_GET['s'] : '';
    $data = [
        'categories' => get_categories($search),
        'total_categories' => count_categories(),
        'search' => $search
    ];
    load_view('listCat', $data);
}

function addCatAction()
{
    global $error;
    $error = [];

    if (isset($_POST['btn-submit'])) {
        // Validate category title
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Không được để trống tên danh mục";
        } else {
            $cat_title = trim($_POST['cat_title']);
            if (strlen($cat_title) < 2) {
                $error['cat_title'] = "Tên danh mục phải có ít nhất 2 ký tự";
            } elseif (strlen($cat_title) > 100) {
                $error['cat_title'] = "Tên danh mục không được quá 100 ký tự";
            } elseif (category_title_exists($cat_title)) {
                $error['cat_title'] = "Tên danh mục đã tồn tại";
            }
        }

        // If no errors, add category
        if (empty($error)) {
            $data = [
                'cat_title' => $cat_title
            ];

            if (add_category($data)) {
                redirect("?mod=products&action=listCat");
            } else {
                $error['general'] = "Có lỗi xảy ra khi thêm danh mục";
            }
        }
    }

    load_view('addCat');
}

function editCatAction()
{
    global $error;
    $error = [];

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if (!$id) {
        redirect("?mod=products&action=listCat");
    }

    $category = get_category_by_id($id);
    if (!$category) {
        redirect("?mod=products&action=listCat");
    }

    if (isset($_POST['btn-update'])) {
        // Validate category title
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Không được để trống tên danh mục";
        } else {
            $cat_title = trim($_POST['cat_title']);
            if (strlen($cat_title) < 2) {
                $error['cat_title'] = "Tên danh mục phải có ít nhất 2 ký tự";
            } elseif (strlen($cat_title) > 100) {
                $error['cat_title'] = "Tên danh mục không được quá 100 ký tự";
            } elseif (category_title_exists($cat_title, $id)) {
                $error['cat_title'] = "Tên danh mục đã tồn tại";
            }
        }

        // If no errors, update category
        if (empty($error)) {
            $data = [
                'cat_title' => $cat_title
            ];

            if (update_category($id, $data)) {
                redirect("?mod=products&action=listCat");
            } else {
                $error['general'] = "Có lỗi xảy ra khi cập nhật danh mục";
            }
        }
    }

    $data = [
        'category' => $category
    ];
    load_view('editCat', $data);
}

function deleteCatAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if (!$id) {
        redirect("?mod=products&action=listCat");
    }

    // Check if category exists
    $category = get_category_by_id($id);
    if (!$category) {
        redirect("?mod=products&action=listCat");
    }

    // Check if category has products
    $product_count = count_products_by_cat($id);
    if ($product_count > 0) {
        // Redirect with error message
        redirect("?mod=products&action=listCat&error=has_products");
    }

    // Delete category
    if (delete_category($id)) {
        redirect("?mod=products&action=listCat&success=deleted");
    } else {
        redirect("?mod=products&action=listCat&error=delete_failed");
    }
}
