<?php
class User{
    private $conn;
    private $table_name ="users";

    public function __construct($db){
        $this->conn = $db;
    }


    public function create($username, $password){
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$username, $password]);
    }

    public function exists($username){
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch() ? true : false;

     }


    public function readAll(){
        $query = "SELECT id, username, created_at FROM " .$this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([$id]);
    }
}
?>