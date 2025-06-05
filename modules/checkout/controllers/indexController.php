<?php

function construct()
{
    load_model('index');
    if (!isset($_SESSION)) {
        session_start();
    }
}

function orderAction()
{
    global $conn;
    // Thiết lập múi giờ PHP
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // Thiết lập timezone MySQL (tùy chọn)
    mysqli_query($conn, "SET time_zone = '+07:00'");

    if (isset($_POST['btn_order'])) {
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $note = mysqli_real_escape_string($conn, $_POST['note']);
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
        $created_at = date('Y-m-d H:i:s');

        // Tính tổng quantity và sub_total từ giỏ hàng
        $total_quantity = 0;
        $total_sub_total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_quantity += intval($item['qty']);
            $total_sub_total += floatval($item['sub_total']);
        }

        // Thêm đơn hàng với tổng quantity và sub_total tính được
        $sql_order = "INSERT INTO tbl_orders (fullname, email, address, phone, quantity, sub_total, note, payment_method, created_at) 
                      VALUES ('$fullname', '$email', '$address', '$phone', '$total_quantity', '$total_sub_total', '$note', '$payment_method', '$created_at')";
        mysqli_query($conn, $sql_order);

        $order_id = mysqli_insert_id($conn);

        // Thêm sản phẩm từ giỏ hàng
        foreach ($_SESSION['cart'] as $item) {
            if (!isset($item['id']) || !isset($item['qty']) || !isset($item['sub_total'])) {
                continue; // bỏ qua nếu thiếu thông tin
            }
            $product_id = intval($item['id']);
            $qty = intval($item['qty']);
            $sub_total_item = floatval($item['sub_total']);

            $sql_item = "INSERT INTO tbl_order_items (order_id, product_id, quantity, sub_total) 
                         VALUES ($order_id, $product_id, $qty, $sub_total_item)";
            mysqli_query($conn, $sql_item);
        }

        // Cập nhật trạng thái đơn hàng
        if ($payment_method == 'cod') {
            $status = "Đang vận chuyển";
        } else {
            $status = "Đã thanh toán, đang vận chuyển";
        }
        $sql_status = "UPDATE tbl_orders SET status = '$status' WHERE id = $order_id";
        mysqli_query($conn, $sql_status);

        // Xoá giỏ hàng
        unset($_SESSION['cart']);

        // Điều hướng
        if ($payment_method == 'cod') {
            header("Location: ?mod=checkout&action=success&order_id=$order_id");
        } else {
            header("Location: ?mod=checkout&action=vnpay&order_id=$order_id&sub_total=$total_sub_total");
        }
        exit;
    }
}


function vnpayAction()
{

    date_default_timezone_set('Asia/Ho_Chi_Minh');



    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    $sub_total = isset($_GET['sub_total']) ? floatval($_GET['sub_total']) : 0;

    // Nếu thiếu dữ liệu thì dừng
    if ($order_id <= 0 || $sub_total <= 0) {
        echo "Thiếu thông tin đơn hàng hoặc tổng tiền!";
        return;
    }

    $vnp_TmnCode = "8GMNEUS5"; // Website ID
    $vnp_HashSecret = "DBQB3J48D8PRA4PIWORZPC6QZZZ9UFW8"; // Secret key
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost/unitop.vn/pickleballshop/" . "?mod=checkout&action=success&order_id=" . $order_id;

    $vnp_TxnRef = time() . ""; // Mã đơn hàng
    $vnp_OrderInfo = "Thanh toán đơn hàng #" . $order_id;
    $vnp_OrderType = "billpayment";
    $vnp_Amount = $sub_total * 100; // VNPay cần đơn vị là VND x 100
    $vnp_Locale = "vn";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $vnp_CreateDate = date('YmdHis');
    $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => $vnp_CreateDate,
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $vnp_ExpireDate
    );

    if (!empty($vnp_BankCode)) {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    // Tạo chuỗi query và hash
    ksort($inputData);
    $query = '';
    $hashdata = '';
    $i = 0;
    foreach ($inputData as $key => $value) {
        $encodedKey = urlencode($key);
        $encodedValue = urlencode($value);
        if ($i == 1) {
            $hashdata .= '&' . $encodedKey . '=' . $encodedValue;
        } else {
            $hashdata .= $encodedKey . '=' . $encodedValue;
            $i = 1;
        }
        $query .= $encodedKey . '=' . $encodedValue . '&';
    }

    $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= '?' . $query . 'vnp_SecureHash=' . $vnp_SecureHash;

    // Chuyển hướng tới cổng thanh toán
    header('Location: ' . $vnp_Url);
    exit;
}

function successAction()
{
    $order_id = $_GET['order_id'] ?? 0;
    $data['order_id'] = $order_id;
    load_view('success', $data);
}

// Hàm hỗ trợ chuyển hướng
function redirect($url)
{
    header("Location: {$url}");
    exit;
}

function listOrderAction()
{
    global $conn;

    $keyword = '';
    $is_search = false;  // biến kiểm tra đã search hay chưa
    if (isset($_GET['sm_s'])) {  // submit form tìm kiếm
        $keyword = trim(mysqli_real_escape_string($conn, $_GET['s']));
        $is_search = true;
    }

    $orders = [];

    if ($is_search && $keyword !== '') {
        $sql = "SELECT * FROM `tbl_orders` 
                WHERE `fullname` LIKE '%$keyword%' OR `phone` LIKE '%$keyword%' 
                ORDER BY id DESC";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[$row['id']] = $row;
            }

            $orders = array_values($orders);

            $order_ids = array_column($orders, 'id');
            $order_ids_str = implode(',', array_map('intval', $order_ids));

            $order_items = [];
            if (!empty($order_ids_str)) {
                $sql_items = "SELECT * FROM `tbl_order_items` WHERE `order_id` IN ($order_ids_str)";
                $result_items = mysqli_query($conn, $sql_items);

                if ($result_items) {
                    $order_items = mysqli_fetch_all($result_items, MYSQLI_ASSOC);
                }

                foreach ($orders as &$order) {
                    $total_qty = 0;
                    $sub_total = 0;

                    foreach ($order_items as $item) {
                        if ($item['order_id'] == $order['id']) {
                            $total_qty += $item['quantity'];
                            $sub_total += $item['sub_total'];
                        }
                    }

                    $order['total_qty'] = $total_qty;
                    $order['sub_total'] = $sub_total;
                }
            }
        }
    }

    $data = [
        'orders' => $orders,
        'keyword' => $keyword,
        'is_search' => $is_search,
    ];

    load_view('listOrder', $data);
}

function detailOrderAction()
{
    $order_id = $_GET['order_id'];
    $info_order = get_info_order($order_id);
    $order_items = get_order_items($order_id);
    $order_summary = get_order_summary($order_id);

    // Lấy thêm thông tin sản phẩm vào từng item
    if (!empty($order_items)) {
        foreach ($order_items as &$item) {
            $product_info = get_product_info($item['product_id']);
            $item['product_thumb'] = $product_info['product_thumb'] ?? '';
            $item['product_title'] = $product_info['product_title'] ?? '';
            $item['price_new'] = $product_info['price_new'] ?? 0;
        }
    }

    $data = [
        'id' => $order_id,
        'info_order' => $info_order,
        'order_items' => $order_items,
        'order_summary' => $order_summary
    ];

    load_view('detailOrder', $data);
}
