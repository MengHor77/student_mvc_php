<?php
require_once __DIR__ . '/../config/database.php';

class Student {
    private $conn;
    private $table = "students";

    public $id;
    public $name;
    public $gender;
    public $age;
    public $is_delete;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    //  ONE-TIME: Create students table
    public function createTable() {
        $sql = "
            CREATE TABLE IF NOT EXISTS {$this->table} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255),
                gender VARCHAR(10),
                age INT,
                is_delete BOOLEAN DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );
        ";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    // Read all students
    public function read(){
        $query = "SELECT * FROM {$this->table} WHERE is_delete = 0 ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create new student
    public function create(){
        $query = "INSERT INTO {$this->table} SET name=:name, gender=:gender, age=:age, is_delete=0";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->age = htmlspecialchars(strip_tags($this->age));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':age', $this->age);

        return $stmt->execute();
    }

    // Read one student
    public function readOne(){
        $query = "SELECT * FROM {$this->table} WHERE id = ? AND is_delete = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $this->name = $row['name'];
            $this->gender = $row['gender'];
            $this->age = $row['age'];
        }
    }

    // Update student
    public function update(){
        $query = "UPDATE {$this->table} SET name=:name, gender=:gender, age=:age WHERE id=:id AND is_delete=0";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Soft delete
    public function softDelete(){
        $query = "UPDATE {$this->table} SET is_delete = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
