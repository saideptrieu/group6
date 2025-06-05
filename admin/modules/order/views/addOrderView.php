<?php get_header(); ?>

<style>
.form-add-item {
    background: #f9f9f9;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: auto;
}
.form-add-item label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
    color: #333;
}
.form-add-item input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.form-add-item button {
    background-color: #27ae60;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}
.form-add-item button:hover {
    background-color: #219150;
}
</style>

<div class="form-add-item">
    <h3 style="text-align: center; color: #2c3e50;">Thêm sản phẩm vào đơn hàng</h3>

    <form method="POST">
        <label for="order_id">ID Đơn hàng</label>
        <input type="number" name="order_id" required>

        <label for="product_id">ID Sản phẩm</label>
        <input type="number" name="product_id" required>

        <label for="quantity">Số lượng</label>
        <input type="number" name="quantity" value="1" min="1" required>

        <label for="sub_total">Thành tiền (VNĐ)</label>
        <input type="number" name="sub_total" required>

        <div style="text-align: center;">
            <button type="submit" name="btn_add">
                <i class="fa fa-plus"></i> Thêm sản phẩm
            </button>
        </div>
    </form>
</div>

<?php get_footer(); ?>
