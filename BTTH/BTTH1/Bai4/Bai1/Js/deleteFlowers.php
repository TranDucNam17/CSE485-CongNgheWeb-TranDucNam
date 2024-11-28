<?php
require 'connection.php';
$flowers = $results;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THẾ GIỚI HOA</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center text-danger mb-4">Bạn có muốn xóa Hoa</h1>

        <form action="process.php" method="POST" id="deleteFlowerForm " class = "d-flex justify-content-center align-items-center" >
            <!-- Hidden input để gửi chỉ mục hoa -->
            <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
            <input type="hidden" name="method" value="delete">

            <button type="submit" class="btn btn-danger mx-2">Xóa Hoa</button>
            <a href="trang_quan_tri.php" class="btn btn-secondary mx-2">Quay lại</a>
        </form>

    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>