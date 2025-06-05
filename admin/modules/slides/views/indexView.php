<?php
get_header();
?>

<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slides</h3>
                    <a href="?mod=slides&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="search-box">
                        <form action="" method="get">  
                            <input type="hidden" name="mod" value="slides">
                            <input type="hidden" name="action" value="index">
                            <input type="text" name="keyword" placeholder="Tìm kiếm" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                            <input type="submit" value="Tìm kiếm">
                            <a href="?mod=slides&action=index" title="" id="add-new" class="">Xóa tìm kiếm</a>
                        </form>

                    </div>
                    <div class="table-responsive">
                        <?php if (!empty($list_slides)) : ?>
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Mô tả</span></td>
                                        <td><span class="thead-text">Thứ tự</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Tác vụ</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $temp = 0;
                                    foreach ($list_slides as $slide) :
                                        $temp++; ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $temp; ?></h3></span></td>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $slide['image_url']; ?>" alt="<?php echo $slide['title']; ?>">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=slides&action=edit&id=<?php echo $slide['id']; ?>" title=""><?php echo $slide['title']; ?></a>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $slide['description']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $slide['slide_order']; ?></span></td>
                                            <td>
                                                <a href="?mod=slides&action=changeStatus&id=<?php echo $slide['id']; ?>" class="tbody-text">
                                                    <?php echo $slide['status'] == 1 ? "Hiển thị" : "Ẩn"; ?>
                                                </a>
                                            </td>
                                            <td><span class="tbody-text"><?php echo isset($slide['user_created']) ? $slide['user_created'] : "Admin"; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date('d/m/Y', strtotime($slide['created_at'])); ?></span></td>
                                            <td>
                                                <ul class="list-operation">
                                                    <li><a href="?mod=slides&action=edit&id=<?php echo $slide['id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=slides&action=delete&id=<?php echo $slide['id']; ?>" title="Xóa" class="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa slide này?')"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>Không có slide nào.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?> 