<?php

function get_total_posts() {
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM tbl_blog";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function get_posts_by_page($start, $num_per_page, $order = 'ORDER BY created_at DESC') {
    $sql = "SELECT * FROM tbl_blog $order LIMIT {$start}, {$num_per_page}";
    $result = db_query($sql);

    $list = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row;
        }
    }

    return $list;
}




function get_list_post($start, $num_per_page) {
    return get_posts_by_page($start, $num_per_page, 'ORDER BY created_at DESC');
}

function get_post_by_id($id) {
    $sql = "SELECT * FROM tbl_blog WHERE id = {$id}";
    return db_fetch_row($sql);
}


function insert_post($title, $description, $content, $image = '') {
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `tbl_blog` (`title`, `description`, `content`, `image`, `created_at`) 
            VALUES ('$title', '$description', '$content', '$image', '$created_at')";
    return db_query($sql);
}

function get_list_categories()
{
    return db_fetch_array("SELECT * FROM tbl_blog_category");
}

function get_category_name($id)
{
    if (empty($id)) return 'Không rõ';
    $category = db_fetch_row("SELECT name FROM `tbl_blog_category` WHERE id = $id");
    return !empty($category) ? $category['name'] : 'Không rõ';
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
