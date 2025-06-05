<?php
get_header();
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=cart&action=checkout" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
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
        <div id="wrapper" class="wp-inner clearfix">
            <form method="POST" action="?mod=checkout&action=order" name="form-checkout">
                <!-- THÔNG TIN KHÁCH HÀNG -->
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>
                    </div>
                    <div class="section-detail">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="fullname" id="fullname" required>
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" id="address" required>
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone" id="phone" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="note">Ghi chú</label>
                                <textarea name="note" id="note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- THÔNG TIN ĐƠN HÀNG -->
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart_items as $key => $item):
                                    if ($key !== 'info' && isset($item['id'])): ?>
                                        <tr class="cart-item">
                                            <td class="product-name"><?php echo $item['product_name']; ?><strong class="product-quantity">x <?php echo $item['qty']; ?></strong></td>
                                            <td class="product-total"><?php echo number_format($item['sub_total'], 0, ',', '.'); ?>đ</td>
                                        </tr>
                                <?php endif;
                                endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price"><?php echo number_format($total, 0, ',', '.'); ?>đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- PHƯƠNG THỨC THANH TOÁN -->
                        <div id="payment-checkout-wp">
                            <h3>Phương thức thanh toán</h3>
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" id="payment-cod" name="payment_method" value="cod" checked>
                                    <label for="payment-cod">Ship COD (Thanh toán khi nhận hàng)</label>
                                </li>
                                <li>
                                    <input type="radio" id="payment-vnpay" name="payment_method" value="vnpay">
                                    <label for="payment-vnpay">Thanh toán VNPAY</label>
                                </li>

                                <!-- Bạn có thể thêm các phương thức khác tại đây -->
                            </ul>
                        </div>

                        <!-- NÚT ĐẶT HÀNG -->
                        <div class="form-submit">
                            <input type="submit" name="btn_order" value="Đặt hàng" class="btn btn-danger text-white">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    <?php else: ?>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section">
                <p>Không có sản phẩm nào trong giỏ hàng, click <a href="?mod=home">vào đây</a> để tiếp tục mua sắm.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
?>