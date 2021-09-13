<?php
    include 'mysql.php';

     if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['name']) {
        $name = $_POST['name'];
        $department = $_POST['department'];
        $total_credits = $_POST['total_credits'];
        $total_plo = $_POST['total_plo'];
        
        $query = "INSERT INTO program (name, department_id, total_credits)
                VALUES ('$name', '$department', '$total_credits')";

        $conn->query($query);
        $program_id = $conn->insert_id;

        for($i=1; $i<=$total_plo; $i++){
            $plo_name = $_POST['plo'.$i];
            $query = "INSERT INTO plo (indx, name, program_id)
                    VALUES($i, '$plo_name', $program_id)";
            $conn->query($query);
        }

        header("Location: programs-list.php");

     }else{

        $query = "SELECT program.id, program.name, department.id as 'department', COUNT(DISTINCT(plo.id)) as 'plo', COUNT(DISTINCT(course.id)) as course FROM program LEFT JOIN department ON program.department_id = department.id LEFT JOIN plo ON program.id = plo.program_id LEFT JOIN course on program.id = course.program_id GROUP BY program.id";

        $programs = $conn->query($query);
        
     }
     $query = "SELECT id, name FROM department";
     $departments = $conn->query($query);
?>