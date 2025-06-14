<?php get_header(); ?>
<style>
    #content {
        margin: 0 auto;
        border: none;
    }
</style>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?= $post['title'] ?>">

                        <label for="content">Nội dung</label>
                        <textarea name="content" id="content"><?= $post['content'] ?></textarea>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                        </div>
                        <label for="category_id">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= ($post['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                    <?= $cat['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="btn_update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>