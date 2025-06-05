<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Chính sách hội viên | Pickleball</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f6f9;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #d62828;
      padding: 15px 30px;
      color: white;
      flex-wrap: wrap;
    }

    .navbar .logo {
      font-weight: bold;
      font-size: 20px;
    }

    .navbar nav {
      display: flex;
      flex-wrap: wrap;
    }

    .navbar nav a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
      font-size: 15px;
    }

    .container {
      display: flex;
      max-width: 1200px;
      margin: 30px auto;
      gap: 30px;
      flex-wrap: wrap;
      padding: 0 15px;
    }

    .sidebar {
      width: 250px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 20px;
      flex-shrink: 0;
    }

    .sidebar h3 {
      background-color: #aaa;
      color: white;
      padding: 10px;
      border-radius: 5px 5px 0 0;
      margin-top: 0;
      font-size: 16px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
      border: 1px solid #ddd;
      border-top: none;
    }

    .sidebar ul li {
      border-top: 1px solid #ddd;
    }

    .sidebar ul li a {
      display: block;
      padding: 10px;
      color: #2980b9;
      text-decoration: none;
      cursor: pointer;
    }

    .sub-menu {
      padding-left: 15px;
      margin: 5px 0;
    }

    .sub-menu li {
      border: none;
    }

    .hidden {
      display: none;
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
    }

    .main-content h2 {
      color: #34495e;
      font-size: 22px;
      margin-top: 30px;
    }

    .main-content p, .main-content ul {
      color: #555;
      line-height: 1.6;
      font-size: 16px;
    }

    .main-content ul {
      padding-left: 20px;
      margin-top: 10px;
    }

    .main-content li {
      margin-bottom: 10px;
    }

    .footer {
      background-color: #d62828;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 50px;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
      }

      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar nav {
        margin-top: 10px;
        flex-direction: column;
      }

      .navbar nav a {
        margin: 5px 0;
      }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="navbar">
    <div class="logo">PICKLEBALL</div>
    <nav>
      <a href="?">Trang chủ</a>
      <a href="?mod=blog">Blog</a>
      <a href="?mod=blog&action=detail">Giới thiệu</a>
    </nav>
  </header>

  <!-- MAIN -->
  <div class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <h3>DANH MỤC SẢN PHẨM</h3>
      <ul class="list-item">
        <li>
          <a onclick="toggleSubMenu(event)">Vợt</a>
          <ul class="sub-menu hidden">
            <li><a href="?mod=product">Joola</a></li>
            <li><a href="?mod=product">Passion</a></li>
            <li><a href="?mod=product">Niupipo</a></li>
          </ul>
        </li>
        <li>
          <a onclick="toggleSubMenu(event)">Giày</a>
          <ul class="sub-menu hidden">
            <li><a href="?mod=product">Nike</a></li>
            <li><a href="?mod=product">Kamito</a></li>
          </ul>
        </li>
        <li><a href="?mod=product">Trang phục</a></li>
        <li><a href="?mod=product">Bóng</a></li>
        <li><a href="?mod=product">Túi</a></li>
        <li><a href="?mod=product">Balo</a></li>
        <li><a href="?mod=product">Phụ kiện</a></li>
      </ul>
    </aside>

    <!-- MAIN CONTENT -->
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
        <li>Đăng ký online qua website chính thức của chúng tôi.</li>
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

  <!-- FOOTER -->
  <footer class="footer">
    &copy; 2025 PICKLEBALL. Thiết kế bởi bạn ❤️
  </footer>

  <!-- JS for accordion -->
  <script>
    function toggleSubMenu(event) {
      event.preventDefault();
      const subMenu = event.target.nextElementSibling;
      if (subMenu && subMenu.classList.contains('sub-menu')) {
        subMenu.classList.toggle('hidden');
      }
    }
  </script>

</body>
</html>
