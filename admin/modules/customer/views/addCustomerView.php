<?php get_header(); ?>

<style>
.customer-add {
    background: #f9f9f9;
    padding: 25px;
    border-radius: 8px;
    max-width: 600px;
    margin: auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.customer-add h3 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
}
.customer-add .form-group {
    margin-bottom: 15px;
}
.customer-add label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}
.customer-add input,
.customer-add select,
.customer-add textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.customer-add button {
    background: #27ae60;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: block;
    margin: 20px auto 0;
}
.customer-add button:hover {
    background: #219150;
}
</style>

<div class="customer-add">
    <h3>Thêm khách hàng mới</h3>
    <form method="POST">

        <div class="form-group">
            <label>Họ và tên:</label>
            <input type="text" name="fullname" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Địa chỉ:</label>
            <input type="text" name="address">
        </div>

        <div class="form-group">
            <label>Số điện thoại:</label>
            <input type="text" name="phone" required>
        </div>

        <div class="form-group">
            <label>Số sản phẩm:</label>
            <input type="number" name="quantity" min="0" value="0">
        </div>

        <div class="form-group">
            <label>Tổng tiền:</label>
            <input type="number" name="sub_total" min="0" value="0">
        </div>

        <div class="form-group">
            <label>Phương thức thanh toán:</label>
            <select name="payment_method">
                <option value="cod">COD</option>
                <option value="momo">VNPAY</option>
            </select>
        </div>

        <div class="form-group">
            <label>Trạng thái:</label>
            <select name="status">
                <option value="Đang xử lý">Đang vận chuyển</option>
                <option value="Hoạt động">Đã thanh toán, đang vận chuyển</option>
            </select>
        </div>

        <div class="form-group">
            <label>Ghi chú:</label>
            <textarea name="note" rows="3"></textarea>
        </div>

        <button type="submit" name="btn_add"><i class="fa fa-plus"></i> Thêm khách hàng</button>
    </form>
</div>

<?php get_footer(); ?>
