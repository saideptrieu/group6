<?php get_header(); ?>
<style>
    #content {
        margin: 0 auto;
        border: none;
    }
</style>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=products&action=addProduct" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">

                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">ID</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá mới</span></td>
                                    <td><span class="thead-text">Giá cũ</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Nổi bật</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products)): ?>
                                    <?php $count = 0;
                                    foreach ($products as $product): $count++; ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $count; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $product['id']; ?></span></td>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <?php if (strpos($product['product_thumb'], 'data:image') === 0): ?>
                                                        <img src="<?php echo $product['product_thumb']; ?>" alt="<?php echo $product['product_title']; ?>">
                                                    <?php else: ?>
                                                        <img src="<?php echo !empty($product['product_thumb']) ? $product['product_thumb'] : 'public/images/img-product.png'; ?>" alt="<?php echo $product['product_title']; ?>">
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=products&action=editProduct&id=<?php echo $product['id']; ?>" title=""><?php echo $product['product_title']; ?></a>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo number_format($product['price_new'], 0, ',', '.'); ?>đ</span></td>
                                            <td><span class="tbody-text"><?php echo $product['price_old'] > 0 ? number_format($product['price_old'], 0, ',', '.') . 'đ' : '-'; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $product['cat_title']; ?></span></td>
                                            <td>
                                                <a href="?mod=products&action=toggleFeatured&id=<?php echo $product['id']; ?>&status=<?php echo $product['is_featured']; ?>">
                                                    <span class="tbody-text"><?php echo $product['is_featured'] ? 'Có' : 'Không'; ?></span>
                                                </a>
                                            </td>
                                            <td>
                                                <ul class="list-operation">
                                                    <li><a href="?mod=products&action=editProduct&id=<?php echo $product['id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=products&action=deleteProduct&id=<?php echo $product['id']; ?>" title="Xóa" class="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9"><span class="tbody-text">Không có sản phẩm nào</span></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>