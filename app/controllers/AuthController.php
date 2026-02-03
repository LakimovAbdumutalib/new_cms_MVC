<?php
class AuthController {

    public function registration() {
        if ($_SERVER['REQUEST_METHOD']=== 'POST'){
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            $database = new Database();
            $db = $database->getConnection();

            $usermodel = new User($db); 

            if($usermodel->exists($username)) {
            $error = "Логин '$username' уже занят. Выберите другой.";
            }elseif ($usermodel->create($username, $password)){
                $new_user_id = $db->lastInsertId(); 

                $_SESSION['user_id'] = $new_user_id;
                $_SESSION['username'] = $username;
                header("Location: index.php?action=posts");
                exit;
            } else {
                $error = "Ошибка регистрации пользователя";
             }
            
        }
            include __DIR__ . "/../views/layout/header.php";
            include __DIR__ . "/../views/auth/registration.php";
            include __DIR__ . "/../views/layout/footer.php";
    }







    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            

            $database = new Database();
            $db = $database->getConnection();
            
            
            $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
            $stmt = $db->prepare($query);
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            
            if ($user && password_verify($password, $user['password'])) {
               
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php?action=posts");
                exit;
            } else {
                $error = "Неверный логин или пароль";
            }
        }

        include __DIR__ . "/../views/layout/header.php";
        include __DIR__ . "/../views/auth/login.php";
        include __DIR__ . "/../views/layout/footer.php";
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}