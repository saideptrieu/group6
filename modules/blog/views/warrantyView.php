<?php get_header(); ?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
  }

  .container {
    display: flex;
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 15px;
    gap: 30px;
    flex-wrap: wrap;
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

  .content {
    flex: 1;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 30px 40px;
    min-width: 300px;
  }

  h1 {
    color: #d9232d;
    border-bottom: 2px solid #d9232d;
    padding-bottom: 10px;
    font-size: 28px;
    margin-bottom: 20px;
  }

  h2 {
    color: #2980b9;
    margin-top: 30px;
    font-size: 20px;
  }

  p {
    line-height: 1.7;
    color: #333;
    font-size: 16px;
  }

  ul.policy {
    margin-left: 20px;
    padding-left: 0;
  }

  ul.policy li {
    margin-bottom: 10px;
    color: #333;
    font-size: 16px;
  }

  .note {
    background-color: #fefbd8;
    border-left: 5px solid #f1c40f;
    padding: 10px 15px;
    margin-top: 20px;
    font-style: italic;
    color: #444;
    border-radius: 5px;
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

  <main class="content">
    <h1>Chính sách bảo hành - đổi trả</h1>

    <p>Chúng tôi cam kết mang đến dịch vụ bảo hành và đổi trả rõ ràng, minh bạch và thuận tiện cho khách hàng.</p>

    <h2>1. Chính sách bảo hành</h2>
    <ul class="policy">
      <li>Sản phẩm được bảo hành trong vòng <strong>12 tháng</strong> kể từ ngày mua hàng.</li>
      <li>Bảo hành áp dụng cho các lỗi kỹ thuật do nhà sản xuất.</li>
      <li>Không áp dụng bảo hành cho các lỗi do người dùng như: rơi vỡ, va đập, vào nước, cháy nổ, tác động vật lý khác.</li>
    </ul>

    <h2>2. Chính sách đổi trả</h2>
    <ul class="policy">
      <li>Khách hàng có thể đổi hoặc trả hàng trong vòng <strong>7 ngày</strong> kể từ ngày nhận hàng.</li>
      <li>Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và còn đầy đủ hộp, tem, phụ kiện.</li>
      <li>Phí vận chuyển phát sinh (nếu có) sẽ do khách hàng chi trả.</li>
    </ul>

    <h2>3. Quy trình xử lý</h2>
    <p>Quý khách vui lòng liên hệ với chúng tôi qua số điện thoại hoặc email để được hỗ trợ. Chúng tôi sẽ tiếp nhận và xử lý yêu cầu trong vòng 48 giờ làm việc.</p>

    <div class="note">
      Lưu ý: Vui lòng giữ hóa đơn mua hàng để được hỗ trợ bảo hành hoặc đổi trả!
    </div>
  </main>
</div>

<?php get_footer(); ?>