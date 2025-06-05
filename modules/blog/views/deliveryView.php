<?php get_header(); ?>

<style>
  body {
    font-family: Arial, sans-serif;
    background: #f2f2f2;
    margin: 0;
    padding: 0;
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
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    background: #fff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    min-width: 300px;
  }

  .main-content h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 32px;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
  }

  .main-content h2 {
    color: #2980b9;
    margin-top: 24px;
    font-size: 20px;
  }

  .main-content p {
    color: #555;
    line-height: 1.7;
    font-size: 16px;
    margin: 10px 0;
  }

  .button-group {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
  }

  .btn {
    padding: 12px 24px;
    background-color: #2980b9;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    font-size: 15px;
  }

  .btn:hover {
    background-color: #1c5980;
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
    }

    .sidebar-area {
      width: 30%;
    }
  }
</style>

<div class="container">
  <?php get_sidebar(); ?>

  <main class="main-content">
    <h1>Chính sách Giao hàng - Lắp đặt</h1>

    <h2>🚚 Phạm vi giao hàng</h2>
    <p>Chúng tôi giao hàng toàn quốc với đối tác vận chuyển uy tín. Khách hàng sẽ được thông báo tình trạng đơn hàng qua SMS/email.</p>

    <h2>⏱ Thời gian giao hàng</h2>
    <p>Thời gian giao hàng dao động từ 1–5 ngày tùy khu vực. Đơn nội thành Hà Nội giao trong 24–48 giờ.</p>

    <h2>💰 Phí giao hàng</h2>
    <p>Miễn phí giao hàng cho đơn hàng trên 1.000.000đ nội thành Hà Nội. Các khu vực khác áp dụng theo bảng phí vận chuyển.</p>

    <h2>📞 Hỗ trợ & Liên hệ</h2>
    <p>Để biết thêm thông tin hoặc cần hỗ trợ, vui lòng liên hệ đội ngũ CSKH của chúng tôi.</p>

  </main>
</div>

<?php get_footer(); ?>