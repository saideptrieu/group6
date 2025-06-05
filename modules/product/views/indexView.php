<?php
get_header();
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Tất cả sản phẩm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo count($list_products); ?> trên <?php echo $total_row; ?></p>
                        <div class="form-filter">
                            <form method="GET" action="">
                                <input type="hidden" name="mod" value="product">
                                <?php if ($cat_id > 0) { ?>
                                    <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                <?php } ?>
                                <select name="sort">
                                    <option value="0" <?php echo ($sort == 0) ? 'selected' : ''; ?>>Sắp xếp</option>
                                    <option value="1" <?php echo ($sort == 1) ? 'selected' : ''; ?>>Từ A-Z</option>
                                    <option value="2" <?php echo ($sort == 2) ? 'selected' : ''; ?>>Từ Z-A</option>
                                    <option value="3" <?php echo ($sort == 3) ? 'selected' : ''; ?>>Giá cao xuống thấp</option>
                                    <option value="4" <?php echo ($sort == 4) ? 'selected' : ''; ?>>Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_products)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_products as $item) { ?>
                                <li>
                                    <a href="?mod=product&action=detail&id=<?php echo $item['id']; ?>" title="" class="thumb">
                                        <img src="<?php echo $item['product_thumb']; ?>" alt="<?php echo $item['product_title']; ?>">
                                    </a>
                                    <a href="?mod=product&action=detail&id=<?php echo $item['id']; ?>" title="" class="product-name"><?php echo $item['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <?php if ($item['price_old'] > 0) { ?>
                                            <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&action=add&id=<?php echo $item['id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&action=buyNow&id=<?php echo $item['id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p class="notify">Không có sản phẩm nào!</p>
                    <?php } ?>
                </div>
            </div>
            <?php if ($num_page > 1) { ?>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            $base_url = "?mod=product";

                            if ($cat_id > 0) {
                                $base_url .= "&cat_id={$cat_id}";
                            }
                            if ($sort > 0) {
                                $base_url .= "&sort={$sort}";
                            }
                            get_pagging($num_page, $page, $base_url);
                            
                            ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
?>