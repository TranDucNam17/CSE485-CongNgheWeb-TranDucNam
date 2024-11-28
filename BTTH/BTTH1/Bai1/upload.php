<?php
// Định nghĩa thư mục lưu trữ ảnh
$target_dir = "Images/";

// Kiểm tra xem người dùng đã gửi form chưa
if (isset($_POST['submit'])) {
    // Lấy thông tin loài hoa và tệp ảnh từ form
    $flower_id = $_POST['flowerId'] ?? $_POST['flower_id']; // Đảm bảo sử dụng một tên biến đồng nhất
    $fileToUpload = $_FILES["fileToUpload"] ?? null; // Kiểm tra nếu tệp tồn tại

    $uploadOk = 1;

    // Kiểm tra nếu chưa có tệp ảnh tải lên
    if (isset($fileToUpload) && $fileToUpload["error"] == 0) {
        // Lấy phần mở rộng tệp
        $file_extension = strtolower(pathinfo($fileToUpload["name"], PATHINFO_EXTENSION));

        // Đặt tên tệp dựa trên ID hoa
        $target_file = $target_dir . "flower_" . $flower_id . "." . $file_extension;

        // Kiểm tra xem tệp có phải là ảnh hay không
        if (getimagesize($fileToUpload["tmp_name"]) === false) {
            echo "Tệp không phải là ảnh.";
            $uploadOk = 0;  // Thiết lập uploadOk = 0 khi có lỗi
        }

        // Kiểm tra nếu ảnh đã tồn tại
        if (file_exists($target_file)) {
            echo "Tệp đã tồn tại.";
            $uploadOk = 0;  // Thiết lập uploadOk = 0 khi ảnh đã tồn tại
        }

        // Kiểm tra kích thước tệp
        if ($fileToUpload["size"] > 10485760) {
            echo "Tệp quá lớn.";
            $uploadOk = 0;  // Thiết lập uploadOk = 0 khi tệp quá lớn
        }s

        // Chỉ cho phép một số định dạng ảnh
        if (!in_array($file_extension, ["jpg", "jpeg", "png", "webp"])) {
            echo "Chỉ cho phép tải lên tệp ảnh JPG, JPEG, PNG và WEBP.";
            $uploadOk = 0;  // Thiết lập uploadOk = 0 khi định dạng không hợp lệ
        }

        // Kiểm tra xem upload có thành công không
        if ($uploadOk == 0) {
            echo "Ảnh không thể tải lên.";
        } else {
            // Di chuyển ảnh vào thư mục và cập nhật vào thông tin loài hoa
            if (move_uploaded_file($fileToUpload["tmp_name"], $target_file)) {
                echo "Tệp " . htmlspecialchars(basename($fileToUpload["name"])) . " đã được tải lên.";
                // Cập nhật ảnh cho loài hoa
                // Load file flowers.php để cập nhật dữ liệu
                include 'flowers.php';

                // Tìm loài hoa cần cập nhật
                foreach ($flowers as &$flower) {
                    if ($flower['id'] == $flower_id) {
                        $flower['image'] = $target_file; // Cập nhật đường dẫn ảnh
                    }
                }

                // Cập nhật lại file flowers.php
                file_put_contents('flowers.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>");

                echo "Ảnh đã được tải lên thành công!";
            } else {
                echo "Có lỗi khi tải lên ảnh.";
            }
        }
    } else {
        echo "Không có tệp nào được tải lên hoặc có lỗi trong quá trình tải lên.";
    }
} else {
    echo "Form chưa được gửi.";
}
?>
