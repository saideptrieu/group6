<?php


// Nạp model
require_once MODULESPATH . DIRECTORY_SEPARATOR . 'blog' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'indexModel.php';

// Hàm khởi tạo (bắt buộc để tránh lỗi construct)
function construct()
{
    // Có thể load model nếu chưa require ở trên
    // load_model('index');
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
        'total_pages' => $total_pages
    );

    load_view('index', $data);
}

function indexAction()
{
    show_list_blogAction(); // Gọi lại action kia
}

function detailAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id > 0) {
        $post = get_post_by_id($id);

        if (!empty($post)) {
            $data['post'] = $post;
            load_view('detail', $data);
        } else {
            echo "Bài viết không tồn tại.";
        }
    } else {
        echo "Thiếu ID bài viết.";
    }
}



function add_postAction()
{
    if (isset($_POST['btn_submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $content = $_POST['content'];
        $image = '';

        // Xử lý ảnh
        if (!empty($_FILES['image']['name'])) {
            $upload_dir = 'public/images/';
            $image_name = time() . '-' . basename($_FILES['image']['name']);
            $upload_path = $upload_dir . $image_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image = $image_name;
            }
        }

        // Gọi model để lưu
        insert_post($title, $description, $content, $image);
        echo "Thêm bài viết thành công!";
    }

    load_view('add'); // Hiển thị form
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
