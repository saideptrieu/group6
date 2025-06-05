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

    #main-content-wp .wp-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: stretch;
        gap: 20px;
        padding: 30px 15px;
    }

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
        font-size: 28px;
        margin-bottom: 20px;
    }

    .red {
        color: #007bff;
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

    h3.section-title {
        margin-bottom: 0;
    }

    .content h2,
    .content h3 {
        font-size: 22px;
        color: #007bff;
        margin-top: 30px;
        /* margin-bottom: 15px; */
    }

    .thumb {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }

    .thumb img {
        max-width: 50%;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin: 20px 0;
    }

    /* Features Grid */
    .features-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-top: 30px;
    }

    .feature-item {
        background: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        font-size: 40px;
        margin-bottom: 15px;
    }

    .feature-item h3 {
        font-size: 18px;
        color: #007bff;
        margin-bottom: 10px;
    }

    .feature-item p {
        font-size: 15px;
        color: #555;
    }

    /* Timeline */
    .timeline {
        margin: 40px 0;
        padding-left: 20px;
        border-left: 3px solid #007bff;
        position: relative;
    }

    .timeline-item {
        margin-bottom: 30px;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        width: 12px;
        height: 12px;
        background: #007bff;
        border-radius: 50%;
        position: absolute;
        left: -7px;
        top: 5px;
    }

    .timeline-year {
        font-weight: 700;
        color: #007bff;
        margin-bottom: 5px;
    }

    .timeline-description {
        font-size: 15px;
        color: #555;
    }

    /* Testimonials */
    .testimonials {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-top: 30px;
    }

    .testimonial-item {
        background: #f9f9f9;
        border-left: 5px solid #007bff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .testimonial-item:hover {
        transform: translateY(-5px);
    }

    .testimonial-content {
        font-style: italic;
        font-size: 16px;
        margin-bottom: 10px;
        color: #555;
    }

    .testimonial-author {
        font-weight: 600;
        color: #333;
        text-align: right;
        font-size: 15px;
    }

    /* Responsive */
    @media (min-width: 768px) {
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .testimonials {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 992px) {
        .features-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .testimonials {
            grid-template-columns: repeat(3, 1fr);
        }
    }

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

        <?php get_sidebar(); ?>

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

                        <h2>Bạn nhận được gì từ Pickleball.vn?</h2>
                        <div class="features-grid">
                            <div class="feature-item">
                                <div class="feature-icon">📰</div>
                                <h3>Tin tức &amp; Sự kiện</h3>
                                <p>Cập nhật nhanh chóng các giải đấu, hoạt động cộng đồng và xu hướng mới nhất trong giới Pickleball trong nước và quốc tế.</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">🎓</div>
                                <h3>Hướng dẫn chơi</h3>
                                <p>Từ cơ bản đến nâng cao – giúp người mới bắt đầu dễ dàng nắm bắt kỹ thuật, luật chơi, chiến thuật thi đấu.</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">🛒</div>
                                <h3>Cửa hàng dụng cụ</h3>
                                <p>Cung cấp vợt, bóng, lưới và phụ kiện chính hãng, chất lượng cao, phù hợp với mọi nhu cầu và ngân sách.</p>
                            </div>
                        </div>

                        <h3>Pickleball.vn – Bắt đầu đam mê, nâng tầm kỹ năng!</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>