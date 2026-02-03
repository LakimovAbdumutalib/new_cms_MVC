<?php
require_once "config/database.php";
require_once "app/models/Post.php";

class PostController {


        public function home(){
        
            $database = new Database();
            $db = $database->getConnection();
            $postModel = new Post($db);



            $page  = max(1, (int)($_GET['page'] ?? 1));
            $limit = 10;

            $total = $postModel->countPublished();
            $totalPages = max(1, (int)ceil($total / $limit));

            if ($page > $totalPages) {
                header("Location: index.php?action=home&page=" . $totalPages);
                exit;
            }

            $offset = ($page - 1) * $limit;

            $stmt = $postModel->readPublishedPaginated($limit, $offset);
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


           
            include __DIR__ . "/../views/layout/header.php";
            include __DIR__ . "/../views/home.php"; 
            include __DIR__ . "/../views/layout/footer.php";
    }







        public function index() {
            $database = new Database();
            $db = $database->getConnection();

            $postModel = new Post($db);
            $stmt = $postModel->readUserPosts();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "/../views/layout/header.php";
        include __DIR__ . "/../views/post_list.php";
        include __DIR__ . "/../views/layout/footer.php";
    }

    







        public function add() {
            if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $database = new Database();
                $db = $database->getConnection();
                $postModel = new Post($db);

                if ($postModel->create($_SESSION['user_id'], $_POST['title'], $_POST['content'])) {
                    header("Location: index.php?action=posts");
                    exit;
                }
            }
            
            include __DIR__ . "/../views/layout/header.php";
            include __DIR__ . "/../views/post_create.php";
            include __DIR__ . "/../views/layout/footer.php";
    }
    





        public function publish() {
            if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
            }
            $id = $_GET['id'] ?? null;  
            if ($id) {
                $database = new Database();
                $db = $database->getConnection();
                $postModel = new Post($db);
                
                $postModel->publish($id);
            }
        header("Location: index.php?action=posts");
        exit;
    }




        public function readPost(){
            $id = $_GET['id'] ?? null;
            $database = new Database();
            $db = $database->getConnection();
            $postModel = new Post($db);
            $post = $postModel->readOne($id);

            include __DIR__ . "/../views/layout/header.php";
            include __DIR__ . "/../views/read_post.php"; 
            include __DIR__ . "/../views/layout/footer.php";
        }

        public function edit() {
            if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
                exit;
            }   



            $id = $_GET['id'] ?? null;
            $database = new Database();
            $db = $database->getConnection();
            $postModel = new Post($db);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                if ($postModel->update($id, $_POST['title'], $_POST['content'])) {
                    header("Location: index.php?action=posts");
                    exit;
                }
            }
            $post = $postModel->readOne($id);

        include __DIR__ . "/../views/layout/header.php";
        include __DIR__ . "/../views/post_edit.php"; 
        include __DIR__ . "/../views/layout/footer.php";
    }






        public function delete() {
            if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?action=login");
    exit;
}
            $id = $_GET['id'] ?? null;
            
            if ($id) {
                $database = new Database();
                $db = $database->getConnection();
                $postModel = new Post($db);
                
                $postModel->delete($id);
            }
        
        
        header("Location: index.php?action=posts");
        exit;
    }
}