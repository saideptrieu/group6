<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function listPostAction()
{
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc']) ? $_GET['sort'] : 'desc';

    if (!empty($keyword)) {
        $list_posts = search_posts_by_keyword($keyword);
    } else {
        $list_posts = get_list_posts($sort);
    }

    $categories = get_list_categories();
    $data = [
        'list_posts' => $list_posts,
        'categories' => $categories,
        'keyword' => $keyword,
        'sort' => $sort,
    ];
    load_view('listPost', $data);
}

function addPostAction()
{
    if (isset($_POST['btn-submit'])) {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;

        $image = 'no-image.png'; // ảnh mặc định nếu không upload

        if (!empty($_FILES['file']['name'])) {
            $upload_dir = 'public/images/';
            $target_file = $upload_dir . basename($_FILES['file']['name']);
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    $image = $_FILES['file']['name'];
                }
            }
        }

        $data = [
            'title' => $title,
            'description' => $desc,
            'content' => '', // nếu bạn muốn dùng trường này
            'image' => $image,
            'created_at' => date('Y-m-d H:i:s'),
            'category_id' => $category_id,
        ];

        add_post($data); // model insert dữ liệu vào DB

        redirect("?mod=post&action=listPost");
    }

    load_view('addPost');
}

function editPostAction()
{
    $id = $_GET['id'];
    $post = get_post_by_id($id);
    $categories = get_all_categories();

    if (isset($_POST['btn_update'])) {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $content = $_POST['content'];
        $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;

        $image = $post['image']; // mặc định giữ ảnh cũ

        if (!empty($_FILES['file']['name'])) {
            $upload_dir = 'public/images/';
            $target_file = $upload_dir . basename($_FILES['file']['name']);
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    $image = $_FILES['file']['name'];
                }
            }
        }

        $data = [
            'title' => $title,
            'description' => $desc,
            'content' => $content, // hoặc bạn có thể lấy $_POST['content']
            'image' => $image,
            'category_id' => $category_id,
        ];

        update_post($id, $data); // model update
        redirect("?mod=post&action=listPost");
    }

    load_view('editPost', compact('post', 'categories'));
}

function deletePostAction()
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id > 0) {
        delete_post_by_id($id);
    }
    redirect("?mod=post&action=listPost");
}

function listCatAction()
{
    $category_id = isset($_GET['id']) ? $_GET['id'] : '';
    $categories = get_list_categories();
    $list_posts = [];
    $current_category = $category_id;

    if ($category_id === '') {
        $list_posts = get_posts_without_category();
        $current_category = '';
    } else {
        $category_id = (int)$category_id;
        $list_posts = get_posts_by_category($category_id);
    }

    $data = [
        'list_posts' => $list_posts,
        'categories' => $categories,
        'current_category' => $current_category,
    ];

    load_view('listCat', $data);
}
