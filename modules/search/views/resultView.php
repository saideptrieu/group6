<style>
    /* Giữ nguyên CSS bạn đã có */
    .search-result-title {
        font-size: 24px;
        font-weight: bold;
        color: #e53935;
        margin: 30px 0 15px;
        text-align: center;
    }

    .search-result-title strong {
        color: #333;
        text-transform: uppercase;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin: 20px auto;
        max-width: 1200px;
    }

    .product-card {
        border: 1px solid #ddd;
        padding: 15px;
        text-align: center;
        background: #fff;
        border-radius: 10px;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    .product-card h3 {
        font-size: 16px;
        margin: 10px 0;
    }

    .product-card .price {
        color: #d0021b;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-card .price del {
        color: #999;
        font-size: 13px;
        margin-left: 5px;
    }

    .product-card .buttons {
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
    }

    .product-card .btn {
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s ease, color 0.3s ease, border 0.3s ease;
        border: 1px solid transparent;
    }

    .product-card .btn.black {
        background: white;
        color: black;
        border: 1px solid black;
    }

    .product-card .btn.black:hover {
        background: black;
        color: white;
    }

    .product-card .btn.red {
        background: white;
        color: #e53935;
        border: 1px solid #e53935;
    }

    .product-card .btn.red:hover {
        background: #e53935;
        color: white;
    }
</style>

<?php include 'layout/header.php'; ?>

<?php

// Đảm bảo biến $keyword luôn tồn tại, tránh lỗi undefined
$keyword = isset($keyword) ? $keyword : '';

// hoặc dùng phiên bản ngắn hơn trong PHP 7+
$keyword = $keyword ?? '';

if (!empty($result)) {
    echo "<h3 class='search-result-title'>Kết quả tìm kiếm cho từ khóa: <strong>" . htmlspecialchars($keyword) . "</strong></h3>";
    echo '<div class="product-grid">';
    foreach ($result as $item) {
        echo '<div class="product-card">';
        echo '<img src="' . $item['product_thumb'] . '" alt="' . htmlspecialchars($item['product_title']) . '">';
        echo '<h3>' . nl2br(htmlspecialchars_decode($item['product_title'])) . '</h3>';

        echo '<div class="price">';
        echo number_format($item['price_new'], 0, ',', '.') . '₫';
        if (!empty($item['price_old'])) {
            echo ' <del>' . number_format($item['price_old'], 0, ',', '.') . '₫</del>';
        }
        echo '</div>';

        echo '<div class="buttons">';
        echo '<a href="?mod=cart&action=add&id=' . $item['id'] . '" class="btn black add-to-cart" data-id="' . $item['id'] . '">Thêm giỏ hàng</a>';
        echo '<a href="?mod=cart&action=buynow&id=' . $item['id'] . '" class="btn red">Mua ngay</a>';
        echo '</div>';

        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<p style='text-align:center;'>Không tìm thấy kết quả nào phù hợp với từ khóa: <strong>" . htmlspecialchars($keyword) . "</strong></p>";
}
?>

<?php include 'layout/footer.php'; ?>