<?php
// index.php - Entry point application
// 1. kết nối database
require_once './configs/adminDB.php';
// 2. Nhận thông tin bộ điều khiển và hành động từ URL
# Nếu không có tham số bộ điều khiển trên URL, mặc định là 'Admin'
$controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Admin';
# Nếu không có tham số hành động trên URL, mặc định là 'index'
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

//3. Tạo đường dẫn đến tệp điều khiển dựa trên thông tin từ URL
$controllerPath = "./controller/{$controller}Controller.php";
# Lấy tham số id từ URL,
$id = $_GET['id'] ?? null;
//4. Kiểm tra xem bộ điều khiển có tồn tại không
if (file_exists($controllerPath)) {
    require_once $controllerPath;  // Bao gồm tập tin điều khiển
    $controllerClass = $controller . 'Controller';  // Tạo tên lớp điều khiển
    $controllerObject = new $controllerClass();  // Tạo đối tượng điều khiển

    //5. Kiểm tra xem hành động có tồn tại trong bộ điều khiển không
    if (method_exists($controllerObject, $action)) {
       // Check if action requires parameters(id)
       $reflection = new ReflectionMethod($controllerObject, $action);
        
       // If method has id parameters
       if ($reflection->getNumberOfParameters() > 0) {
           // If have id parameter, call action with id
           $controllerObject->$action($id);
       } else {
           // If haven't id parameter, call action with id
           $controllerObject->$action();
       }
    } else {
        // Action does not exist
        echo "404 Not Found: The action does not exist";
    }
} else {
    // Controller does not exist
    echo "404 Not Found: The controller does not exist";
}
?>