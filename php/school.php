<?php
    include 'mysql.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
        $name = $_POST['name'];
        $dean = $_POST['dean'];
        $uni = $_SESSION['uni'];

        $query = "INSERT INTO school (name, university_id, dean) VALUES ('$name', '$uni', '$dean')";
        $conn->query($query);

        header("Location: schools-list.php");
        
   }else{
        $query = "SELECT school.id, school.name, school.dean, COUNT(DISTINCT(department.id)) as department, COUNT(DISTINCT(program.id)) as program FROM school LEFT JOIN (department LEFT JOIN program ON department.id = program.department_id) ON school.id = school_id GROUP BY school.id";
        $schools = $conn->query($query);
   }
?>