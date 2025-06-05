<?php get_header(); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>
    .table-order-container {
        padding: 25px;
        border-radius: 8px;
        max-width: 1000px;
        margin: auto;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .table-order-container h3 {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .table-order-container table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-order-container table th,
    .table-order-container table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }

    .table-order-container a {
        text-decoration: none;
        margin: 0 5px;
    }


    .export-buttons {
        text-align: right;
        margin-bottom: 15px;
    }

    .export-buttons button,
    .export-buttons a.add-btn {
        margin-left: 5px;
        padding: 6px 12px;
        background-color: dimgray;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    .export-buttons a.add-btn {
        margin-left: 10px;
        background-color: #4fa327;
    }

    .export-buttons a.add-btn:hover {
        background-color: #27ae60;
    }
</style>

<div class="table-order-container">
    <h3 class="fl-left"> DANH SÁCH ĐƠN HÀNG</h3>

    <div class="export-buttons fl-left">
        <a href="?mod=order&controller=index&action=add_item" class="add-btn">
            <i class="fa fa-plus"></i> Thêm đơn hàng
        </a>

    </div>

    <table id="orderTable">
        <thead>
            <tr>
                <th>STT</th>
                <th>ID Đơn hàng</th>
                <th>ID Sản phẩm</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Chi tiết</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($order_items)) {
                foreach ($order_items as $item) {
                    if ($item['quantity'] <= 0 || $item['sub_total'] <= 0) continue; ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['order_id'] ?></td>
                        <td><?= $item['product_id'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['sub_total']) ?> ₫</td>
                        <td>
                            <a class="detail-link" href="?mod=order&controller=index&action=detail_item&id=<?= $item['id'] ?>">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a class="edit-link" href="?mod=order&controller=index&action=edit_item&id=<?= $item['id'] ?>" title="Sửa">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="delete-link" href="?mod=order&controller=index&action=delete_item&item_id=<?= $item['id'] ?>&order_id=<?= $item['order_id'] ?>"
                                onclick="return confirm('Xác nhận xoá sản phẩm này khỏi đơn hàng?')" title="Xoá">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
            <?php }
            } else {
                echo '<tr><td colspan="7">Không có sản phẩm nào trong đơn hàng.</td></tr>';
            } ?>
        </tbody>
    </table>
</div>

<script>
    function exportToExcel() {
        alert('Tính năng xuất Excel cần tích hợp thêm thư viện backend hoặc ExcelJS.');
    }

    async function exportToPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        doc.html(document.querySelector("#orderTable"), {
            callback: function(doc) {
                doc.save('chi-tiet-don-hang.pdf');
            },
            x: 10,
            y: 10
        });
    }
</script>

<?php get_footer(); ?>