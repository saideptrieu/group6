<?php get_header(); ?>

<style>
.customer-detail {
    background: #f9f9f9;
    padding: 30px;
    border-radius: 8px;
    max-width: 600px;
    margin: auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    font-size: 15px;
}
.customer-detail h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #2c3e50;
}
.customer-detail p {
    margin: 10px 0;
}
.customer-detail strong {
    width: 160px;
    display: inline-block;
}
.customer-detail .actions {
    text-align: center;
    margin-top: 25px;
}
.customer-detail .actions a {
    display: inline-block;
    margin: 0 10px;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    background: #3498db;
    color: white;
}
.customer-detail .actions a:hover {
    background: #2980b9;
}
.customer-detail .actions a.delete {
    background: #e74c3c;
}
.customer-detail .actions a.back {
    background: gray;
}
</style>

<div class="customer-detail">
    <h3> CHI TIẾT KHÁCH HÀNG </h3>

    <p><strong>ID:</strong> <?= $customer['id'] ?></p>
    <p><strong>Mã KH:</strong> <?= $customer['code'] ?? 'NULL' ?></p>
    <p><strong>Họ tên:</strong> <?= $customer['fullname'] ?></p>
    <p><strong>Email:</strong> <?= $customer['email'] ?></p>
    <p><strong>Địa chỉ:</strong> <?= $customer['address'] ?></p>
    <p><strong>Số điện thoại:</strong> <?= $customer['phone'] ?></p>
    <p><strong>Số sản phẩm:</strong> <?= $customer['quantity'] ?></p>
    <p><strong>Tổng tiền:</strong> <?= number_format($customer['sub_total']) ?> ₫</p>
    <p><strong>Phương thức thanh toán:</strong> <?= $customer['payment_method'] ?></p>
    <p><strong>Trạng thái:</strong> <?= $customer['status'] ?></p>
    <p><strong>Ghi chú:</strong> <?= $customer['note'] ?></p>
    <p><strong>Ngày tạo:</strong> <?= $customer['created_at'] ?></p>

    <div class="actions">
        <a href="?mod=customer&action=edit_customer&id=<?= $customer['id'] ?>">✏ Sửa</a>
        <a href="?mod=customer&action=delete_customer&id=<?= $customer['id'] ?>" class="delete" onclick="return confirm('Bạn có chắc muốn xóa?')">🗑 Xóa</a>
        <a href="?mod=customer&action=list_customer" class="back">↩ Quay lại</a>
    </div>
</div>

<?php get_footer(); ?>
