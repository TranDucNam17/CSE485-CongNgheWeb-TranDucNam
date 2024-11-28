<?php 
    require './connection.php';
    if ($_POST['method'] == 'ADD') {
        $target_dir = "images/"; //Đây là thư mục đích trên server, nơi file tải lên sẽ được lưu trữ.
        $target_file = $target_dir . basename($_FILES["Image"]["name"]); // đường dẫn tới file
        move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);
        $name = $_POST['Name'];
        $description = $_POST['Description'];
        echo $name." ".$description;
        $sql = 'insert into tbflowers(name,description,image) values (:name,:description,:image)';
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':description',$description);
            $stmt->bindParam(':image',$target_file);
            $stmt->execute();
            header('location: trang_quan_tri.php');
        }catch(PDOException $ex){
            echo 'Error: '.$ex->getMessage();
        }
    }else if($_POST['method'] == 'EDIT'){
        $target_dir = "images/"; //Đây là thư mục đích trên server, nơi file tải lên sẽ được lưu trữ.
        $target_file = $target_dir . basename($_FILES["Image"]["name"]); // đường dẫn tới file
        $name = $_POST['Name'];
        $description = $_POST['Description'];
        $id = $_POST['id'];
        move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);
        if (!empty($_FILES["Image"]["name"])) {
            $sql ='update tbflowers set name = :name,description = :description,image = :image where id=:id';
            try{
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name',$name);
                $stmt->bindParam(':description',$description);
                $stmt->bindParam(':image',$target_file);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
            }catch(PDOException $ex){
                echo 'Error: '.$ex->getMessage();
            }
            header('location: trang_quan_tri.php');     
        } else {
            $sql ='update tbflowers set name = :name,description = :description where id=:id';
            try{
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name',$name);
                $stmt->bindParam(':description',$description);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
            }catch(PDOException $ex){
                echo 'Error: '.$ex->getMessage();
                
            }
            header('location: trang_quan_tri.php');
        }
    }else{
        $sql = 'delete from tbflowers where id = :id ';
        $id = $_POST['id'];
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            header('location: trang_quan_tri.php');

        }catch(PDOException $ex){
            echo 'Error: '.$ex->getMessage();
            
        }
    }
?>