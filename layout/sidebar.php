<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                <?php
                // Lấy danh sách danh mục từ database
                $list_cats = db_fetch_array("SELECT * FROM `list_products_cat` ORDER BY `id` ASC");
                
                if (!empty($list_cats)) {
                    foreach ($list_cats as $cat) {
                        ?>
                        <li>
                            <a href="?mod=product&cat_id=<?php echo $cat['id']; ?>" title="<?php echo $cat['cat_title']; ?>">
                                <?php echo $cat['cat_title']; ?>
                            </a>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
    </div>
</div>