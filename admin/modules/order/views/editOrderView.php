<?php get_header(); ?>

<style>
.form-edit-item {
    background: #f9f9f9;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: auto;
}
.form-edit-item label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
    color: #333;
}
.form-edit-item input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.form-edit-item button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}
.form-edit-item button:hover {
    background-color: #2980b9;
}
</style>

<div class="form-edit-item">
    <h3 style="text-align: center; color: #2c3e50;">Chỉnh sửa sản phẩm trong đơn hàng</h3>

    <form method="POST">
        <label for="order_id">ID Đơn hàng</label>
        <input type="number" name="order_id" value="<?= $item['order_id'] ?>" required>

        <label for="product_id">ID Sản phẩm</label>
        <input type="number" name="product_id" value="<?= $item['product_id'] ?>" required>

        <label for="quantity">Số lượng</label>
        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" required>

        <label for="sub_total">Thành tiền (VNĐ)</label>
        <input type="number" name="sub_total" value="<?= $item['sub_total'] ?>" required>

        <div style="text-align: center;">
            <button type="submit" name="btn_update">
                <i class="fa fa-save"></i> Cập nhật
            </button>
        </div>
    </form>
</div>

<?php get_footer(); ?>
