<?php
    include 'mysql.php';

    $query = "SELECT name FROM school WHERE id = ".$_SESSION['school'];
    $school_name = $conn->query($query)->fetch_row()[0];

    $school_id = $_SESSION['school'];

    $query = "SELECT COUNT(DISTINCT(enrollment.student_id)) as 'total' FROM school LEFT JOIN department ON school.id = department.school_id LEFT JOIN program ON department.id = program.department_id LEFT JOIN course ON program.id = course.program_id LEFT JOIN section ON course.id = section.course_id LEFT JOIN enrollment ON section.id = enrollment.section_id WHERE school.id=$school_id";
    $enrolled = $conn->query($query)->fetch_row()[0];

    $query = "SELECT COUNT(program.id) as 'total' FROM school LEFT JOIN department ON school.id = department.school_id LEFT JOIN program ON department.id = program.department_id WHERE school.id = $school_id";
    $prog_count = $conn->query($query)->fetch_row()[0];

    $query = "SELECT COUNT(course.id) as 'total' FROM school LEFT JOIN department ON school.id = department.school_id LEFT JOIN program ON department.id = program.department_id LEFT JOIN course ON program.id = course.program_id WHERE school.id=$school_id";
    $crs_count = $conn->query($query)->fetch_row()[0];

    if(isset($_SESSION['department'])){
        $id = $_SESSION['department'];
        $query = "SELECT name FROM department WHERE id = '$id'";
        $school_name = $conn->query($query)->fetch_row()[0];
    }
?>