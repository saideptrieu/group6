<?php
get_header();
?>

<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Chi tiết sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom"
                                src="<?php echo isset($item['product_thumb']) ? $item['product_thumb'] : 'public/images/img-pro-01.png'; ?>"
                                data-zoom-image="<?php echo isset($item['product_thumb']) ? $item['product_thumb'] : 'public/images/img-pro-01.png'; ?>" />
                        </a>

                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">
                            <?php echo isset($item['product_title']) ? $item['product_title'] : 'Sản phẩm chưa cập nhật tên'; ?>
                        </h3>
                        <div class="desc">
                            <?php echo isset($item['product_desc']) ? $item['product_desc'] : 'Chưa có mô tả sản phẩm'; ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">Còn hàng</span>
                        </div>
                        <p class="price">
                            <?php echo isset($item['price_new']) ? number_format($item['price_new'], 0, ',', '.') : '0'; ?>đ
                        </p>
                       
                        <?php
                        // Debug thông tin sản phẩm
                        if (isset($item) && !empty($item)) {
                            echo "<!-- DEBUG: ID sản phẩm: " . $item['id'] . " -->";
                        } else {
                            echo "<!-- DEBUG: Không có thông tin sản phẩm -->";
                        }
                        ?>
                        <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng"
                            class="add-cart">Thêm giỏ hàng</a>
                        <a href="?mod=cart&action=buyNow&id=<?php echo $item['id']; ?>" title="Mua ngay"
                            class="buy-now">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $item['product_content']; ?>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_featured)) { ?>
                        <ul class="list-item">
                            <?php foreach ($list_featured as $item) { ?>
                                <li>
                                    <a href="<?php echo $item['url']; ?>" title="" class="thumb">
                                        <img src="<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url']; ?>" title=""
                                        class="product-name"><?php echo $item['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng"
                                            class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&action=buyNow&id=<?php echo $item['id']; ?>" title="Mua ngay"
                                            class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<script>
    function decreaseQty() {
        var qtyInput = document.getElementById('num-order');
        var currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            qtyInput.value = currentQty - 1;
        }
    }

    function increaseQty() {
        var qtyInput = document.getElementById('num-order');
        var currentQty = parseInt(qtyInput.value);
        qtyInput.value = currentQty + 1;
    }

    // Update add to cart and buy now links with current quantity
    document.addEventListener('DOMContentLoaded', function() {
        var qtyInput = document.getElementById('num-order');
        var addCartBtn = document.querySelector('.add-cart');
        var buyNowBtn = document.querySelector('.buy-now');

        qtyInput.addEventListener('change', function() {
            var qty = this.value;
            var addCartHref = addCartBtn.getAttribute('href').split('&qty=')[0];
            var buyNowHref = buyNowBtn.getAttribute('href').split('&qty=')[0];

            addCartBtn.setAttribute('href', addCartHref + '&qty=' + qty);
            buyNowBtn.setAttribute('href', buyNowHref + '&qty=' + qty);
        });

        // Initialize with default quantity
        var defaultQty = qtyInput.value;
        addCartBtn.setAttribute('href', addCartBtn.getAttribute('href') + '&qty=' + defaultQty);
        buyNowBtn.setAttribute('href', buyNowBtn.getAttribute('href') + '&qty=' + defaultQty);
    });
</script>

<?php
get_footer();
?>