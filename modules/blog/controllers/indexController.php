<?php

// Hàm khởi tạo (bắt buộc để tránh lỗi construct)
function construct()
{
    load_model('index');
}

// Hàm xử lý action show_list_blog (đúng theo URL: ?mod=blog&controller=index&action=show_list_blog)
function show_list_blogAction()
{
    // Lấy tổng số dòng
    $num_rows = db_num_rows("SELECT * FROM `tbl_blog`");

    // Cấu hình phân trang
    $num_per_page = 6;
    $total_pages = ceil($num_rows / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page, 1); // tránh lỗi page <= 0

    // Tính vị trí bắt đầu lấy bài viết
    $start = ($page - 1) * $num_per_page;

    // Lấy danh sách bài viết từ model
    $list_post = get_list_post($start, $num_per_page);

    // Gửi dữ liệu sang view
    $data = array(
        'list_post' => $list_post,
        'page' => $page,
        'total_pages' => $total_pages,
    );

    load_view('index', $data);
}

function indexAction()
{
    show_list_blogAction(); // Gọi lại action kia
}


function detailAction()//Chi tiết bài viết
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id <= 0) {
        echo "Thiếu ID bài viết.";
        return;
    }

    $post = get_post_by_id($id);//lấy bài viết theo id thông qua hàm trong model

    if (empty($post)) {
        echo "Bài viết không tồn tại.";
        return;
    }

    // Lấy tên danh mục nếu có
    $category_name = 'Không rõ';
    if (!empty($post['category_id'])) {
        $category_name = get_category_name($post['category_id']);
    }

    // Gửi dữ liệu qua view
    $data = [
        'post' => $post,
        'category_name' => $category_name
    ];

    load_view('detail', $data);
}

function policyAction()
{
    load_view('policy');
}

function warrantyAction()
{
    load_view('warranty');
}

function membershipAction()
{
    load_view('membership');
}

function deliveryAction()
{
    load_view('delivery');
}

function aboutAction()
{
    load_view('about');
}
