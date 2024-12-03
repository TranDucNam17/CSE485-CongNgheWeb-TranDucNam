<?php
require_once __DIR__ .'/../configs/adminDB.php';
class AdminModel{
    public static function Login($username, $password){
        global $conn;
        $stmt = $conn->prepare("select * from tb_admin where username = ? and password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result->num_rows > 0;
    }
}
?>