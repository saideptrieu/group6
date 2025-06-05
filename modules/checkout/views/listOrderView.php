<?php get_header(); ?>

<style>
    #content {
        margin: 0 auto;
        width: 95%;
    }

    #index {
        font-family: 'Roboto Medium';
        font-weight: normal;
        text-transform: uppercase;
        font-size: 18px;
        padding: 24px 0px;
    }

    .table-responsive {
        margin-top: 20px;
    }
</style>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <form action="" method="GET" class="form-s fl-left">
                            <input type="hidden" name="mod" value="checkout">
                            <input type="hidden" name="action" value="listOrder">

                            <input type="text" name="s" id="s" placeholder="Nhập tên hoặc số điện thoại" value="<?php echo htmlspecialchars($keyword ?? '') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <!-- <td><span class="thead-text">Trạng thái</span></td> -->
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($is_search): ?>
                                    <?php if (!empty($orders)): ?>
                                        <?php $temp = 1; ?>
                                        <?php foreach ($orders as $order): ?>
                                            <tr>
                                                <td><?php echo $temp++; ?></td>
                                                <td>#<?php echo $order['id']; ?></td>
                                                <td><?php echo htmlspecialchars($order['fullname']); ?></td>
                                                <td><?php echo $order['total_qty']; ?> sản phẩm</td>
                                                <td><?php echo currency_format($order['sub_total']); ?></td>
                                                <td><?php echo $order['created_at']; ?></td>
                                                <td><a href="?mod=checkout&action=detailOrder&order_id=<?php echo $order['id']; ?>">Chi tiết</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-danger text-center">Không tìm thấy đơn hàng</td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>