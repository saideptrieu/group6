<?php get_header(); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>
.detail-order-container {
    background: #f9f9f9;
    padding: 25px;
    border-radius: 8px;
    max-width: 600px;
    margin: auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.detail-order-container h3.title {
    text-align: center;
    margin-bottom: 20px;
    color: #2c3e50;
}

.detail-order-container ul {
    list-style: none;
    padding: 0;
}

.detail-order-container li {
    padding: 10px 0;
    border-bottom: 1px solid #e0e0e0;
    font-size: 15px;
}

.detail-order-container strong {
    display: inline-block;
    width: 150px;
    color: #333;
}

.detail-order-buttons {
    margin-top: 25px;
    text-align: center;
}

.detail-order-buttons a, .detail-order-buttons button {
    display: inline-block;
    margin: 5px;
    padding: 10px 20px;
    background: #3498db;
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.detail-order-buttons a:hover,
.detail-order-buttons button:hover {
    background: #2980b9;
}
</style>

<div class="detail-order-container" id="invoice-content">
    <h3 class="title">Chi tiết sản phẩm đơn hàng #<?= $item['id'] ?></h3>
    <ul>
        <li><strong>ID chi tiết:</strong> <?= $item['id'] ?></li>
        <li><strong>ID đơn hàng:</strong> <?= $item['order_id'] ?></li>
        <li><strong>ID sản phẩm:</strong> <?= $item['product_id'] ?></li>
        <li><strong>Số lượng:</strong> <?= $item['quantity'] ?></li>
        <li><strong>Thành tiền:</strong> <?= number_format($item['sub_total']) ?> ₫</li>
    </ul>

    <div class="detail-order-buttons">
        <a href="?mod=order&controller=index&action=list">
            <i class="fa fa-arrow-left"></i> Quay lại danh sách
        </a>
        <button onclick="printInvoice()">
            <i class="fa fa-print"></i> In hóa đơn
        </button>
        <button onclick="savePDF()">
            <i class="fa fa-file-pdf"></i> Tải PDF
        </button>
    </div>
</div>

<script>
function printInvoice() {
    var content = document.getElementById('invoice-content').innerHTML;
    var win = window.open('', '', 'height=700,width=900');
    win.document.write('<html><head><title>In chi tiết</title></head><body>');
    win.document.write(content);
    win.document.write('</body></html>');
    win.document.close();
    win.print();
}

async function savePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.html(document.getElementById('invoice-content'), {
        callback: function (doc) {
            doc.save('chi-tiet-don-hang-<?= $item['id'] ?>.pdf');
        },
        x: 10,
        y: 10
    });
}
</script>

<?php get_footer(); ?>
