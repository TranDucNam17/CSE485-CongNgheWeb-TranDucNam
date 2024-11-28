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
                if(!empty($flowers)){
                    foreach($flowers as $fl):       
                ?>
                <tr>
                    <td><?php echo $fl['id']; ?></td>
                    <td><?php echo $fl['name']; ?></td>
                    <td><img src="<?php echo $fl['image']; ?>" alt="<?php echo $fl['name']; ?>" width="100"></td>
                    <td><?php echo $fl['description']; ?></td>
                </tr>
                <?php endforeach; } else { ?>
                <tr>
                    <td colspan="4">Không có dữ liệu</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>  
</body>
</html>