<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    $data['list_paddle'] = get_list_products_by_cat_id(1);
    $data['list_shoes'] = get_list_products_by_cat_id(2);
    $data['list_skin'] = get_list_products_by_cat_id(3);
    $data['list_ball'] = get_list_products_by_cat_id(4);
    $data['list_bag'] = get_list_products_by_cat_id(5);
    $data['list_balo'] = get_list_products_by_cat_id(6);
    $data['list_equip'] = get_list_products_by_cat_id(7);
    $data['info_cat_paddle'] = get_info_cat(0);
    $data['info_cat_shoes'] = get_info_cat(1);
    $data['info_cat_skin'] = get_info_cat(2);
    $data['info_cat_ball'] = get_info_cat(3);
    $data['info_cat_bag'] = get_info_cat(4);
    $data['info_cat_balo'] = get_info_cat(5);
    $data['info_cat_equip'] = get_info_cat(6);
    $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : 0;
    // $data['info_cat'] = get_info_cat($cat_id);
    $data['list_featured'] =  get_featured_products($cat_id);
    $data['item'] = get_list_products_by_cat_id($cat_id);
    $data['sliders'] = get_active_slides();
    load_view('index', $data);
}
