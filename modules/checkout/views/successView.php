<?php
get_header();
?>
<div id="main-content-wp" class="clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="checkout-success">
                <div class="section-detail">
                    <div class="success-box">
                        <div class="success-icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div class="success-content">
                            <h4>Cảm ơn bạn đã đặt hàng!</h4>
                            <p>Đơn hàng của bạn đã được tiếp nhận và đang trong quá trình xử lý.</p>
                            <p>Mã đơn hàng: <strong>#<?= $order_code ?? '' ?></strong></p>
                            <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng.</p>
                            <div class="action">
                                <a href="?mod=product" class="btn btn-success">Tiếp tục mua sắm</a>
                                <a href="?mod=account&action=order" class="btn btn-secondary">Xem đơn hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<style>
    #checkout-success {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .success-box {
        text-align: center;
        padding: 30px 0;
    }
    .success-icon {
        font-size: 60px;
        color: #28a745;
        margin-bottom: 20px;
    }
    .success-content h4 {
        color: #28a745;
        font-size: 24px;
        margin-bottom: 15px;
    }
    .success-content p {
        margin-bottom: 10px;
        color: #666;
    }
    .action {
        margin-top: 30px;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        margin: 0 10px;
        font-weight: 500;
    }
    .btn-success {
        background: #28a745;
        color: #fff;
    }
    .btn-secondary {
        background: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
    }
</style>

<?php
get_footer();
?>