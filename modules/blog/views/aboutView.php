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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease;
    }

    .main-content:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        color: #2c3e50;
    }

    .red {
        color: blue;
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin: 20px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #main-content-wp .wp-inner {
            flex-direction: column;
        }

        .sidebar,
        .main-content {
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
                    <h1 class="section-title"><strong class="red">Giới thiệu về trang web Pickleball - Nơi kết nối đam mê và kỹ năng</strong></h1>
                </div>

                <div class="section-detail">
                    <p class="highlight-description"><em>Pickleball.vn – Cộng đồng yêu thích Pickleball tại Việt Nam và khu vực!</em></p>

                    <div class="thumb">
                        <img src="public/images/logo-pick.jpg" alt="Giới thiệu Pickleball">
                    </div>

                    <div class="content post-content">
                        <p>Pickleball là môn thể thao đang phát triển mạnh mẽ trên toàn thế giới, kết hợp giữa tennis, bóng bàn và cầu lông. Với luật chơi đơn giản, dễ tiếp cận cho mọi lứa tuổi và trình độ, Pickleball nhanh chóng trở thành lựa chọn lý tưởng cho những ai muốn vận động, giao lưu và rèn luyện sức khỏe.</p>

                        <p>Tại Pickleball.vn, chúng tôi mang đến cho bạn:</p>

                        <p>📰 <strong>Tin tức &amp; Sự kiện:</strong> Cập nhật nhanh chóng các giải đấu, hoạt động cộng đồng và xu hướng mới nhất trong giới Pickleball trong nước và quốc tế.</p>

                        <p>🎓 <strong>Hướng dẫn chơi:</strong> Từ cơ bản đến nâng cao – giúp người mới bắt đầu dễ dàng nắm bắt kỹ thuật, luật chơi, chiến thuật thi đấu.</p>

                        <p>🛒 <strong>Cửa hàng dụng cụ:</strong> Cung cấp vợt, bóng, lưới và phụ kiện chính hãng, chất lượng cao, phù hợp với mọi nhu cầu và ngân sách.</p>

                        <p>👫 <strong>Cộng đồng &amp; Kết nối:</strong> Diễn đàn, nhóm chơi, và các buổi offline giao lưu giữa những người có chung đam mê.</p>

                        <p>📹 <strong>Video &amp; Bài học:</strong> Nội dung trực quan giúp bạn học hỏi kỹ thuật, chiến thuật từ các vận động viên chuyên nghiệp.</p>

                        <p>Chúng tôi tin rằng Pickleball không chỉ là một môn thể thao – mà còn là cầu nối của sự gắn kết, niềm vui và phong cách sống năng động. Dù bạn là người mới hay vận động viên dày dạn, hãy đồng hành cùng chúng tôi để phát triển cộng đồng Pickleball ngày càng lớn mạnh!</p>

                        <h3>Pickleball.vn – Bắt đầu đam mê, nâng tầm kỹ năng!</h3>
                    </div>
                </div>

                <div class="section" id="social-wp">
                    <div class="section-detail">
                        <div class="fb-like"
                            data-href="http://yourwebsite.com/gioi-thieu"
                            data-layout="button_count"
                            data-action="like"
                            data-size="small"
                            data-show-faces="true"
                            data-share="true">
                        </div>

                        <div class="fb-comments"
                            data-href="http://yourwebsite.com/gioi-thieu"
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