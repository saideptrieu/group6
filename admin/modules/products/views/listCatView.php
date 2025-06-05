<?php get_header(); ?>
<style>
    #content {
        margin: 0 auto;
        border: none;
    }
</style>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh mục sản phẩm</h3>
                    <a href="?mod=products&action=addCat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>

            <!-- Search Section -->
            <div class="section" id="search-wp">
                <div class="section-detail">
                    <form method="GET">
                        <input type="hidden" name="mod" value="products">
                        <input type="hidden" name="action" value="listCat">
                        <input type="text" name="s" value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>" placeholder="Tìm kiếm danh mục...">
                        <input type="submit" value="Tìm kiếm">
                        <?php if (!empty($search)): ?>
                            <a href="?mod=products&action=listCat" class="btn btn-secondary">Xóa tìm kiếm</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Messages -->
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?php if ($_GET['success'] == 'deleted'): ?>
                        Xóa danh mục thành công!
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?php if ($_GET['error'] == 'has_products'): ?>
                        Không thể xóa danh mục này vì còn có sản phẩm!
                    <?php elseif ($_GET['error'] == 'delete_failed'): ?>
                        Có lỗi xảy ra khi xóa danh mục!
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên danh mục</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($categories)): ?>
                                    <?php
                                    $stt = 1;
                                    foreach ($categories as $category):
                                        $product_count = count_products_by_cat($category['id']);
                                    ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $stt++; ?></span></td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <strong><?php echo htmlspecialchars($category['cat_title']); ?></strong>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=products&action=editCat&id=<?php echo $category['id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=products&action=deleteCat&id=<?php echo $category['id']; ?>" title="Xóa" class="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $product_count; ?> sản phẩm</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <?php if (!empty($search)): ?>
                                                <p>Không tìm thấy danh mục nào với từ khóa "<?php echo htmlspecialchars($search); ?>"</p>
                                                <a href="?mod=products&action=listCat">Xem tất cả danh mục</a>
                                            <?php else: ?>
                                                <p>Chưa có danh mục nào. <a href="?mod=products&action=addCat">Thêm danh mục đầu tiên</a></p>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">
                        Tổng cộng: <strong><?php echo isset($total_categories) ? $total_categories : 0; ?></strong> danh mục
                        <?php if (!empty($search)): ?>
                            | Tìm kiếm: <strong><?php echo htmlspecialchars($search); ?></strong>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>