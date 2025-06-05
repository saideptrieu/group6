<!DOCTYPE html>
<html>

<head>
    <title>Pickleball Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="?" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="?mod=blog" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="?mod=blog&action=about" title="">Giới thiệu</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?" title="" id="logo" class="fl-left"><img src="public/images/logo-pick.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="?mod=search&action=result">
                                <input type="text" name="s" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?mod=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <?php
                                    $num_order = 0;
                                    if (isset($_SESSION['cart']['info'])) {
                                        $num_order = $_SESSION['cart']['info']['num_order'];
                                    }
                                    ?>
                                    <span id="num"><?php echo $num_order; ?></span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span><?php echo $num_order; ?> sản phẩm</span> trong giỏ hàng
                                    </p>
                                    <ul class="list-cart">
                                        <?php
                                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                            $cart_items = $_SESSION['cart'];
                                            $total = 0;
                                            $count = 0;

                                            foreach ($cart_items as $key => $item) {
                                                // Bỏ qua key 'info'
                                                if ($key !== 'info' && isset($item['id'])) {
                                                    // Giới hạn hiển thị 3 sản phẩm để không quá dài
                                                    if ($count < 3) {
                                                        ?>
                                                        <li class="clearfix">
                                                            <a href="?mod=product&action=detail&id=<?php echo $item['id']; ?>"
                                                                title="<?php echo $item['product_name']; ?>" class="thumb fl-left">
                                                                <img src="<?php echo $item['thumbnail']; ?>"
                                                                    alt="<?php echo $item['product_name']; ?>">
                                                            </a>
                                                            <div class="info fl-right">
                                                                <a href="?mod=product&action=detail&id=<?php echo $item['id']; ?>"
                                                                    title="<?php echo $item['product_name']; ?>"
                                                                    class="product-name"><?php echo $item['product_name']; ?></a>
                                                                <p class="price">
                                                                    <?php echo number_format($item['price'], 0, ',', '.'); ?>đ
                                                                </p>
                                                                <p class="qty">Số lượng: <span><?php echo $item['qty']; ?></span></p>
                                                            </div>
                                                        </li>
                                                        <?php
                                                        $count++;
                                                    }
                                                    $total += $item['sub_total'];
                                                }
                                            }

                                            // Nếu có nhiều hơn 3 sản phẩm, hiển thị thông báo
                                            if ($count < $num_order) {
                                                echo '<li class="clearfix"><p class="more-item">Và ' . ($num_order - $count) . ' sản phẩm khác</p></li>';
                                            }
                                        } else {
                                            echo '<li class="clearfix"><p>Không có sản phẩm nào trong giỏ hàng</p></li>';
                                            $total = 0;
                                        }
                                        ?>
                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">
                                            <?php echo number_format(isset($_SESSION['cart']['info']['total']) ? $_SESSION['cart']['info']['total'] : 0, 0, ',', '.'); ?>đ
                                        </p>
                                    </div>
                                    <div
                                        class="action-cart clearfix <?= $cart_items['info']['num_order'] > 0 ? '' : 'hidden' ?>">
                                        <a href="?mod=cart" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="?mod=cart&action=checkout" title="Thanh toán"
                                            class="checkout fl-right">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['cart_message'])): ?>
                <div id="notification"
                    style="position: fixed; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 15px; border-radius: 4px; z-index: 9999; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                    <?php echo $_SESSION['cart_message']; ?>
                    <span style="margin-left: 15px; cursor: pointer; font-weight: bold;"
                        onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
                <script>
                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(function () {
                        var notification = document.getElementById('notification');
                        if (notification) {
                            notification.style.display = 'none';
                        }
                    }, 3000);
                </script>
                <?php
                // Xóa thông báo khỏi session sau khi hiển thị
                unset($_SESSION['cart_message']);
            endif;
            ?>
        </div>
    </div>
</body>

</html>