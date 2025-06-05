<?php
function add_post($data)
{
    db_insert('tbl_blog', $data);
}

function get_list_posts($sort = 'desc')
{
    $sort = strtoupper($sort) === 'ASC' ? 'ASC' : 'DESC';
    $sql = "SELECT * FROM tbl_blog ORDER BY created_at $sort";
    return db_fetch_array($sql);
}


function get_category_name($id)
{
    if (empty($id)) return 'Không rõ';
    $category = db_fetch_row("SELECT name FROM `tbl_blog_category` WHERE id = $id");
    return !empty($category) ? $category['name'] : 'Không rõ';
}

function get_list_categories()
{
    return db_fetch_array("SELECT * FROM tbl_blog_category");
}

function delete_post_by_id($id)
{
    db_delete('tbl_blog', "id = {$id}");
}

function get_post_by_id($id)
{
    return db_fetch_row("SELECT * FROM tbl_blog WHERE id = $id");
}

function update_post($id, $data)
{
    return db_update('tbl_blog', $data, "id = $id");
}

function get_all_categories()
{
    return db_fetch_array("SELECT * FROM tbl_blog_category");
}
function search_posts_by_keyword($keyword)
{
    $keyword = addslashes($keyword);
    $sql = "SELECT * FROM tbl_blog WHERE title LIKE '%{$keyword}%'";
    return db_fetch_array($sql);
}

function get_posts_by_category($cat_id)
{
    $cat_id = (int)$cat_id;
    $sql = "SELECT * FROM tbl_blog WHERE category_id = {$cat_id} ORDER BY created_at DESC";
    return db_fetch_array($sql);
}

function get_posts_without_category()
{
    $sql = "SELECT * FROM tbl_blog WHERE category_id IS NULL OR category_id = 0 ORDER BY created_at DESC";
    return db_fetch_array($sql);
}
