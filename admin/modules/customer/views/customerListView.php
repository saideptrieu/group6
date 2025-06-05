<?php get_header(); ?>

<style>
    .customer-list-container {
        min-height: 100%;
        padding: 25px;
        border-radius: 8px;
        max-width: 100%;
        margin: auto;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .customer-list-container h3 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .customer-list-container .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .customer-list-container .filter-form select {
        padding: 6px 10px;
        font-size: 14px;
    }

    .customer-list-container a.add-btn {
        background: #4fa327;
        padding: 8px 16px;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .customer-list-container table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .customer-list-container th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .customer-list-container td.left {
        text-align: left;
        padding-left: 12px;
    }

    .customer-list-container td.action a {
        margin: 0 5px;
        text-decoration: none;
    }

    .customer-list-container td.action a.edit {
        color: #2980b9;
    }

    .customer-list-container td.action a.delete {
        color: #c0392b;
    }

    .customer-list-container td.action a.view {
        color: #27ae60;
    }

    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a {
        display: inline-block;
        padding: 6px 12px;
        margin: 0 4px;
        background: #ddd;
        text-decoration: none;
        border-radius: 4px;
        color: #000;
    }

    .pagination a.active {
        background: #3498db;
        color: white;
        font-weight: bold;
    }
</style>

<div class="customer-list-container">
    <h1 style="font-size: 20px; font-weight: bold; color: #2c3e50; text-align: center;">DANH SÁCH KHÁCH HÀNG</h1>

    <div class="top-bar">
        <form method="GET" class="filter-form">
            <input type="hidden" name="mod" value="customer">
            <input type="hidden" name="action" value="list_customer">
            <label>Lọc theo trạng thái:</label>
            <select name="status" onchange="this.form.submit()">
                <option value="">-- Tất cả --</option>
                <option value="Đang vận chuyển" <?= ($status == 'Đang vận chuyển') ? 'selected' : '' ?>>Đang vận chuyển</option>
                <option value="Đã thanh toán, đang vận chuyển" <?= ($status == 'Đã thanh toán, đang vận chuyển') ? 'selected' : '' ?>>Đã thanh toán, đang vận chuyển</option>
            </select>
        </form>

        <a class="add-btn" href="?mod=customer&action=add_customer">+ Thêm khách hàng</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Số SP</th>
                <th>Tổng tiền</th>
                <th>PT Thanh toán</th>
                <th>Trạng thái</th>
                <th>Ghi chú</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers)) : ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= $customer['id'] ?></td>
                        <td class="left"><?= $customer['fullname'] ?></td>
                        <td class="left"><?= $customer['email'] ?></td>
                        <td class="left"><?= $customer['address'] ?></td>
                        <td><?= $customer['phone'] ?></td>
                        <td><?= $customer['quantity'] ?></td>
                        <td><?= number_format($customer['sub_total']) ?> ₫</td>
                        <td><?= $customer['payment_method'] ?></td>
                        <td><?= $customer['status'] ?></td>
                        <td class="left"><?= $customer['note'] ?></td>
                        <td><?= $customer['created_at'] ?></td>
                        <td class="action">
                            <a class="view" href="?mod=customer&action=detail_customer&id=<?= $customer['id'] ?>"><i class="fa fa-eye"></i></a>
                            <a class="edit" href="?mod=customer&action=edit_customer&id=<?= $customer['id'] ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete" href="?mod=customer&action=delete_customer&id=<?= $customer['id'] ?>" onclick="return confirm('Xoá khách hàng này?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13">Không có khách hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?mod=customer&action=list_customer&page=<?= $i ?>&status=<?= urlencode($status) ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>
<?php get_footer(); ?>