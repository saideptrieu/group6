<?php

function base_url($url = "") {
    global $config;
    return $config['base_url'].$url;
}

function dd($data) {
    echo '<pre>';
    print_r($data);
    echo '<pre>';
}
