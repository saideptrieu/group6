<?php get_header(); ?>

<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=post&action=addPost" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <form method="GET" action="">
                            <input type="hidden" name="mod" value="post">
                            <input type="hidden" name="action" value="listPost">
                            <input type="text" name="keyword" placeholder="Tìm kiếm bài viết..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                            <button type="submit">Tìm kiếm</button>
                        </form>
                        <?php if (!empty($keyword)): ?>
                            <p>Kết quả tìm kiếm cho: <strong><?= htmlspecialchars($keyword) ?></strong></p>
                        <?php endif; ?>

                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_posts)) :
                                    $t = 0;
                                    foreach ($list_posts as $post) :
                                        $t++;
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?= $t ?></span></td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="#" title=""><?= $post['title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=post&action=editPost&id=<?= $post['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=post&action=deletePost&id=<?= $post['id'] ?>" title="Xóa" class="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?= get_category_name($post['category_id']) ?></span></td>
                                            <td><span class="tbody-text">Hoạt động</span></td>
                                            <td><span class="tbody-text">Admin</span></td>
                                            <td><span class="tbody-text"><?= date('d-m-Y', strtotime($post['created_at'])) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr><td colspan="7"><strong>Không có bài viết nào.</strong></td></tr>
                                <?php endif; ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Danh mục</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
            </div>

            <!-- <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <li><a href="" title="">&laquo;</a></li>
                        <li><a href="" title="">1</a></li>
                        <li><a href="" title="">2</a></li>
                        <li><a href="" title="">3</a></li>
                        <li><a href="" title="">&raquo;</a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php get_footer(); ?>
