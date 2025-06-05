<?php
function get_search_result($keyword) {
    $keyword = addslashes($keyword);
    $sql = "SELECT * FROM list_products WHERE product_title LIKE '%$keyword%'" ;
    return db_fetch_array($sql);
}

 