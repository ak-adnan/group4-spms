<?php
    include 'mysql.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['num'])) {
        
        
   }else{
        $faculty_id = $_SESSION['user'];
        $query = "SELECT section.id, section.num, section.semester, section.course_id, COUNT(co.id) as 'co_status' FROM section LEFT JOIN co ON section.id = co.section_id WHERE section.faculty_id = $faculty_id GROUP BY section.id";
        $sections = $conn->query($query);
        
   }
?>