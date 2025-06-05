<?php
function is_username($username)
{
    $partten = "/^[A-Za-z0-9_\.]{3,32}$/";
    if (!preg_match($partten, $username, $matchs)) {
        return false;
    }
    return true;
}


function is_fullname($fullname)
{
    $partten = "/^[A-Za-z0-9_\.]{3,32}$/";
    if (!preg_match($partten, $fullname, $matchs)) {
        return false;
    }
    return true;
}

function is_phone_number($phone) {
    // Loại bỏ khoảng trắng, dấu chấm, gạch ngang
    $phone = preg_replace('/[\s\.\-]/', '', $phone);

    // Kiểm tra bắt đầu bằng 0, có 10 chữ số, và đúng đầu số di động Việt Nam
    return preg_match('/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[1-5]|9[0-9])[0-9]{7}$/', $phone);
}

function is_address($address) {
    return strlen(trim($address)) >= 5 && !preg_match('/[<>$%^*#]/', $address);
}

function is_password($password)
{
    $partten = "/^([\w_\.!@#$%^&*()]+){5,32}$/";
    if (!preg_match($partten, $password, $matchs)) {
        return false;
    }
    return true;
}

function is_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field])) return "<p class='error'>{$error[$label_field]}</p>";
}

// function set_value($label_field)
// {
//     global $$label_field;
//     if (!empty($$label_field)) return $$label_field;
// }

function set_value($field) {
    if (!empty($_POST[$field])) {
        return htmlspecialchars($_POST[$field]);
    }
    return '';
}
