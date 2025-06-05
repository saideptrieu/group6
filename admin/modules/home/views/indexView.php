<?php
get_header();
// if (!is_login() && get_action() !== 'login') {
//     echo 'is_login(): ' . (is_login() ? 'true' : 'false') . '<br>';
//     echo 'get_action(): ' . htmlspecialchars(get_action()) . '<br>';
//     echo 'Condition (!is_login() && get_action() !== \'login\'): ' .
//         ((!is_login() && get_action() !== 'login') ? 'TRUE' : 'FALSE');
// }
?>

<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="display-name" id="display-name">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="admin" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel">
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"></textarea>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>