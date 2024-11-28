<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <a href="index.php?admin=true" class="btn btn-primary mb-3">Chuyển sang chế độ quản trị</a>
    <title>Danh sách các loài hoa</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class = "container">
        <h1>Danh sách các loài hoa</h1>
        <form method="GET" class="form-inline mb-3">
            <input type="text" name="search" class="form-control mr-2" placeholder="Tìm kiếm loài hoa..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
        <table class = "table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($flowers)) {
                        // Lọc hoa dựa trên từ khóa tìm kiếm
                        $searchKeyword = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
    
                        // Lọc danh sách nếu có từ khóa
                        $filteredFlowers = array_filter($flowers, function($flower) use ($searchKeyword) {
                            return empty($searchKeyword) || 
                                   strpos(strtolower($flower['name']), $searchKeyword) !== false || 
                                   strpos(strtolower($flower['description']), $searchKeyword) !== false;
                        });
                        // Hiển thị danh sách hoa đã lọc
                        if (!empty($filteredFlowers)) {
                            foreach ($filteredFlowers as $fl): 
                ?>
                <tr>
                    <td><?php echo $fl['id']; ?></td>
                    <td><?php echo $fl['name']; ?></td>
                    <td><img src="<?php echo $fl['image']; ?>" alt="<?php echo $fl['name']; ?>" width="100"></td>
                    <td><?php echo $fl['description']; ?></td>
                </tr>
                <?php 
                        endforeach; 
                    } else {
                        echo '<tr><td colspan="4">Không tìm thấy loài hoa nào phù hợp.</td></tr>';
                    }
                } else { 
                ?>
                <tr>
                    <td colspan="4">Không có dữ liệu</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>  
</body>
</html>