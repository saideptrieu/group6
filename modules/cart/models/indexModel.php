<?php

/**
 * Lấy thông tin sản phẩm từ ID
 * @param int $id ID sản phẩm
 * @return array|bool Thông tin sản phẩm hoặc false nếu không tìm thấy
 */
function get_product_by_id($id)
{
    // In ra thông báo để kiểm tra ID sản phẩm
    echo "<!-- Đang lấy sản phẩm ID: {$id} -->";

    // Lấy thông tin sản phẩm từ database
    $item = db_fetch_row("SELECT * FROM `list_products` WHERE `id` = {$id}");

    // Nếu không tìm thấy, thử lấy từ bảng list_products theo kiểu khác
    if (empty($item)) {
        // Thử lấy dữ liệu từ mảng tất cả sản phẩm
        $list_products = db_fetch_array("SELECT * FROM `list_products`");
        foreach ($list_products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }
        // In ra thông báo lỗi
        echo "<!-- Không tìm thấy sản phẩm ID: {$id} -->";
        return false;
    }

    return $item;
}

/**
 * Thêm sản phẩm vào giỏ hàng
 * @param int $id ID sản phẩm
 * @param int $qty Số lượng (mặc định: 1)
 * @return bool Trạng thái thành công
 */
function add_cart($id, $qty = 1)
{
    $product = get_product_by_id($id);
    if (!$product)
        return false;

    // Khởi tạo giỏ hàng trong session nếu chưa tồn tại
    if (!isset($_SESSION['cart']))
        $_SESSION['cart'] = array();

    // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $qty;
    } else {
        $_SESSION['cart'][$id] = array(
            'id' => $product['id'],
            'product_code' => isset($product['product_code']) ? $product['product_code'] : 'PD' . $product['id'],
            'product_name' => $product['product_title'],
            'price' => $product['price_new'],
            'thumbnail' => $product['product_thumb'],
            'qty' => $qty,
            'sub_total' => $product['price_new'] * $qty
        );
    }

    // Cập nhật thành tiền
    $_SESSION['cart'][$id]['sub_total'] = $_SESSION['cart'][$id]['price'] * $_SESSION['cart'][$id]['qty'];
    update_info_cart();
    return true;
}

/**
 * Cập nhật số lượng sản phẩm trong giỏ hàng
 * @param int $id ID sản phẩm
 * @param int $qty Số lượng mới
 * @return bool Trạng thái thành công
 */
function update_cart($id, $qty)
{
    if (isset($_SESSION['cart'][$id])) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['qty'] = $qty;
            $_SESSION['cart'][$id]['sub_total'] = $_SESSION['cart'][$id]['price'] * $qty;
        }
        update_info_cart();
        return true;
    }
    return false;
}

/**
 * Xóa sản phẩm khỏi giỏ hàng
 * @param int $id ID sản phẩm
 * @return bool Trạng thái thành công
 */
function delete_cart($id)
{
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        update_info_cart();
        return true;
    }
    return false;
}

/**
 * Lấy dữ liệu giỏ hàng
 * @return array Các mục trong giỏ hàng
 */
function get_cart_items()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart'];
    }
    return array();
}

/**
 * Cập nhật thông tin giỏ hàng (tổng số mục, tổng giá)
 */
function update_info_cart()
{
    $num_order = 0;
    $total = 0;

    // Tạo mảng tạm để lưu thông tin giỏ hàng
    $temp_cart = [];

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $item) {
            // Bỏ qua key 'info' khi duyệt mảng giỏ hàng
            if ($id === 'info')
                continue;

            if (isset($item['qty'])) {
                $num_order += $item['qty'];
                $total += $item['sub_total'];
                // Lưu lại item vào mảng tạm
                $temp_cart[$id] = $item;
            }
        }
    }

    // Gán lại giỏ hàng và thêm thông tin
    $_SESSION['cart'] = $temp_cart;
    $_SESSION['cart']['info'] = [
        'num_order' => $num_order,
        'total' => $total
    ];

    // In ra thông báo để debug
    echo "<!-- Đã cập nhật giỏ hàng: {$num_order} sản phẩm, tổng tiền: {$total} -->";
}

/**
 * Lấy tổng số sản phẩm trong giỏ hàng
 * @return int Số lượng sản phẩm
 */
function get_num_order_cart()
{
    if (isset($_SESSION['cart']['info'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return 0;
}

/**
 * Lấy tổng giá trong giỏ hàng
 * @return float Tổng giá
 */
function get_total_cart()
{
    if (isset($_SESSION['cart']['info'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return 0;
}

/**
 * Xóa giỏ hàng
 */
function destroy_cart()
{
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}
