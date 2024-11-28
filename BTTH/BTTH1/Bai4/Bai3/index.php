<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class = "container mt-5">
        <h1 class = "text-center text-danger my-3">Danh sách tài khoản</h1>
        <?php
            //đường dẫn file .csv
            $csvfile = 'users.csv'; 

            //kiểm tra file có tồn tại không
            if(file_exists($csvfile)){
                echo '<table class = "table table-bordered table-striped">';
                echo '  <thead class = "table-dark">
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Last name</th>
                                <th>First Name</th>
                                <th>City</th>
                                <th>Email</th>
                                <th>Course</th>
                            </tr>
                        </thead>';
                
                //mở file và đọc nội dung
                $file = fopen($csvfile, 'r');
                
                //bỏ qua dòng tiêu đề 
                fgetcsv($file);
                
                //đọc từng dòng
                echo '<tbody>';
                while(($line = fgetcsv($file)) !== false){
                    echo '<tr>';
                    foreach($line as $cell){
                        echo '<td>'. htmlspecialchars($cell). '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody>';

                fclose($file);
                echo '</table>';
            }else{
                echo '<p class = "text-danger">File CSV không tồn tại.</p>';
            }
        ?>
    </div>
</body>
</html>