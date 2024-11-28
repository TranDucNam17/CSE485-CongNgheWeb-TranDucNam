
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
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản Lý Thông Tin Các Loài Hoa</h1>
            <!-- Nút Thêm Hoa Mới -->
            <a href="addFlowers.php" class="btn btn-primary">Thêm Hoa Mới</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <!-- Số thứ tự -->
                        <td><?php echo $flower['id'] ?></td>

                        <!-- Tên hoa -->
                        <td><?php echo htmlspecialchars($flower['name']); ?></td>

                        <!-- Mô tả -->
                        <td><?php echo htmlspecialchars($flower['description']); ?></td>

                        <!-- Hình ảnh -->
                        <td>
                            <img src="<?php echo $flower['image']; ?>" alt="<?php echo htmlspecialchars($flower['name']); ?>"
                                class="img-fluid" style="max-width: 100px;"
                                onerror="this.src='./images/default.jpg'">
                        </td>

                        <!-- Hành động -->
                        <td>
                            <a href="editFlowers.php?id=<?php echo $flower['id']; ?>" class="btn btn-success btn-sm my-2 ">Sửa</a>
                            <a href="deleteFlowers.php?id=<?php echo $flower['id']; ?>" class="btn btn-danger btn-sm my-2">Xoá</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>
