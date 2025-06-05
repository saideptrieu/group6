<?php
function construct() {
    load_model('index');
}

function resultAction() {
    if (isset($_POST['s'])) {
        $keyword = $_POST['s'];
        $result = get_search_result($keyword);
        load_view('result', ['result' => $result, 'keyword' => $keyword]);
    } else {
        load_view('result');
    }
}


