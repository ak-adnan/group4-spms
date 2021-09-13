<?php
    include 'mysql.php';

    $query = "SELECT COUNT(*) FROM student";
    $user = $conn->query($query)->fetch_row()[0];
    $query = "SELECT COUNT(*) FROM faculty";
    $user += $conn->query($query)->fetch_row()[0];
    $query = "SELECT COUNT(*) FROM admin";
    $user += $conn->query($query)->fetch_row()[0];

    $query = "SELECT COUNT(*) FROM school";
    $school = $conn->query($query)->fetch_row()[0];

    $query = "SELECT COUNT(*) FROM program";
    $program = $conn->query($query)->fetch_row()[0];

    $query = "SELECT COUNT(*) FROM course";
    $course = $conn->query($query)->fetch_row()[0];
    
?>