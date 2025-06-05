<?php get_header(); ?>

<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
  }

  .container {
    display: flex;
    max-width: 1000px;
    margin: 30px auto;
    gap: 30px;
    flex-wrap: wrap;
    padding: 0 15px;
  }

  .sidebar {
    flex: 0 0 250px;
    max-width: 100%;
  }

  .main-content {
    flex: 1;
  }


  .main-content {
    flex: 1;
    padding: 30px 40px;
    min-width: 300px;
  }

  .main-content h1 {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    font-size: 28px;
    margin-bottom: 20px;
  }

  .main-content h2 {
    color: #2980b9;
    margin-top: 30px;
    font-size: 22px;
  }

  .main-content p,
  .main-content ul {
    color: #333;
    line-height: 1.7;
    font-size: 16px;
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
    border-radius: 5px;
  }
</style>

<div id="main-content-wp" class="clearfix detail-page">
  <div class="wp-inner">
    <?php get_sidebar(); ?>

    <div class="container">
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
          <li>Hỗ trợ các hình thức thanh toán: COD, thẻ ATM/Visa/Mastercard.</li>
          <li>Hóa đơn điện tử sẽ được gửi đến email khách hàng trong vòng 24h sau khi thanh toán.</li>
        </ul>

        <h2>3. Chính sách bảo mật</h2>
        <p>Chúng tôi cam kết bảo mật thông tin khách hàng và không chia sẻ với bên thứ ba ngoại trừ khi có yêu cầu từ cơ quan chức năng.</p>

        <div class="note">
          Mọi thắc mắc về quy định - chính sách, vui lòng liên hệ bộ phận chăm sóc khách hàng để được hỗ trợ chi tiết.
        </div>
      </main>
    </div>
  </div>
</div>

<script>
  function toggleSubMenu(event) {
    event.preventDefault();
    const subMenu = event.target.nextElementSibling;
    if (subMenu && subMenu.classList.contains('sub-menu')) {
      subMenu.classList.toggle('hidden');
    }
  }
</script>

<?php get_footer(); ?>