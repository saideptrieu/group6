<?php get_header(); ?>
<link href="public\css\import\detail_order.css" rel="stylesheet" type="text/css" />
<style>
    #content {
        width: 96%;
    }
</style>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <?php if (!empty($info_order)) { ?>
                    <ul class="list-item">
                        <li>
                            <h3 class="title">Mã đơn hàng</h3>
                            <span class="detail">#<?php echo htmlspecialchars($info_order['id']); ?></span>
                        </li>
                        <li>
                            <h3 class="title">Địa chỉ nhận hàng</h3>
                            <span class="detail"><?php echo htmlspecialchars($info_order['address']); ?></span>
                        </li>
                        <li>
                            <h3 class="title">Phương thức thanh toán</h3>
                            <span class="detail"><?php echo htmlspecialchars($info_order['payment_method']); ?></span>
                        </li>
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <span class="detail"><?php echo htmlspecialchars($info_order['status']); ?></span>
                        </li>
                    </ul>
                <?php } ?>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($order_items)) { ?>
                                <?php $temp = 1; ?>
                                <?php foreach ($order_items as $item) {
                                    if ($item['quantity'] <= 0 || $item['sub_total'] <= 0) continue; ?>
                                    <tr>
                                        <td class="thead-text"><?php echo $temp++; ?></td>
                                        <td class="thead-text">
                                            <div class="thumb">
                                                <img src="<?php echo $item['product_thumb']; ?>" alt="<?php echo htmlspecialchars($item['product_title']); ?>">
                                            </div>
                                        </td>
                                        <td class="thead-text"><?php echo strip_tags($item['product_title']); ?></td>
                                        <td class="thead-text"><?php echo number_format($item['price_new']); ?> VNĐ</td>
                                        <td class="thead-text"><?php echo $item['quantity']; ?></td>
                                        <td class="thead-text"><?php echo number_format($item['sub_total']); ?> VNĐ</td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $order_summary['quantity']; ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($order_summary['sub_total']); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</html>
<?php get_footer(); ?>