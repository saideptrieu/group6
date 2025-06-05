<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function listPostAction()
{
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    if (!empty($keyword)) {
        $list_posts = search_posts_by_keyword($keyword);
    } else {
        $list_posts = get_list_posts();
    }

    $categories = get_list_categories(); // load toàn bộ danh mục
    $data = [
        'list_posts' => $list_posts,
        'categories' => $categories,
        'keyword' => $keyword,
    ];
    load_view('listPost', $data);
}



function addPageAction()
{
    load_view('addPage');
}

function listPageAction()
{
    load_view('listPage');
}

function addPostAction()
{
    if (isset($_POST['btn-submit'])) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $desc = $_POST['desc'];
        $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
        $image = 'no-image.png'; // mặc định

        // Handle file upload
        if (!empty($_FILES['file']['name'])) {
            $upload_dir = 'public/images/';
            $upload_file = $upload_dir . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                $image = $_FILES['file']['name'];
            }
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'description' => $desc,
            'content' => '', // nếu có trường content riêng thì lấy thêm
            'image' => $image,
            'created_at' => date('Y-m-d H:i:s'),
            'category_id' => $category_id,
        ];

        add_post($data); // Gọi model để insert

        redirect("?mod=post&action=listPost");
    }

    load_view('addPost');
}

function listCatAction()
{
    load_view('listCat');
}

function listProductAction()
{
    load_view('listProduct');
}

function addProductAction()
{
    load_view('addProduct');
}

function listCustomerAction()
{
    load_view('listCustomer');
}

function listOrderAction()
{
    load_view('listOrder');
}

function menuAction()
{
    load_view('menu');
}

function addSliderAction()
{
    load_view('addSlider');
}

function listSliderAction()
{
    load_view('listSlider');
}

function addWidgetAction()
{
    load_view('addWidget');
}

function listWidgetAction()
{
    load_view('listWidget');
}

function updateAction() {}

function deletePostAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id > 0) {
        delete_post_by_id($id);
    }
    redirect("?mod=post&action=listPost");
}

function editPostAction()
{
    $id = $_GET['id'];
    $post = get_post_by_id($id);
    $categories = get_all_categories();

    if (isset($_POST['btn_update'])) {
        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'category_id' => isset($_POST['category_id']) ? $_POST['category_id'] : null
        ];
        update_post($id, $data);
        header("Location: ?mod=post&action=listPost");
        exit();
    }



    load_view('editPost', compact('post', 'categories'));
}
