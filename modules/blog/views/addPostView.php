<?php get_header(); ?>
<div id="main-content-wp" class="clearfix add-post-page">
    <div class="wp-inner">
        <div class="section">
            <div class="section-head">
                <h3 class="section-title">Thêm bài viết mới</h3>
            </div>
            <div class="section-detail">
                <form method="POST" enctype="multipart/form-data">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name="title" id="title" required>

                    <label for="description">Mô tả ngắn</label>
                    <textarea name="description" id="description" rows="3" required></textarea>

                    <label for="image">Ảnh đại diện</label>
                    <input type="file" name="image" id="image">

                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" id="content" rows="10" required></textarea>

                    <button type="submit" name="btn_submit">Thêm bài viết</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>

<?php get_footer(); ?>
