<?php

//Trả về true nếu đã login
function is_login()
{
    if (isset($_SESSION['is_login'])) {
        return true;
    }
    return false;
}

//Trả về dữ liệu login
function user_login()
{
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return false;
}

//
function info_user($username, $field = 'id')
{
    $list_users = db_fetch_array("SELECT * FROM `tbl_users`");
    if (isset($_SESSION['is_login'])) {
        foreach ($list_users as $user) {
            if ($username == $user['username']) {
                if (array_key_exists($field, $user)) {
                    return $user[$field];
                }
            }
        }
    }
    return false;
}
