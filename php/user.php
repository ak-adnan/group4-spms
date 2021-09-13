<?php
   include 'mysql.php';
   // post

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['user']) {
        $user = $_POST['user'];
        $name = $_POST['f_name']." ".$_POST['l_name'];
        $email = $_POST['email'];

        $query = '';
        
        if($user == 'admin'){
            $uni = $_SESSION['uni'];
            $query = "INSERT INTO admin (name, email, password, university_id)
                     VALUES ('$name', '$email', '12345678', '$uni')";
        }else if($user == 'student'){
           $id = $_POST['id'];
           $program = $_POST['program'];
           $query = "INSERT INTO student (id, name, email, password, program_id)
                     VALUES ($id, '$name', '$email', '12345678', '$program')";
        }else{
            $id = $_POST['id'];
            $department = $_POST['department'];
            $query = "INSERT INTO faculty (id, name, email, password, department_id)
                     VALUES ($id, '$name', '$email', '12345678', '$department')";
        }

        $conn->query($query);

        header("Location: users-list.php");

   }else{
        $query = "SELECT student.id, student.name, student.email, program.name as 'program', UPPER(department.id) as 'department' 
        FROM student LEFT JOIN (program LEFT JOIN department ON program.department_id = department.id) 
        ON student.program_id = program.id";
        $students = $conn->query($query);

        $query = "SELECT faculty.id, faculty.name, faculty.email, UPPER(faculty.department_id) as 'department' FROM faculty";
        $faculties = $conn->query($query);

        $query = "SELECT admin.id, admin.name, admin.email from admin";
        $admins = $conn->query($query);

   }

   $query = "SELECT id, name FROM department";
   $departments = $conn->query($query);

   $query = "SELECT program.id, program.name, UPPER(program.department_id) as 'department' FROM program";
   $programs = $conn->query($query);
?>