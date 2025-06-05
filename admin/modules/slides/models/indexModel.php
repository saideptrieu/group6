<?php

/**
 * Thêm slide mới vào hệ thống
 * @param array $data Dữ liệu slide
 * @return int ID của slide vừa thêm
 */
function add_slide($data)
{
    return db_insert('tbl_slides', $data);
}

/**
 * Cập nhật thông tin slide
 * @param int $id ID của slide cần cập nhật
 * @param array $data Dữ liệu cập nhật
 * @return bool Kết quả cập nhật
 */
function update_slide($id, $data)
{
    return db_update('tbl_slides', $data, "`id` = {$id}");
}

/**
 * Xóa slide theo ID
 * @param int $id ID của slide cần xóa
 * @return bool Kết quả xóa
 */
function delete_slide($id)
{
    return db_delete('tbl_slides', "`id` = {$id}");
}

/**
 * Lấy danh sách tất cả slide trong hệ thống
 * @return array Danh sách slide
 */
function get_list_slides()
{
    return db_fetch_array("SELECT * FROM `tbl_slides` ORDER BY `slide_order` ASC");
}

/**
 * Tìm kiếm slides theo từ khóa
 * @param string $keyword Từ khóa tìm kiếm
 * @return array Danh sách slides tìm thấy
 */
function search_slides($keyword = '')
{
    if (empty($keyword)) {
        return get_list_slides();
    }
    
    $keyword = escape_string($keyword);
    return db_fetch_array("SELECT * FROM `tbl_slides` 
                          WHERE `title` LIKE '%{$keyword}%' 
                          OR `description` LIKE '%{$keyword}%' 
                          ORDER BY `slide_order` ASC");
}

/**
 * Lấy thông tin slide theo ID
 * @param int $id ID của slide
 * @return array Thông tin slide
 */
function get_slide_by_id($id)
{
    return db_fetch_row("SELECT * FROM `tbl_slides` WHERE `id` = {$id}");
}

/**
 * Lấy số lượng slide trong hệ thống
 * @return int Số lượng slide
 */
function get_slides_count()
{
    return db_num_rows("SELECT * FROM `tbl_slides`");
}

/**
 * Lấy danh sách slide đang hoạt động (status = 1)
 * @return array Danh sách slide đang hoạt động
 */
function get_active_slides()
{
    return db_fetch_array("SELECT * FROM `tbl_slides` WHERE `status` = 1 ORDER BY `slide_order` ASC");
} 