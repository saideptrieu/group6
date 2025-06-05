<?php get_header(); ?>
<style>
    #content {
        margin: 0 auto;
        border: none;
    }
</style>
<div id="main-content-wp" class="edit-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Sửa danh mục</h3>
                    <a href="?mod=products&action=listCat" title="" id="add-new" class="fl-left">Quay lại danh sách</a>
                </div>
            </div>
            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="cat_title">Tên danh mục <span class="required">*</span></label>
                            <input type="text" 
                                   name="cat_title" 
                                   id="cat_title" 
                                   value="<?php echo isset($_POST['cat_title']) ? $_POST['cat_title'] : htmlspecialchars($category['cat_title']); ?>" 
                                   placeholder="Nhập tên danh mục..."
                                   maxlength="100"
                                   required>
                            <?php echo isset($error['cat_title']) ? "<p class='error'>{$error['cat_title']}</p>" : ""; ?>
                            <div class="form-note">
                                <small>Tên danh mục từ 2-100 ký tự, không được trùng với danh mục khác</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Thông tin danh mục:</label>
                            <div class="info-box">
                                <p><strong>ID:</strong> <?php echo $category['id']; ?></p>
                                <p><strong>Số sản phẩm:</strong> <?php echo count_products_by_cat($category['id']); ?> sản phẩm</p>
                            </div>
                        </div>

                        <?php if(isset($error['general'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $error['general']; ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-actions">
                            <button type="submit" name="btn-update" class="btn btn-primary">
                                <i class="fa fa-save"></i> Cập nhật danh mục
                            </button>
                            <a href="?mod=products&action=listCat" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Hủy bỏ
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.edit-cat-page .form-group {
    margin-bottom: 20px;
}

.edit-cat-page label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.edit-cat-page .required {
    color: #e74c3c;
}

.edit-cat-page input[type="text"] {
    width: 100%;
    max-width: 500px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.edit-cat-page input[type="text"]:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
}

.edit-cat-page .form-note {
    margin-top: 5px;
}

.edit-cat-page .form-note small {
    color: #666;
    font-style: italic;
}

.edit-cat-page .info-box {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 15px;
    margin-top: 5px;
}

.edit-cat-page .info-box p {
    margin: 5px 0;
    color: #495057;
}

.edit-cat-page .form-actions {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.edit-cat-page .btn {
    padding: 10px 20px;
    margin-right: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.edit-cat-page .btn-primary {
    background-color: #3498db;
    color: white;
}

.edit-cat-page .btn-primary:hover {
    background-color: #2980b9;
}

.edit-cat-page .btn-secondary {
    background-color: #95a5a6;
    color: white;
}

.edit-cat-page .btn-secondary:hover {
    background-color: #7f8c8d;
}

.edit-cat-page .btn-danger {
    background-color: #e74c3c;
    color: white;
}

.edit-cat-page .btn-danger:hover {
    background-color: #c0392b;
}

.edit-cat-page .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.edit-cat-page .alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.edit-cat-page .error {
    color: #e74c3c;
    font-size: 13px;
    margin-top: 5px;
    display: block;
}
</style>

<script>
$(document).ready(function() {
    $('#cat_title').on('input', function() {
        var length = $(this).val().length;
        var maxLength = 100;
        var remaining = maxLength - length;
        $('.char-counter').remove();
        if (length > 0) {
            $(this).after('<div class="char-counter">' + length + '/' + maxLength + ' ký tự</div>');
        }
        if (remaining < 20) {
            $('.char-counter').css('color', '#e74c3c');
        } else {
            $('.char-counter').css('color', '#666');
        }
    });
    $('form').on('submit', function() {
        var catTitle = $('#cat_title').val().trim();
        
        if (catTitle.length < 2) {
            alert('Tên danh mục phải có ít nhất 2 ký tự');
            $('#cat_title').focus();
            return false;
        }
        
        if (catTitle.length > 100) {
            alert('Tên danh mục không được quá 100 ký tự');
            $('#cat_title').focus();
            return false;
        }
    });
    $('#cat_title').focus().select();
    $('#cat_title').trigger('input');
});
</script>

<?php get_footer(); ?> 