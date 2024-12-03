
<?php
require_once __DIR__ . '/../model/AdminModel.php';
class AdminController{
    //Requied index
    public function index(){
        require __DIR__ .'/../view/AdminView/admin.php';
    }
    public function SignIn(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['signIn'])&&$_POST['signIn']==="Login"){
                if (isset($_POST['username'], $_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $result=AdminModel::Login($username,$password);
                    if ($result)
                        header("Location: index.php?controller=Product&action=index");
                    else echo "Invalid username or password";
                }
            }
        }
    }
}
?>
