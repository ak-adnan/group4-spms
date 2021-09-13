<?php
    include 'mysql.php';
    include 'middleware.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['email']) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $flag = 0;

        if($flag==0){
            $query = "SELECT * FROM student WHERE email = '$email' AND password = '$password'";
            if($user = $conn->query($query)->fetch_assoc()){
                $flag = 1;
                $id = $user['id'];
                $query = "SELECT university_id FROM school 
                    WHERE id = ANY(SELECT school_id FROM department 
                    WHERE id = ANY( SELECT department_id from program 
                    WHERE id = ANY(SELECT program_id FROM student WHERE id = $id)))"; 
                $_SESSION['id'] = $id;
                $_SESSION['uni'] = $conn->query($query)->fetch_row()[0];
                $_SESSION['role'] = 1;
                $_SESSION['user'] = $id;
                $_SESSION['name'] = $user['name'];


                $query = "SELECT id FROM department 
                WHERE id = ANY( SELECT department_id from program 
                WHERE id = ANY(SELECT program_id FROM student WHERE id = $id))";

                $_SESSION['dep'] = $conn->query($query)->fetch_row()[0];
            }
        }
        
        if($flag==0){
            $query = "SELECT * FROM faculty WHERE email = '$email' AND password = '$password'";
            if($user = $conn->query($query)->fetch_assoc()){
                $flag = 2;
                $id = $user['id'];

                $query = "SELECT university_id FROM school 
                WHERE id = ANY(SELECT school_id FROM department 
                WHERE id = ANY( SELECT department_id from faculty WHERE id = $id))"; 

                $_SESSION['id'] = $id;
                $_SESSION['uni'] = $conn->query($query)->fetch_row()[0];
                $_SESSION['user'] = $id;
                $_SESSION['role'] = 2;
                $_SESSION['name'] = $user['name'];

                $query = "SELECT department_id FROM faculty WHERE id = $id";
                $_SESSION['dep'] = $conn->query($query)->fetch_row()[0];

                $name = $user['name'];

                $query = "SELECT * FROM school WHERE LOWER(dean) = LOWER('$name')";
                if($flag == 2 && $school = $conn->query($query)->fetch_assoc()){
                    $_SESSION['role'] = 6;
                    $flag = 6;
                    $_SESSION['school'] = $school['id'];
                }

                $query = "SELECT * FROM department WHERE LOWER(head) = LOWER('$name')";
                if($flag == 2 && $department = $conn->query($query)->fetch_assoc()){
                    $_SESSION['role'] = 4;
                    $flag = 4;
                    $_SESSION['department'] = $department['id'];
                    $_SESSION['school'] = $department['school_id'];
                }
                
            }
        }

        if($flag==0){
            $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
            if($user = $conn->query($query)->fetch_assoc()){
                $flag = 3;
                $id = $user['id'];
                $query = "SELECT university_id FROM admin WHERE id = $id"; 
                $_SESSION['id'] = $id;
                $_SESSION['uni'] = $conn->query($query)->fetch_row()[0];
                $_SESSION['role'] = 3;
                $_SESSION['user'] = $id;
                $_SESSION['name'] = $user['name'];
            }
        }

        if($flag==0){
            session_unset();
            header("Location: ../login.php");
        }


    }else{
        if(isset($_GET['logout'])){
            session_unset();
        }
    }
    middlewareCheck();
?>