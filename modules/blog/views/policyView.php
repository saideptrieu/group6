<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Quy định - Chính sách | Pickleball</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color:rgb(203, 57, 59);
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
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      min-width: 300px;
    }

    .main-content h1 {
      color: #2c3e50;
      border-bottom: 2px solid #3498db;
      padding-bottom: 10px;
    }

    .main-content h2 {
      color: #2980b9;
      margin-top: 30px;
    }

    .main-content p, .main-content ul {
      color: #333;
      line-height: 1.6;
    }

    .main-content ul {
      margin-left: 20px;
    }

    .note {
      background: #fefbd8;
      border-left: 5px solid #f1c40f;
      padding: 10px 15px;
      font-style: italic;
      margin-top: 20px;
      color: #444;
    }

    .footer {
      background-color:rgb(190, 25, 36);
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
      <h1>Quy định - Chính sách</h1>
      <p>Để đảm bảo quyền lợi và nghĩa vụ của hai bên, PICKLEBALL xây dựng các quy định - chính sách rõ ràng như sau:</p>

      <h2>1. Quy định chung</h2>
      <ul>
        <li>Khách hàng cần kiểm tra kỹ thông tin sản phẩm trước khi đặt hàng.</li>
        <li>Thông tin cá nhân cung cấp phải chính xác để đảm bảo giao hàng đúng và nhanh chóng.</li>
        <li>Không sử dụng website vào mục đích lừa đảo, phá hoại hoặc gây ảnh hưởng đến người khác.</li>
      </ul>

      <h2>2. Quy định về thanh toán</h2>
      <ul>
        <li>Hỗ trợ nhiều hình thức thanh toán: chuyển khoản, COD, thẻ ATM/Visa/Mastercard.</li>
        <li>Hóa đơn điện tử sẽ được gửi đến email khách hàng trong vòng 24h sau khi thanh toán.</li>
      </ul>

      <h2>3. Chính sách bảo mật</h2>
      <p>Chúng tôi cam kết bảo mật thông tin khách hàng và không chia sẻ với bên thứ ba ngoại trừ khi có yêu cầu từ cơ quan chức năng.</p>

      <div class="note">
        Mọi thắc mắc về quy định - chính sách, vui lòng liên hệ bộ phận chăm sóc khách hàng để được hỗ trợ chi tiết.
      </div>
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
