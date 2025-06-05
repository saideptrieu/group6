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
    // Lấy các tham số lọc
    $cat_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;
    $sort = isset($_GET['sort']) ? (int)$_GET['sort'] : 0;

    // Xây dựng câu truy vấn cơ bản
    $sql = "SELECT * FROM `list_products`";
    $where = array();

    // Thêm điều kiện lọc theo danh mục
    if ($cat_id > 0) {
        $where[] = "`cat_id` = {$cat_id}";
    }

    // Thêm điều kiện WHERE nếu có
    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    // Thêm điều kiện sắp xếp
    switch ($sort) {
        case 1: // A-Z
            $sql .= " ORDER BY `product_title` ASC";
            break;
        case 2: // Z-A
            $sql .= " ORDER BY `product_title` DESC";
            break;
        case 3: // Giá cao xuống thấp
            $sql .= " ORDER BY `price_new` DESC";
            break;
        case 4: // Giá thấp lên cao
            $sql .= " ORDER BY `price_new` ASC";
            break;
        default:
            $sql .= " ORDER BY `id` DESC";
    }

    // Lấy tổng số sản phẩm
    $total_row = db_num_rows($sql);

    // Số lượng sản phẩm trên mỗi trang
    $num_per_page = 8;

    // Tổng số trang
    $num_page = ceil($total_row / $num_per_page);

    // Trang hiện tại
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $page = max(1, min($page, $num_page)); // Đảm bảo trang nằm trong khoảng hợp lệ

    // Vị trí bắt đầu của mỗi trang
    $start = ($page - 1) * $num_per_page;

    // Thêm LIMIT vào câu truy vấn
    $sql .= " LIMIT {$start}, {$num_per_page}";

    // Lấy danh sách sản phẩm
    $list_products = db_fetch_array($sql);

    // Chuẩn bị dữ liệu cho view
    $data = array(
        'list_products' => $list_products,
        'total_row' => $total_row,
        'num_per_page' => $num_per_page,
        'num_page' => $num_page,
        'page' => $page,
        'cat_id' => $cat_id,
        'sort' => $sort
    );

    load_view('index', $data);
}

function detailAction()
{
    // Lấy ID sản phẩm từ URL
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : 0;
    $data['list_featured'] =  get_featured_products($cat_id);
    $data['item'] = get_list_products_by_cat_id($cat_id);

    if ($id > 0) {
        // Lấy thông tin sản phẩm từ ID
        $item = get_product_by_id($id);

        if (!$item) {
            // Nếu không tìm thấy sản phẩm, chuyển hướng về trang sản phẩm
            redirect("?mod=product");
            return;
        }

        // Truyền dữ liệu sản phẩm sang view
        $data['item'] = $item;

        // Lấy các sản phẩm cùng danh mục
        if (isset($item['cat_id'])) {
            $data['related_products'] = get_list_products_by_cat_id($item['cat_id']);
        }

        load_view('detail', $data);
    } else {
        // Nếu không có ID hợp lệ, chuyển hướng về trang sản phẩm
        redirect("?mod=product");
    }
}

// Hàm hỗ trợ chuyển hướng
function redirect($url)
{
    header("Location: {$url}");
    exit;
}
