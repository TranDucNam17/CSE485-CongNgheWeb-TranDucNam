<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "questions";

// Kết nối cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra khi có file được tải lên
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"]["tmp_name"];
    
    if (is_uploaded_file($file)) {
        $content = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $currentQuestion = "";
        $currentOptions = [];
        $answer = "";

        foreach ($content as $line) {
            $line = trim($line); // Loại bỏ khoảng trắng ở đầu và cuối dòng
            if (empty($line)) continue;

            if (strpos($line, "ANSWER:") === 0) {
                // Lấy đáp án
                $answer = trim(str_replace("ANSWER:", "", $line));
                
                // Lưu câu hỏi và các tùy chọn vào MySQL
                if (!empty($currentQuestion) && count($currentOptions) === 4 && !empty($answer)) {
                    $stmt = $conn->prepare("INSERT INTO quiz (question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?)");

                    // Sửa lại số lượng tham số
                    $stmt->bind_param(
                        "ssssss",  // Chỉ định 6 tham số: câu hỏi, 4 lựa chọn, và đáp án đúng
                        $currentQuestion,
                        $currentOptions[0],
                        $currentOptions[1],
                        $currentOptions[2],
                        $currentOptions[3],
                        $answer
                    );

                    // Thực thi câu lệnh
                    $stmt->execute();

                    // Reset câu hỏi và tùy chọn
                    $currentQuestion = "";
                    $currentOptions = [];
                    $answer = "";
                }
            } elseif (preg_match('/^[A-D]\./', $line)) {
                // Lưu tùy chọn (A., B., C., D.)
                $currentOptions[] = trim(substr($line, 2)); // Lấy nội dung bỏ "A. ", "B. ", ...
            } else {
                // Tạo câu hỏi
                $currentQuestion .= $line . " ";
            }
        }

        echo "<div class='alert alert-success text-center'>Lưu dữ liệu thành công!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Không thể tải lên file.</div>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải lên file Câu hỏi trắc nghiệm</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tải lên file Câu hỏi trắc nghiệm</h1>

        <form action="./index.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">Chọn file TXT chứa câu hỏi:</label>
                <input type="file" class="form-control" id="file" name="file" accept=".txt" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu vào CSDL</button>
        </form>
    </div>
</body>

</html>