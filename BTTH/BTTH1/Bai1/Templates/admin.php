<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <a href="index.php?admin=true">Chuyển sang chế độ khách</a>
    <title>Quản lý danh sách các loài hoa</title>
</head>
<body>
    <div class="container">
        <h1>Quản lý danh sách các loài hoa</h1>
        <a href="index.php?admin=false" class="btn btn-primary mb-3">Chuyển sang chế độ khách</a>
        
        <!-- Menu -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="addFlowerTab" href="#">Thêm Hoa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="editFlowerTab" href="#">Sửa Hoa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="deleteFlowerTab" href="#">Xóa Hoa</a>
            </li>
            <li class="nav-item ml-auto">
                <!-- Form tìm kiếm -->
                <form method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Tìm kiếm loài hoa..." 
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button type="submit" class="btn btn-outline-primary">Tìm</button>
                </form>
            </li>
        </ul>

        <!-- Form Thêm Hoa Mới -->
        <div id="addFlowerForm">
            <h3>Thêm Hoa Mới</h3>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <label for="flowerName">Tên loài hoa:</label>
                <input type="text" name="flowerName" id="flowerName" required><br><br>

                <label for="flowerDescription">Mô tả loài hoa:</label>
                <textarea name="flowerDescription" id="flowerDescription" rows="4" required></textarea><br><br>

                <label for="fileToUpload">Chọn ảnh:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" required><br><br>

                <input type="submit" value="Thêm Hoa" name="addFlower">
            </form>
        </div>

        <!-- Form Sửa Thông Tin Hoa -->
        <div id="editFlowerForm" style="display:none;">
            <h3>Sửa Thông Tin Hoa</h3>
            <form action="admin.php" method="post">
                <label for="flowerIdToEdit">Chọn loài hoa cần sửa:</label>
                <select name="flowerIdToEdit" id="flowerIdToEdit" required>
                    <?php foreach($flowers as $flower): ?>
                        <option value="<?php echo $flower['id']; ?>"><?php echo $flower['name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="newFlowerName">Tên loài hoa mới:</label>
                <input type="text" name="newFlowerName" id="newFlowerName"><br><br>

                <label for="newFlowerDescription">Mô tả mới:</label>
                <textarea name="newFlowerDescription" id="newFlowerDescription" rows="4"></textarea><br><br>

                <label for="newFileToUpload">Chọn ảnh mới:</label>
                <input type="file" name="newFileToUpload" id="newFileToUpload"><br><br>

                <input type="submit" value="Sửa Thông Tin" name="editFlower">
            </form>
        </div>

        <!-- Form Xóa Hoa -->
        <div id="deleteFlowerForm" style="display:none;">
            <h3>Xóa Hoa</h3>
            <form action="admin.php" method="post">
                <label for="flowerIdToDelete">Chọn loài hoa cần xóa:</label>
                <select name="flowerIdToDelete" id="flowerIdToDelete" required>
                    <?php foreach($flowers as $flower): ?>
                        <option value="<?php echo $flower['id']; ?>"><?php echo $flower['name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <input type="submit" value="Xóa Hoa" name="deleteFlower">
            </form>
        </div>

        <h3>Danh sách các loài hoa</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên loài hoa</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Xử lý tìm kiếm
                    $searchKeyword = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
                    $filteredFlowers = array_filter($flowers, function($flower) use ($searchKeyword) {
                        return empty($searchKeyword) || 
                               strpos(strtolower($flower['name']), $searchKeyword) !== false || 
                               strpos(strtolower($flower['description']), $searchKeyword) !== false;
                    });

                    // Hiển thị danh sách các loài hoa
                    foreach($flowers as $fl):
                ?>
                <tr>
                    <td><?php echo $fl['id']; ?></td>
                    <td><?php echo $fl['name']; ?></td>
                    <td><?php echo $fl['description']; ?></td>
                    <td><img src="<?php echo $fl['image'];?>" alt="<?php echo $fl['name']; ?>" width="100"></td>
                    <td>
                        <!-- Form để xóa loài hoa -->
                        <form action="admin.php" method="POST">
                            <input type="hidden" name="flower_id" value="<?php echo $fl['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php
        // Xử lý Thêm Hoa Mới
        if (isset($_POST['addFlower'])) {
            $newFlowerName = $_POST['flowerName'];
            $newFlowerDescription = $_POST['flowerDescription'];
            $fileToUpload = $_FILES['fileToUpload'];
        
            if ($fileToUpload['error'] === 0) {
                $target_dir = "Images/";
                $file_extension = strtolower(pathinfo($fileToUpload["name"], PATHINFO_EXTENSION));
                $target_file = $target_dir . "flower_" . uniqid() . "." . $file_extension;
        
                if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    if (move_uploaded_file($fileToUpload['tmp_name'], $target_file)) {
                        include 'flowers.php';
                        $newFlower = [
                            'id' => count($flowers) + 1,
                            'name' => $newFlowerName,
                            'description' => $newFlowerDescription,
                            'image' => $target_file,
                        ];
                        $flowers[] = $newFlower;
        
                        if (file_put_contents('flowers.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>")) {
                            echo "<script>alert('Hoa mới đã được thêm thành công!'); window.location.reload();</script>";
                        } else {
                            die("Không thể ghi dữ liệu vào file flowers.php.");
                        }
                    } else {
                        die("Không thể tải lên file.");
                    }
                } else {
                    die("Định dạng file không hợp lệ.");
                }
            } else {
                die("Có lỗi xảy ra khi tải lên file.");
            }
        }
        

        // Xử lý Sửa Thông Tin Hoa
        if (isset($_POST['editFlower'])) {
            $flowerIdToEdit = $_POST['flowerIdToEdit'];
            $newFlowerName = $_POST['newFlowerName'] ?? null;
            $newFlowerDescription = $_POST['newFlowerDescription'] ?? null;
            $newFileToUpload = $_FILES['newFileToUpload'] ?? null;

            // Load danh sách hoa
            include 'flowers.php';

            // Tìm hoa cần sửa và cập nhật thông tin
            foreach ($flowers as &$flower) {
                if ($flower['id'] == $flowerIdToEdit) {
                    if ($newFlowerName) {
                        $flower['name'] = $newFlowerName;
                    }
                    if ($newFlowerDescription) {
                        $flower['description'] = $newFlowerDescription;
                    }

                    // Xử lý ảnh mới
                    if ($newFileToUpload && $newFileToUpload['error'] == 0) {
                        $target_dir = "Images/";
                        $file_extension = strtolower(pathinfo($newFileToUpload["name"], PATHINFO_EXTENSION));
                        $target_file = $target_dir . "flower_" . $flowerIdToEdit . "." . $file_extension;

                        // Di chuyển tệp ảnh
                        if (move_uploaded_file($newFileToUpload['tmp_name'], $target_file)) {
                            $flower['image'] = $target_file;
                        }
                    }
                    break;
                }
            }

            // Lưu lại mảng hoa vào file flowers.php
            file_put_contents('flowers.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>");

            echo "<script>alert('Thông tin hoa đã được cập nhật!'); window.location.reload();</script>";
        }

        // Xử lý Xóa Hoa
        if (isset($_POST['deleteFlower'])) {
            $flowerIdToDelete = $_POST['flowerIdToDelete'];

            // Load danh sách hoa
            include 'flowers.php';

            // Tìm và xóa hoa
            foreach ($flowers as $key => $flower) {
                if ($flower['id'] == $flowerIdToDelete) {
                    unset($flowers[$key]);
                    break;
                }
            }

            // Lưu lại mảng hoa vào file flowers.php
            file_put_contents('flowers.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>");

            echo "<script>alert('Hoa đã được xóa!'); window.location.reload();</script>";
        }
            
    ?>

    <script>
        // JavaScript để chuyển đổi giữa các form
        $(document).ready(function() {
            $('#addFlowerTab').click(function() {
                $('#addFlowerForm').show();
                $('#editFlowerForm').hide();
                $('#deleteFlowerForm').hide();
                $(this).addClass('active');
                $('#editFlowerTab').removeClass('active');
                $('#deleteFlowerTab').removeClass('active');
            });

            $('#editFlowerTab').click(function() {
                $('#editFlowerForm').show();
                $('#addFlowerForm').hide();
                $('#deleteFlowerForm').hide();
                $(this).addClass('active');
                $('#addFlowerTab').removeClass('active');
                $('#deleteFlowerTab').removeClass('active');
            });

            $('#deleteFlowerTab').click(function() {
                $('#deleteFlowerForm').show();
                $('#addFlowerForm').hide();
                $('#editFlowerForm').hide();
                $(this).addClass('active');
                $('#addFlowerTab').removeClass('active');
                $('#editFlowerTab').removeClass('active');
            });
        });
    </script>
</body>
</html>
