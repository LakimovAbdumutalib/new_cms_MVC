<?php
class Post {
    private $conn;
    private $table_name = "pages"; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readPublished() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE status = 'published' ORDER BY created_at DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
    }



    public function readPublishedPaginated(int $limit, int $offset) {
    $query = "SELECT * FROM " . $this->table_name . "
              WHERE status = 'published'
              ORDER BY created_at DESC, id DESC
              LIMIT :limit OFFSET :offset";

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

public function countPublished(): int {
    $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE status = 'published'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return (int)$stmt->fetchColumn();
}

    
    public function readUserPosts() {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt;
    }

    
    public function create($user_id, $title, $content) {
        
        $query = "INSERT INTO " . $this->table_name . " (user_id, title, content, status) VALUES (?, ?, ?, 'draft')";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$user_id, $title, $content]);
    }

    public function publish($id){
        $query = "UPDATE " . $this->table_name . " SET status = 'published' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }


    public function delete($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id =?";
        $query = $this->conn->prepare($query);
        return $query->execute([$id]);
    }

    
    public function readOne($id){
        $query = "SELECT p.*, u.username as author_name 
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.user_id = u.id
                  WHERE p.id = ? 
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } 

    
    public function update($id, $title, $content){
        $query = "UPDATE " . $this->table_name . " SET title = ?, content = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$title, $content, $id]);
    }
}