<?php
require_once __DIR__ . '/../models/Student.php';

class StudentController {
    private $student;

    public function __construct(){
        $this->student = new Student();
    }

    public function index(){
        $stmt = $this->student->read();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require __DIR__ . '/../views/students/index.php'; // fixed path
    }

    public function create(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize inputs before assigning
            $this->student->name = htmlspecialchars(strip_tags($_POST['name']));
            $this->student->gender = htmlspecialchars(strip_tags($_POST['gender']));
            $this->student->age = (int)$_POST['age'];

            if($this->student->create()){
                header('Location: index.php?action=index');
                exit; // exit after redirect
            } else {
                echo "Error creating student";
            }
        } else {
            require __DIR__ . '/../views/students/create.php'; // fixed path
        }
    }

    public function edit(){
        // Sanitize GET id
        $this->student->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $this->student->readOne();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST inputs
            $this->student->name = htmlspecialchars(strip_tags($_POST['name']));
            $this->student->gender = htmlspecialchars(strip_tags($_POST['gender']));
            $this->student->age = (int)$_POST['age'];
            $this->student->id = (int)$_POST['id'];

            if($this->student->update()){
                header('Location: index.php?action=index');
                exit; // exit after redirect
            } else {
                echo "Error updating student";
            }
        } else {
            require __DIR__ . '/../views/students/edit.php'; // fixed path
        }
    }

    public function delete(){
        // Sanitize GET id
        $this->student->id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if($this->student->softDelete()){
            header('Location: index.php?action=index');
            exit; // exit after redirect
        } else {
            echo "Error deleting student";
        }
    }
}
