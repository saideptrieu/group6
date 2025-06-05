<?php get_header(); ?>

<style>
  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #f2f6f9;
  }

  .container {
    display: flex;
    max-width: 1200px;
    margin: 30px auto;
    gap: 30px;
    flex-wrap: wrap;
    padding: 0 15px;
  }

  .sidebar-area {
    width: 250px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 0;
    flex-shrink: 0;
    overflow: hidden;
  }

  .sidebar-area h3 {
    background-color: #007bff;
    color: white;
    padding: 12px 15px;
    margin: 0;
    font-size: 16px;
    font-weight: 600;
  }

  .sidebar-area ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .sidebar-area li a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    transition: background 0.3s, color 0.3s;
  }

  .sidebar-area li a:hover {
    background: #f0f8ff;
    color: #007bff;
  }

  .main-content {
    flex: 1;
    background: white;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    min-width: 300px;
  }

  .main-content h1 {
    color: #2c3e50;
    font-size: 32px;
    margin-bottom: 20px;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
  }

  .main-content h2 {
    color: #34495e;
    font-size: 22px;
    margin-top: 30px;
  }

  .main-content p, .main-content ul {
    color: #555;
    line-height: 1.7;
    font-size: 16px;
  }

  .main-content ul {
    padding-left: 20px;
    margin-top: 10px;
  }

  .main-content li {
    margin-bottom: 10px;
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
    }

    .sidebar-area {
      width: 100%;
    }
  }
</style>

<div class="container">
    <?php get_sidebar(); ?>

  <main class="main-content">
    <h1>Chính sách hội viên</h1>
    <p>Chương trình hội viên được thiết kế nhằm tri ân khách hàng thân thiết với nhiều ưu đãi hấp dẫn, giúp bạn tiết kiệm và trải nghiệm dịch vụ tốt hơn mỗi lần mua sắm.</p>

    <h2>1. Lợi ích khi trở thành hội viên</h2>
    <ul>
      <li>Giảm giá từ 5% - 15% cho các đơn hàng.</li>
      <li>Tặng quà sinh nhật và ưu đãi đặc biệt theo dịp lễ.</li>
      <li>Tích điểm thưởng để đổi quà hoặc giảm giá đơn hàng tiếp theo.</li>
      <li>Được ưu tiên tham gia các chương trình khuyến mãi riêng biệt.</li>
    </ul>

    <h2>2. Cách thức đăng ký</h2>
    <p>Bạn có thể đăng ký làm hội viên hoàn toàn miễn phí bằng một trong các cách sau:</p>
    <ul>
      <li>Đăng ký trực tiếp tại cửa hàng với nhân viên bán hàng.</li>
      <li>Liên hệ tổng đài chăm sóc khách hàng để được hỗ trợ.</li>
    </ul>

    <h2>3. Chính sách tích lũy điểm</h2>
    <p>Với mỗi 10.000đ chi tiêu, bạn sẽ nhận được 1 điểm tích lũy. Điểm có thể được sử dụng để quy đổi như sau:</p>
    <ul>
      <li>100 điểm = 50.000đ giảm giá.</li>
      <li>Điểm có hiệu lực trong vòng 12 tháng kể từ ngày phát sinh.</li>
    </ul>

    <p>Chúng tôi luôn nỗ lực để mang đến những quyền lợi thiết thực nhất cho hội viên. Cảm ơn bạn đã tin tưởng và đồng hành cùng chúng tôi!</p>
  </main>
</div>

<?php get_footer(); ?>
