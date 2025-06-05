<?php get_header(); ?>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f4f6f8;
        color: #333;
        margin: 0;
    }

    /* Căn giữa toàn trang */
    #main-content-wp .wp-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: stretch;
        gap: 20px;
        padding: 30px 15px;
    }

    
    /* Nội dung chính */
    .main-content {
        width: 70%;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        transition: box-shadow 0.3s ease;
    }

    .main-content:hover {
        box-shadow: 0 0 20px rgba(0,0,0,0.08);
    }

    .section-title {
        color: #2c3e50;
        
    }

    .create-date {
        font-size: 14px;
        color: #999;
        margin-bottom: 25px;
        display: block;
    }

    .highlight-description {
        font-size: 18px;
        color: #444;
        background: #eef4ff;
        padding: 15px 20px;
        border-left: 5px solid #007bff;
        margin-bottom: 30px;
        border-radius: 5px;
    }

    .content {
        font-size: 16px;
        color: #333;
        line-height: 1.7;
    }

    .content p {
        margin-bottom: 18px;
    }

    .content h2 {
        font-size: 22px;
        color: #007bff;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .content ul {
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .content ul li {
        margin-bottom: 10px;
        list-style: disc;
    }

    .thumb img {
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin: 20px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #main-content-wp .wp-inner {
            flex-direction: column;
        }

        .sidebar, .main-content {
            width: 100%;
        }
    }
</style>

<div id="main-content-wp" class="clearfix detail-page">
    <div class="wp-inner">

        <!-- Sidebar -->
            <?php get_sidebar(); ?>

        <!-- Main content -->
        <div class="main-content">
            <div class="section" id="detail-blog">
                <div class="section-head">
                    <h1 class="section-title"><?= $post['title'] ?></h1>
                    <span class="create-date"><?= date('d/m/Y', strtotime($post['created_at'])) ?></span>
                </div>

                <div class="section-detail">
                    <?php if (!empty($post['description'])): ?>
                        <p class="highlight-description"><em><?= $post['description'] ?></em></p>
                    <?php endif; ?>

                    <?php if (!empty($post['image'])): ?>
                        <div class="thumb">
                            <img src="public/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>">
                        </div>
                    <?php endif; ?>

                    <div class="content post-content">
                        <?= $post['content'] ?>
                    </div>
                </div>

                <div class="section" id="social-wp">
                    <div class="section-detail">
                        <div class="fb-like"
                             data-href="<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                             data-layout="button_count"
                             data-action="like"
                             data-size="small"
                             data-show-faces="true"
                             data-share="true">
                        </div>
                        <div class="fb-comments"
                             data-href="<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                             data-numposts="5"
                             data-width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
