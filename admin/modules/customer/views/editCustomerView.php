<?php get_header(); ?>

<style>
.customer-edit {
    background: #f9f9f9;
    padding: 25px;
    border-radius: 8px;
    max-width: 600px;
    margin: auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.customer-edit h3 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
}
.customer-edit .form-group {
    margin-bottom: 15px;
}
.customer-edit label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}
.customer-edit input,
.customer-edit select,
.customer-edit textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.customer-edit button {
    background: #2980b9;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: block;
    margin: 20px auto 0;
}
.customer-edit button:hover {
    background: #2471a3;
}
</style>

<div class="customer-edit">
    <h3>Cập nhật thông tin khách hàng</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $customer['id'] ?>">

        <div class="form-group">
            <label>Mã khách hàng (code):</label>
            <input type="text" name="code" value="<?= $customer['code'] ?>">
        </div>

        <div class="form-group">
            <label>Họ và tên:</label>
            <input type="text" name="fullname" value="<?= $customer['fullname'] ?>" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?= $customer['email'] ?>" required>
        </div>

        <div class="form-group">
            <label>Địa chỉ:</label>
            <input type="text" name="address" value="<?= $customer['address'] ?>">
        </div>

        <div class="form-group">
            <label>Số điện thoại:</label>
            <input type="text" name="phone" value="<?= $customer['phone'] ?>" required>
        </div>

        <div class="form-group">
            <label>Phương thức thanh toán:</label>
            <select name="payment_method">
                <option value="cod" <?= $customer['payment_method'] == 'cod' ? 'selected' : '' ?>>COD</option>
                <option value="momo" <?= $customer['payment_method'] == 'momo' ? 'selected' : '' ?>>Momo</option>
                <option value="bank" <?= $customer['payment_method'] == 'bank' ? 'selected' : '' ?>>Chuyển khoản</option>
            </select>
        </div>

        <div class="form-group">
            <label>Trạng thái:</label>
            <select name="status">
                <option value="Đang xử lý" <?= $customer['status'] == 'Đang xử lý' ? 'selected' : '' ?>>Đang xử lý</option>
                <option value="Hoạt động" <?= $customer['status'] == 'Hoạt động' ? 'selected' : '' ?>>Hoạt động</option>
                <option value="Đã huỷ" <?= $customer['status'] == 'Đã huỷ' ? 'selected' : '' ?>>Đã huỷ</option>
            </select>
        </div>

        <div class="form-group">
            <label>Ghi chú:</label>
            <textarea name="note" rows="3"><?= $customer['note'] ?></textarea>
        </div>

        <button type="submit" name="btn_update"><i class="fa fa-save"></i> Cập nhật khách hàng</button>
    </form>
</div>

<?php get_footer(); ?>
