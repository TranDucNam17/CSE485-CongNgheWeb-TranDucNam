<?php
    //Sử dụng class PDO để tương tác với CSDL 
     $HOST = "localhost";
     $DB = "flowers";
     $USER = "root";
     $PASS = "";
    $DSN = "mysql:host=$HOST;dbname=$DB";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
       ];
       try {
        $pdo = new PDO($DSN, $USER, $PASS, $options);
        $sql = 'select * from tbflowers';
        $stsm = $pdo->query($sql);
        $results = $stsm->fetchAll();
       } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
       }
    ?>