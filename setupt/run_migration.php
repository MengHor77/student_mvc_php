<?php
require_once '../models/Student.php';

// Create a student instance
$student = new Student();

// Call the method from the model
if ($student->createTable()) {
    echo "✅ Table 'students' created using MVC Model.";
} else {
    echo "❌ Failed to create table.";
}
