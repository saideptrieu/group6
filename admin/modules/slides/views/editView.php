<?php
get_header();
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật Slide</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Tiêu đề slide</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo $slide['title']; ?>">
                            <?php echo form_error('title'); ?>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" class="form-control"><?php echo $slide['description']; ?></textarea>
                            <?php echo form_error('description'); ?>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                            <?php echo form_error('image'); ?>
                            <?php if(!empty($slide['image_url'])): ?>
                            <div class="image-preview" style="margin-top: 10px;">
                                <img src="<?php echo $slide['image_url']; ?>" alt="<?php echo $slide['title']; ?>" style="max-width: 200px;">
                                <p>Hình ảnh hiện tại. Chọn file mới nếu muốn thay đổi.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group" hidden>
                            <label for="order">Thứ tự</label>
                            <input type="number" name="order" id="order" min="1" value="<?php echo $slide['slide_order']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1" <?php echo $slide['status'] == 1 ? "selected" : ""; ?>>Hiển thị</option>
                                <option value="0" <?php echo $slide['status'] == 0 ? "selected" : ""; ?>>Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="btn-update" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?> 