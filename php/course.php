<?php
    include 'mysql.php';

     if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['id']) {
        
        $program = $_POST['program'];
        $id = strtolower($_POST['id']);
        $name = $_POST['name'];
        $level = $_POST['level'];
        $credits = $_POST['credits'];
        $total_co = $_POST['total_co'];

        $query = "INSERT INTO course (id, name, credits, level, total_co, program_id)
                VALUES('$id', '$name', '$credits', '$level', '$total_co', '$program')";
        
        $conn->query($query);
        
        $query = "SELECT COUNT(DISTINCT(plo.id)) as total_co FROM plo WHERE program_id = 1";
        $total_plo = $conn->query($query)->fetch_row()[0];

        for($i=1; $i<=$total_plo; $i++){
            if(isset($_POST['plo-'.$i])){
                $query = "SELECT id from plo WHERE indx = $i AND program_id = $program";
                $plo = $conn->query($query)->fetch_row()[0];
                for($j=0; $j<sizeof($_POST['plo-'.$i]); $j++){
                    $co = $_POST['plo-'.$i][$j];
                    $query = "INSERT INTO co (indx, plo_id, course_id) VALUES($co, $plo, '$id')";
                    $conn->query($query);
                    echo $conn->error . '<br/>';
                }
                
            }
        }

        header("Location: courses-list.php");

     }else{

        $query = "SELECT course.id, course.name, program.name as 'program', UPPER(department.id) as 'department', course.level, course.credits, COUNT(DISTINCT(co.indx)) as total_co 
        FROM course LEFT JOIN (program LEFT JOIN department on program.department_id = department.id) on course.program_id = program.id 
        LEFT JOIN co ON course.id = co.course_id 
        GROUP BY course.id";

        $courses = $conn->query($query);
        
     }
     $query = "SELECT program.id, program.name, UPPER(department.id) as 'department' FROM program LEFT JOIN department ON program.department_id = department.id";
     $programs = $conn->query($query);
?>