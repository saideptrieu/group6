<?php get_header(); ?>
<style>
    #content {
        margin: 0 auto;
        border: none;
    }
</style>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <div id="content" class="">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Bài viết theo danh mục</h3>
                </div>
            </div>

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <form method="GET" action="">
                            <input type="hidden" name="mod" value="post">
                            <input type="hidden" name="action" value="listCat">
                            <select name="id" onchange="this.form.submit()">
                                <option value="">--Chọn danh mục--</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($current_category == $cat['id']) ? 'selected' : '' ?>>
                                        <?= $cat['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($list_posts)) : $i = 0; ?>
                                    <?php foreach ($list_posts as $post): $i++; ?>
                                        <tr>
                                            <td><span class="tbody-text"><?= $i ?></span></td>
                                            <td><span class="tbody-text"><strong><?= get_category_name($post['category_id']) ?></strong></span></td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=post&action=editPost&id=<?= $post['id'] ?>" title=""><?= $post['title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=post&action=editPost&id=<?= $post['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=post&action=deletePost&id=<?= $post['id'] ?>" title="Xóa" class="delete" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?');"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7"><strong>Không có bài viết nào trong danh mục này.</strong></td>
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