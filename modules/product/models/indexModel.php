<?php

function get_pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul class='pagging'>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$page_prev}}\">&laquo;</a></li>";
    }

    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) {
            $active = "Class = 'active'";
        }
        $str_pagging .= "<li {$active}><a href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }

    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page={$page_next}}\">&raquo;</a></li>";
    }
    $str_pagging .= "</ul>";
    echo $str_pagging;
}

function get_list_products_by_cat_id($cat_id)
{
    $list_products = db_fetch_array("SELECT * FROM `list_products`");
    $result = array(); //Mảng chứa danh sách sản phẩm theo cat id
    foreach ($list_products as $item) {
        if ($item['cat_id'] == $cat_id) {
            $item['url'] = "?mod=product&action=detail&id={$item['id']}";
            $result[] = $item;
        }
    }
    return $result;
}

function get_all_products()
{
    $list_products = db_fetch_array("SELECT * FROM `list_products`");
    $result = array(); //Mảng chứa danh sách sản phẩm theo cat id
    foreach ($list_products as $item) {
        if (!empty($item)) {
            $item['url'] = "?mod=product";
            $result[] = $item;
        }
    }
    return $result;
}

/**
 * Lấy thông tin sản phẩm từ ID
 * @param int $id ID sản phẩm
 * @return array|bool Thông tin sản phẩm hoặc false nếu không tìm thấy
 */
function get_product_by_id($id)
{
    // Lấy thông tin sản phẩm từ database
    $item = db_fetch_row("SELECT * FROM `list_products` WHERE `id` = {$id}");

    // Nếu không tìm thấy, thử lấy từ tất cả sản phẩm
    if (!empty($item)) {
        $list_products = db_fetch_array("SELECT * FROM `list_products`");
        foreach ($list_products as $product) {
            if ($product['id'] == $id) {
                // Thêm URL cho sản phẩm
                $product['url'] = "?mod=product&action=detail&id={$id}";
                $product['url_add_cart'] = "?mod=cart&action=add&id={$id}";
                return $product;
            }
        }
        return false;
    }

    // Thêm URL cho sản phẩm
    $item['url'] = "?mod=product&action=detail&id={$id}";
    $item['url_add_cart'] = "?mod=cart&action=add&id={$id}";

    return $item;
}

function get_featured_products()
{
    $list_featured = db_fetch_array("SELECT * FROM `list_products` WHERE `is_featured` = 1 ");
    $result = array(); //Mảng chứa danh sách sản phẩm theo cat id
    foreach ($list_featured as $item) {
        if ($item['is_featured'] == 1) {
            $item['url'] = "?mod=product&action=detail&id={$item['id']}";
            $result[] = $item;
        }
    }
    return $result;
} 