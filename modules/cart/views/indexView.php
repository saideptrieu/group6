<?php
get_header();
?>

<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=cart" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php
        // Kiểm tra nếu có sản phẩm trong giỏ hàng (loại bỏ phần tử 'info')
        $has_items = false;
        if (isset($cart_items) && !empty($cart_items)) {
            foreach ($cart_items as $key => $item) {
                if ($key !== 'info' && isset($item['id'])) {
                    $has_items = true;
                    break;
                }
            }
        }

        if ($has_items):
            ?>
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <form action="?mod=cart&action=update" method="POST">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart_items as $key => $item):
                                    if ($key !== 'info' && isset($item['id'])): ?>
                                        <tr>
                                            <td><?php echo $item['product_code']; ?></td>
                                            <td>
                                                <a href="" title="" class="thumb">
                                                    <img src="<?php echo $item['thumbnail']; ?>"
                                                        alt="<?php echo $item['product_name']; ?>">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="?mod=product&action=detail&id=<?php echo $item['id']; ?>" title=""
                                                    class="name-product"><?php echo $item['product_name']; ?></a>
                                            </td>
                                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?>đ</td>
                                            <td>
                                                <div class="quantity">
                                                    <a href="javascript:void(0)" class="minus-btn"
                                                        onclick="decreaseQty(<?php echo $item['id']; ?>)">-</a>
                                                    <input type="number" min="1" name="qty[<?php echo $item['id']; ?>]"
                                                        value="<?php echo $item['qty']; ?>" class="num-order"
                                                        id="qty-<?php echo $item['id']; ?>">
                                                    <a href="javascript:void(0)" class="plus-btn"
                                                        onclick="increaseQty(<?php echo $item['id']; ?>)">+</a>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <?php echo number_format($item['sub_total'], 0, ',', '.'); ?>đ
                                            </td>
                                            <td>
                                                <a href="?mod=cart&action=delete&id=<?php echo $item['id']; ?>" title=""
                                                    class="del-product"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php endif; endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá:
                                                <span><?php echo number_format($total, 0, ',', '.'); ?>đ</span>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                
                                                <a href="?mod=cart&action=checkout" title="" id="checkout-cart">Thanh
                                                    toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="section" id="empty-cart">
                <p>Không có sản phẩm nào trong giỏ hàng, click <a href="?mod=home">vào đây</a> để tiếp tục mua sắm.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function increaseQty(id) {
        var qtyInput = document.getElementById('qty-' + id);
        var currentQty = parseInt(qtyInput.value);
        qtyInput.value = currentQty + 1;
        updateSubTotal(id);
        updateTotal();
    }

    function decreaseQty(id) {
        var qtyInput = document.getElementById('qty-' + id);
        var currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            qtyInput.value = currentQty - 1;
            updateSubTotal(id);
            updateTotal();
        }
    }

    // Cập nhật thành tiền cho từng sản phẩm
    function updateSubTotal(id) {
        var qtyInput = document.getElementById('qty-' + id);
        var qty = parseInt(qtyInput.value);
        var priceElement = qtyInput.parentElement.parentElement.previousElementSibling;
        var price = parseInt(priceElement.innerText.replace(/\D/g, ''));
        var subTotalElement = qtyInput.parentElement.parentElement.nextElementSibling;

        var subTotal = price * qty;
        // Định dạng số tiền với dấu chấm phân cách hàng nghìn
        var formattedSubTotal = new Intl.NumberFormat('vi-VN').format(subTotal) + 'đ';
        subTotalElement.innerText = formattedSubTotal;

        // Gửi yêu cầu AJAX để cập nhật trong database
        updateCartAjax(id, qty);
    }

    // Gửi yêu cầu AJAX để cập nhật giỏ hàng
    function updateCartAjax(id, qty) {
        // Tạo đối tượng XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Cấu hình yêu cầu
        xhr.open('POST', '?mod=cart&action=ajaxUpdate', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Xử lý phản hồi
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log('Cập nhật giỏ hàng thành công');

                        // Có thể cập nhật UI từ dữ liệu phản hồi nếu cần
                        if (response.cart_info && response.cart_info.formatted_total) {
                            var totalElement = document.getElementById('total-price').querySelector('span');
                            totalElement.innerText = response.cart_info.formatted_total;

                            // Cập nhật số lượng hiển thị trong header
                            if (response.cart_info.total_quantity !== undefined) {
                                var headerNumElements = document.querySelectorAll('#num');
                                headerNumElements.forEach(function (element) {
                                    element.innerText = response.cart_info.total_quantity;
                                });
                            }
                        }
                    } else {
                        console.log('Lỗi: ' + response.message);
                    }
                } catch (e) {
                    console.log('Lỗi phân tích dữ liệu JSON: ' + e.message);
                }
            } else {
                console.log('Lỗi kết nối: ' + xhr.status);
            }
        };

        // Xử lý lỗi kết nối
        xhr.onerror = function () {
            console.log('Lỗi kết nối mạng');
        };

        // Gửi dữ liệu
        xhr.send('id=' + id + '&qty=' + qty);
    }

    // Cập nhật tổng tiền giỏ hàng
    function updateTotal() {
        var total = 0;
        var subTotalElements = document.querySelectorAll('.product-subtotal');

        subTotalElements.forEach(function (element) {
            var subTotal = parseInt(element.innerText.replace(/\D/g, ''));
            total += subTotal;
        });

        // Cập nhật tổng tiền hiển thị
        var totalElement = document.getElementById('total-price').querySelector('span');
        var formattedTotal = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
        totalElement.innerText = formattedTotal;
    }

    // Thêm sự kiện change cho tất cả input số lượng
    document.addEventListener('DOMContentLoaded', function () {
        var qtyInputs = document.querySelectorAll('.num-order');
        qtyInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                var id = this.id.split('-')[1];
                updateSubTotal(id);
                updateTotal();
            });

            // Thêm sự kiện input để cập nhật ngay khi người dùng gõ
            input.addEventListener('input', function () {
                var id = this.id.split('-')[1];
                updateSubTotal(id);
                updateTotal();
            });
        });
    });
</script>

<?php
get_footer();
?>