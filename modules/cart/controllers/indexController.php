<?php
function construct()
{
    // Bắt đầu session nếu chưa được khởi tạo
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    load_model('index');
}

// Hiển thị nội dung giỏ hàng
function indexAction()
{
    $data['cart_items'] = get_cart_items();
    $data['num_order'] = get_num_order_cart();
    $data['total'] = get_total_cart();
    load_view('index', $data);
}

// Xử lý quy trình thanh toán
function checkoutAction()
{
    $data['cart_items'] = get_cart_items();
    $data['num_order'] = get_num_order_cart();
    $data['total'] = get_total_cart();
    load_view('checkout', $data);
}

// Thêm sản phẩm vào giỏ hàng
function addAction()
{
    // Bắt đầu session nếu chưa được khởi tạo
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Lấy thông tin từ request
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $qty = isset($_GET['qty']) ? (int) $_GET['qty'] : 1;

    // Lưu URL trang hiện tại để quay lại sau khi thêm vào giỏ
    $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '?mod=home';

    // Debug thông tin
    echo "<!-- DEBUG: Thêm sản phẩm ID={$id}, Số lượng={$qty} -->";

    if ($id > 0) {
        // Gọi hàm thêm vào giỏ hàng
        $result = add_cart($id, $qty);
        echo "<!-- DEBUG: Kết quả thêm vào giỏ hàng: " . ($result ? "Thành công" : "Thất bại") . " -->";

        // Hiển thị thông tin giỏ hàng sau khi thêm
        $cart_info = get_cart_items();
        if (!empty($cart_info)) {
            echo "<!-- DEBUG: Giỏ hàng sau khi thêm: " . count($cart_info) . " mục -->";
            foreach ($cart_info as $key => $item) {
                if ($key !== 'info') {
                    echo "<!-- DEBUG: Sản phẩm trong giỏ: ID={$key}, Tên={$item['product_name']}, SL={$item['qty']} -->";
                }
            }

            // Thêm thông báo thành công vào session
            $_SESSION['cart_message'] = "Sản phẩm đã được thêm vào giỏ hàng!";
        } else {
            echo "<!-- DEBUG: Giỏ hàng trống sau khi thêm -->";
            $_SESSION['cart_message'] = "Không thể thêm sản phẩm vào giỏ hàng!";
        }

        // Chuyển hướng trở lại trang trước đó thay vì đến trang giỏ hàng
        redirect($redirect_url);
    } else {
        echo "<!-- DEBUG: ID sản phẩm không hợp lệ -->";
        redirect("?mod=home");
    }
}

// Cập nhật số lượng sản phẩm trong giỏ hàng
function updateAction()
{
    if (isset($_POST['update_cart'])) {
        if (isset($_POST['qty'])) {
            foreach ($_POST['qty'] as $id => $qty) {
                update_cart($id, $qty);
            }
        }
    }
    redirect("?mod=cart");
}

// Cập nhật số lượng sản phẩm trong giỏ hàng qua AJAX
function ajaxUpdateAction()
{
    // Bắt đầu session nếu chưa được khởi tạo
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $response = array(
        'success' => false,
        'message' => 'Không có dữ liệu cập nhật',
        'cart_info' => array()
    );

    if (isset($_POST['id']) && isset($_POST['qty'])) {
        $id = (int) $_POST['id'];
        $qty = (int) $_POST['qty'];

        if ($id > 0) {
            $result = update_cart($id, $qty);
            if ($result) {
                $response['success'] = true;
                $response['message'] = 'Cập nhật giỏ hàng thành công';

                // Lấy thông tin giỏ hàng mới
                $cart_items = get_cart_items();
                $response['cart_info'] = array(
                    'total_quantity' => get_num_order_cart(),
                    'total_price' => get_total_cart(),
                    'formatted_total' => number_format(get_total_cart(), 0, ',', '.') . 'đ'
                );

                if (isset($cart_items[$id])) {
                    $response['item'] = array(
                        'id' => $id,
                        'qty' => $cart_items[$id]['qty'],
                        'sub_total' => $cart_items[$id]['sub_total'],
                        'formatted_sub_total' => number_format($cart_items[$id]['sub_total'], 0, ',', '.') . 'đ'
                    );
                }
            } else {
                $response['message'] = 'Không tìm thấy sản phẩm trong giỏ hàng';
            }
        } else {
            $response['message'] = 'ID sản phẩm không hợp lệ';
        }
    }

    // Trả về kết quả dạng JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Xóa sản phẩm khỏi giỏ hàng
function deleteAction()
{
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $redirect_url = isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'mod=cart') !== false
        ? $_SERVER['HTTP_REFERER']
        : "?mod=cart";

    if ($id > 0) {
        if (delete_cart($id)) {
            $_SESSION['cart_message'] = "Đã xóa sản phẩm khỏi giỏ hàng!";
        }
    }
    redirect($redirect_url);
}

// Xóa toàn bộ giỏ hàng
function destroyAction()
{
    destroy_cart();
    $_SESSION['cart_message'] = "Đã xóa toàn bộ giỏ hàng!";
    redirect("?mod=cart");
}

// Mua ngay - thêm sản phẩm và chuyển thẳng đến trang thanh toán
function buyNowAction()
{
    // Bắt đầu session nếu chưa được khởi tạo
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $qty = isset($_GET['qty']) ? (int) $_GET['qty'] : 1;

    // Debug thông tin
    echo "<!-- DEBUG: Mua ngay - sản phẩm ID={$id}, Số lượng={$qty} -->";

    if ($id > 0) {
        // Xóa giỏ hàng hiện tại (để chỉ có sản phẩm mua ngay)
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        // Thêm sản phẩm vào giỏ hàng
        $result = add_cart($id, $qty);
        echo "<!-- DEBUG: Kết quả thêm vào giỏ hàng: " . ($result ? "Thành công" : "Thất bại") . " -->";

        // Thêm thông báo vào session
        if ($result) {
            $_SESSION['cart_message'] = "Sản phẩm đã được thêm vào giỏ hàng và chuyển đến thanh toán!";
        } else {
            $_SESSION['cart_message'] = "Không thể thêm sản phẩm vào giỏ hàng!";
        }

        // Chuyển hướng đến trang thanh toán
        redirect("?mod=cart&action=checkout");
    } else {
        echo "<!-- DEBUG: ID sản phẩm không hợp lệ -->";
        redirect("?mod=home");
    }
}

// Hàm hỗ trợ chuyển hướng
function redirect($url)
{
    header("Location: {$url}");
    exit;
}
