<?php
ob_start(); // Bật output buffering để tránh lỗi header


// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "pickleball_shop");
mysqli_set_charset($conn, "utf8");

$product_id = 1;

// ✅ XỬ LÝ FORM KHI POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_review'])) {
    $star = isset($_POST['star']) ? (int) $_POST['star'] : 5;
    $performance = isset($_POST['performance']) ? (int) $_POST['performance'] : 5;
    $delivery = isset($_POST['delivery']) ? (int) $_POST['delivery'] : 5;
    $consulting = isset($_POST['consulting_attitude']) ? (int) $_POST['consulting_attitude'] : 5;
    $comment = trim($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO reviews (product_id, star_rating, performance, delivery, consulting_attitude, comment) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiis", $product_id, $star, $performance, $delivery, $consulting, $comment);
    $stmt->execute();


}

// ✅ Lấy dữ liệu trung bình
$result = $conn->query("SELECT 
    COUNT(*) AS total,
    ROUND(AVG(star_rating),1) AS avg_star,
    ROUND(AVG(performance),1) AS avg_perf,
    ROUND(AVG(delivery),1) AS avg_delivery,
    ROUND(AVG(consulting_attitude),1) AS avg_consulting
    FROM reviews WHERE product_id = $product_id");
$data = $result->fetch_assoc();
?>

<!-- GIAO DIỆN -->
<div class="review-section">
    <div class="review-header">Đánh giá & nhận xét Pickleball Shop</div>

    <?php if (!empty($_SESSION['review_success'])): ?>
        <p style="color:green;">✅ Cảm ơn bạn đã đánh giá!</p>
        <?php unset($_SESSION['review_success']); ?>
    <?php endif; ?>

    <div style="display:flex; flex-wrap:wrap; justify-content:space-between;">
        <div style="flex:1;">
            <div class="review-score"><?= $data['avg_star'] ?>/5</div>
            <div class="review-stars">★★★★★</div>
            <div><a href="#">Tổng <?= $data['total'] ?> đánh giá</a></div>
        </div>
        <div style="flex:2;" class="review-bars">
            <div>Hiệu năng: <?= $data['avg_perf'] ?>/5</div>
            <div>Giao hàng: <?= $data['avg_delivery'] ?>/5</div>
            <div>Thái độ tư vấn: <?= $data['avg_consulting'] ?>/5</div>
        </div>
    </div>

    <!-- FORM -->
    <style>
    .form-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .form-row label {
        width: 140px;
        font-weight: 500;
    }
    .form-row input,
    .form-row select {
        flex: 1;
        padding: 6px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .form-row textarea {
        width: 100%;
        padding: 6px 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        resize: vertical;
    }
    </style>

    <form method="post" style="margin-top:30px;">
        <div class="form-row">
            <label>⭐ Số sao tổng thể:</label>
            <select name="star" required>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>"><?= $i ?> sao</option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="form-row">
            <label>Hiệu năng:</label>
            <input type="number" name="performance" min="1" max="5" value="5" required>
        </div>

        <div class="form-row">
            <label>Giao hàng:</label>
            <input type="number" name="delivery" min="1" max="5" value="5" required>
        </div>

        <div class="form-row">
            <label>Thái độ tư vấn:</label>
            <input type="number" name="consulting_attitude" min="1" max="5" value="5" required>
        </div>

        <div class="form-row" style="flex-direction: column; align-items: flex-start;">
            <label style="width: 100%;">Bình luận:</label>
            <textarea name="comment" rows="3" placeholder="Ý kiến của bạn..."></textarea>
        </div>

        <button type="submit" name="submit_review" style="margin-top: 16px;">Gửi đánh giá</button>
    </form>

    <!-- DANH SÁCH ĐÁNH GIÁ -->
    <hr style="margin: 40px 0;">
    <h3>📢 Một số đánh giá gần đây</h3>

    <?php
    $result = $conn->query("SELECT star_rating, performance, delivery, consulting_attitude, comment, created_at 
                            FROM reviews 
                            WHERE product_id = $product_id 
                            ORDER BY created_at DESC 
                            LIMIT 5");

    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
    ?>
        <div style="margin-bottom: 20px; padding: 15px; border: 1px solid #eee; border-radius: 6px; background: #fff;">
            <div style="font-size: 14px; color: #999;">🗓 <?= date("d/m/Y H:i", strtotime($row['created_at'])) ?></div>
            <div style="color: #FFD700;">⭐ <?= str_repeat("★", $row['star_rating']) ?> (<?= $row['star_rating'] ?>/5)</div>
            <ul style="font-size: 14px; margin: 5px 0 10px 20px;">
                <li>Hiệu năng: <?= $row['performance'] ?>/5</li>
                <li>Giao hàng: <?= $row['delivery'] ?>/5</li>
                <li>Thái độ tư vấn: <?= $row['consulting_attitude'] ?>/5</li>
            </ul>
            <?php if (!empty($row['comment'])): ?>
                <div style="font-size: 15px; color: #333; line-height: 1.6;">
                    "<?= nl2br(htmlspecialchars($row['comment'])) ?> "
                </div>
            <?php endif; ?>
        </div>
    <?php
        endwhile;
    else:
        echo "<p>Chưa có đánh giá nào.</p>";
    endif;
    ?>
</div>
