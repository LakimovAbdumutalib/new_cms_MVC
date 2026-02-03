<?php
require_once "config/database.php";
require_once "app/models/User.php";




class UserController{






    public function allUsers(){
        $database =new Database();
        $db = $database->getConnection();

        $userModel = new User($db);
        $stmt = $userModel->readAll();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include "app/views/layout/header.php"; 
        include "app/views/admin_list.php";    
        include "app/views/layout/footer.php";  
    }





    public function delete(){
        if ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['user_id'])){
            $database = new Database();
            $db = $database->getConnection();

            $userModel = new User($db);
            $id = (int)$_POST['user_id'];

            if($userModel->delete($id)){
                header("Location: index.php?action=users&status=deleted");
            }
        }
    }
}
?>
