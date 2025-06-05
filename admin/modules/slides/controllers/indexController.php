<?php
function construct()
{
  load_model('index');
  load('lib', 'validation');
}

function indexAction()
{
  $keyword = "";

  if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
  }

  if (!empty($keyword)) {
    $list_slides = search_slides($keyword);
  } else {
    $list_slides = get_list_slides();
  }

  $data['list_slides'] = $list_slides;
  $data['keyword'] = $keyword;

  load_view('index', $data);
}

function addAction()
{
  global $error, $title, $description, $order, $status;

  if (isset($_POST['btn-add'])) {
    $error = array();

    // Kiểm tra tiêu đề
    if (empty($_POST['title'])) {
      $error['title'] = "Không được để trống tiêu đề";
    } else {
      $title = $_POST['title'];
    }

    // Kiểm tra mô tả
    if (empty($_POST['description'])) {
      $error['description'] = "Không được để trống mô tả";
    } else {
      $description = $_POST['description'];
    }

    // Lấy thứ tự
    if (isset($_POST['order'])) {
      $order = $_POST['order'];
    } else {
      $order = 1;
    }

    // Lấy trạng thái
    if (isset($_POST['status'])) {
      $status = $_POST['status'];
    } else {
      $status = 1;
    }

    // Xử lý upload hình ảnh
    $upload_dir = "public/images/";
    $upload_file = $upload_dir . basename($_FILES['image']['name']);
    $image_url = "";

    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
      $image_url = $upload_file;
    } else {
      $error['image'] = "Không upload được hình ảnh";
    }

    // Thêm slide nếu không có lỗi
    if (empty($error)) {
      $data = array(
        'title' => $title,
        'description' => $description,
        'image_url' => $image_url,
        'slide_order' => $order,
        'status' => $status,
        'created_at' => date('Y-m-d H:i:s')
      );

      add_slide($data);
      redirect("?mod=slides&action=index");
    }
  }

  load_view('add');
}

function editAction()
{
  $id = isset($_GET['id']) ? $_GET['id'] : 0;

  if (!$id) {
    redirect("?mod=slides&action=index");
  }

  $slide = get_slide_by_id($id);
  if (!$slide) {
    redirect("?mod=slides&action=index");
  }

  global $error;

  if (isset($_POST['btn-update'])) {
    $error = array();

    // Kiểm tra tiêu đề
    if (empty($_POST['title'])) {
      $error['title'] = "Không được để trống tiêu đề";
    } else {
      $title = $_POST['title'];
    }

    // Kiểm tra mô tả
    if (empty($_POST['description'])) {
      $error['description'] = "Không được để trống mô tả";
    } else {
      $description = $_POST['description'];
    }

    // Lấy thứ tự
    if (isset($_POST['order'])) {
      $order = $_POST['order'];
    } else {
      $order = 1;
    }

    // Lấy trạng thái
    if (isset($_POST['status'])) {
      $status = $_POST['status'];
    } else {
      $status = 1;
    }

    // Chuẩn bị dữ liệu cập nhật
    $data = array(
      'title' => $title,
      'description' => $description,
      'slide_order' => $order,
      'status' => $status,
      'updated_at' => date('Y-m-d H:i:s')
    );

    // Xử lý upload hình ảnh nếu có
    if (!empty($_FILES['image']['name'])) {
      $upload_dir = "public/uploads/slides/";
      $upload_file = $upload_dir . basename($_FILES['image']['name']);

      if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
        $data['image_url'] = $upload_file;
      } else {
        $error['image'] = "Không upload được hình ảnh";
      }
    }

    // Cập nhật slide nếu không có lỗi
    if (empty($error)) {
      update_slide($id, $data);
      redirect("?mod=slides&action=index");
    }
  }

  $data['slide'] = $slide;
  load_view('edit', $data);
}

function deleteAction()
{
  $id = isset($_GET['id']) ? $_GET['id'] : 0;

  if ($id) {
    delete_slide($id);
  }

  redirect("?mod=slides&action=index");
}

function changeStatusAction()
{
  $id = isset($_GET['id']) ? $_GET['id'] : 0;

  if ($id) {
    $slide = get_slide_by_id($id);
    $new_status = $slide['status'] == 1 ? 0 : 1;

    $data = array(
      'status' => $new_status,
      'updated_at' => date('Y-m-d H:i:s')
    );

    update_slide($id, $data);
  }

  redirect("?mod=slides&action=index");
}
