<?php
include 'flowers.php';
//var_dump($flowers);

function deleteFlower(&$flowers, $id){
    foreach ($flowers as $key => $flower) {
        if ($flower['id'] == $id) {
            $flowers[$key]['deleted'] = true;
            break;
        }
    }
    // Lưu lại dữ liệu sau khi xóa
    file_put_contents('flowers.php', "<?php\n\$flowers = ". var_export($flowers, true). ";\n?>");
}

function restoreFlower(&$flowers, $id) {
    foreach ($flowers as $key => $flower) {
        if ($flower['id'] == $id && isset($flower['deleted']) && $flower['deleted']) {
            // Xóa cờ đã bị xóa để khôi phục lại loài hoa
            unset($flowers[$key]['deleted']);
            break;
        }
    }
    // Lưu lại dữ liệu sau khi cập nhật
    file_put_contents('flowers.php', "<?php\n\$flowers = ". var_export($flowers, true). ";\n?>");
}

//xử lí khi người dùng gửi yêu cầu xóa
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    deleteFlower($flowers, $id);
}

// Xử lý khi người dùng gửi yêu cầu khôi phục
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restore'])) {
    $id = $_POST['id'];
    restoreFlower($flowers, $id);
}

//xác định chế độ hiển thị khách hoặc quản trị
$mode = isset($_GET['admin']) ? $_GET['admin'] : 'guest';
$template = $mode == 'true' ? 'Templates/admin.php' : 'Templates/guest.php';

include $template;
?>