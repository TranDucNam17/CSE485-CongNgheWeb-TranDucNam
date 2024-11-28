<?php
    include 'config.php';
    // Truy vấn dữ liệu từ bảng
    $sql = "SELECT username, password, lastname, firstname, city, email, course FROM 64KTPM1"; 
    $result = $conn->query($sql);

    // Tạo file CSV
    if ($result->num_rows > 0) {
        $filename = "users.csv";
        $file = fopen($filename, "w");

        // Lấy tiêu đề cột
        $columns = $result->fetch_fields();
        $headers = [];
        foreach ($columns as $column) {
            $headers[] = $column->name;
        }
        fputcsv($file, $headers);

        // Lưu dữ liệu vào file CSV
        while($row = $result->fetch_assoc()) {
            fputcsv($file, $row);
        }

        fclose($file);
        echo "Dữ liệu đã được xuất ra file CSV thành công!";
    } else {
        echo "Không có dữ liệu!";
    }

    $conn->close();
?>