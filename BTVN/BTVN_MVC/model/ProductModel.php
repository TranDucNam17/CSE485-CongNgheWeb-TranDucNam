<?php
require_once __DIR__ .'/../configs/productDB.php';
class ProductModel{
    public static function getAllProduct(){
        global $conn;#Use conn to database.php
        $sql = "select *from product_tb";
        $result = $conn->query($sql);
        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $conn->close();
        return $products;
    }
    //getProductById
    public static function getProductById($id){
        global $conn;
        $stmt = $conn->prepare("select name, price, image from product_tb where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($name, $price, $image);
        $stmt->fetch();
        $products = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'image' => $image
        ];
        $stmt->close();
    return $products;
    }
    //Add Product
    public static function addProduct($name,$price,$image_url){
        global $conn;
        $stmt = $conn->prepare("insert into product_tb (name, price, image) values (?, ?, ?)");
        $stmt->bind_param("sis", $name, $price, $image_url);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            return false;
        }
    }
    //Update Product
    public static function updateProduct($id, $name, $price, $image_url) {
        global $conn;
        if ($image_url) {
            $stmt = $conn->prepare("UPDATE product_tb SET name = ?, price = ?, image = ? WHERE id = ?");
            $stmt->bind_param("sisi", $name, $price, $image_url, $id);
        } else {
            $stmt = $conn->prepare("UPDATE product_tb SET name = ?, price = ? WHERE id = ?");
            $stmt->bind_param("sii", $name, $price, $id);
        }
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            return false;
        }
    }
    //Delete Product
    public static function deleteProduct($id) {
        global $conn;
        $stmt = $conn->prepare("delete from product_tb where id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            return false;
        }
    }
}
?>