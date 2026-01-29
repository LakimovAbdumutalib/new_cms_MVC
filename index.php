<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "app/controllers/AuthController.php";
require_once "app/controllers/UserController.php";
require_once "app/controllers/PostController.php";


$action = $_GET['action'] ?? 'home';

$authController = new AuthController();
$userController = new UserController();
$postController = new PostController();


if($action == 'login'){
    $authController->login();
}elseif($action == 'registration'){
    $authController->registration();
}elseif($action == 'logout'){
    $authController->logout();
}
elseif($action == 'home'){
    $postController->home();
}elseif($action == 'index'){
    $postController->index();
}
elseif ($action == 'users') {
    $userController->index();
} 
elseif ($action == 'delete_user'){
    $userController->delete();
} 
elseif ($action == 'posts'){
    $postController->index();
} 
elseif ($action == 'add_post'){
    $postController->add();
}
elseif ($action == 'edit_post'){
    $postController->edit();
}
elseif ($action == 'delete_post'){
    $postController->delete();
}

?>