<?php
function add_post($data) {
    db_insert('tbl_blog', $data);
}

function get_list_posts() {
    $result = db_fetch_array("SELECT * FROM tbl_blog");
    return $result;
}

function get_category_name($id) {
    if (empty($id)) return 'Không rõ';
    $category = db_fetch_row("SELECT name FROM `tbl_blog_category` WHERE id = $id");
    return !empty($category) ? $category['name'] : 'Không rõ';
}

function get_list_categories() {
    return db_fetch_array("SELECT * FROM tbl_blog_category");
}

function delete_post_by_id($id) {
    db_delete('tbl_blog', "id = {$id}");
}

function get_post_by_id($id) {
    return db_fetch_row("SELECT * FROM tbl_blog WHERE id = $id");
}

function update_post($id, $data) {
    return db_update('tbl_blog', $data, "id = $id");
}

function get_all_categories() {
    return db_fetch_array("SELECT * FROM tbl_blog_category");
}
function search_posts_by_keyword($keyword) {
    $keyword = addslashes($keyword);
    $sql = "SELECT * FROM tbl_blog WHERE title LIKE '%{$keyword}%'";
    return db_fetch_array($sql);
}

