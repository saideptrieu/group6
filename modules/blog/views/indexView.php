<?php get_header(); ?>

<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <!-- BREADCRUMB
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li><a href="?">Trang chủ</a></li>
                    <li><a href="?mod=blog&controller=index&action=index">Blog</a></li>
                </ul>
            </div>
        </div> -->

        <div class="main-content fl-right">
            <!-- DANH SÁCH BÀI VIẾT -->
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($list_post as $post): ?>
                            <li class="clearfix">
                                <a href="?mod=blog&controller=index&action=detail&id=<?= $post['id'] ?>" class="thumb fl-left">
                                    <img src="public/images/<?= !empty($post['image']) ? $post['image'] : 'no-image.png' ?>" alt="">

                                </a>
                                <div class="info fl-right">
                                    <a href="?mod=blog&controller=index&action=detail&id=<?= $post['id'] ?>" class="title">
                                        <?= $post['title'] ?>
                                    </a>
                                    <span class="create-date"><?= date('d/m/Y', strtotime($post['created_at'])) ?></span>
                                    <p class="desc"><?= substr($post['description'], 0, 200) ?>...</p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- STYLE -->
            <style>
                #list-blog-wp .list-item li {
                    display: flex;
                    align-items: flex-start;
                    padding: 15px 0;
                    border-bottom: 1px solid #eee;
                    transition: background 0.3s;
                }

                #list-blog-wp .list-item li:hover {
                    background-color: #f9f9f9;
                }

                #list-blog-wp .thumb img {
                    width: 160px;
                    height: 100px;
                    object-fit: cover;
                    border-radius: 8px;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                }

                #list-blog-wp .info {
                    margin-left: 20px;
                    width: calc(100% - 180px);
                }

                #list-blog-wp .info .title {
                    display: block;
                    font-size: 20px;
                    color: #333;
                    font-weight: bold;
                    margin-bottom: 8px;
                    transition: color 0.3s;
                    text-decoration: none;
                }

                #list-blog-wp .info .title:hover {
                    color: #da1818;
                }

                #list-blog-wp .info .create-date {
                    display: block;
                    font-size: 14px;
                    color: #999;
                    margin-bottom: 10px;
                }

                #list-blog-wp .info .desc {
                    font-size: 15px;
                    color: #555;
                    line-height: 1.5;
                }

                #paging-wp .list-item {
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                    padding: 20px 0;
                }

                #paging-wp .list-item li a {
                    display: block;
                    padding: 8px 14px;
                    background-color: #ababab;
                    color: #fff;
                    text-decoration: none;
                    transition: all 0.3s;
                }

                #paging-wp .list-item li a:hover,
                #paging-wp .list-item li a.active {
                    background-color: #da1818;
                    color: #fff;
                }
            </style>

            <!-- PHÂN TRANG -->
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php if ($page > 1): ?>
                            <li><a href="?mod=blog&controller=index&action=index&page=<?= $page - 1 ?>">&laquo;</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li>
                                <a href="?mod=blog&controller=index&action=index&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li><a href="?mod=blog&controller=index&action=index&page=<?= $page + 1 ?>">&raquo;</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>