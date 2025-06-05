<?php
function get_info_cat($cat_id)
{
    $list_products_cat = db_fetch_array("SELECT * FROM `list_products_cat`");
    if (array_key_exists($cat_id, $list_products_cat)) {
        $list_products_cat[$cat_id]['url'] = "?mod=product&act=main&cat_id={$cat_id}";
        return $list_products_cat[$cat_id];
    }
    return false;
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

function get_product_by_id($id)
{
    $list_products = db_fetch_array("SELECT * FROM `list_products`");
    if (array_key_exists($id, $list_products)) {
        $list_products[$id]['url_add_cart'] = "?mod=cart&action=add&id={$id}";
        $list_products[$id]['url'] = "?mod=product&action=detail&id={$id}";
        return $list_products[$id];
    }
    return false;
}

function get_active_slides()
{
    return db_fetch_array("SELECT * FROM `tbl_slides` WHERE `status` = 1 ORDER BY `slide_order` ASC");
} 