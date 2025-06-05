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

    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thông tin tài khoản ADMIN</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="display-name" id="display-name" placeholder="<?php if (!empty(user_login())) echo user_login(); ?>" readonly="readonly">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="admin" readonly="readonly">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>