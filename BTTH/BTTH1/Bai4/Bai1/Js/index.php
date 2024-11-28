<?php
require './connection.php';
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

    <div class="container mt-4" >
        <h1 class="text-center mb-4 text-primary">Danh Sách Các Loài Hoa</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Decription</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($flowers as $flower) : ?>
                        <tr>
                            <td><?= $flower['id']?></td>
                            <td><img src="<?php echo $flower['image']; ?>" width="100px" alt="" ></td>
                            <td><?php echo $flower['name']; ?></td>
                            <td><?php echo $flower['description']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
        
    </div>

</body>

</html>