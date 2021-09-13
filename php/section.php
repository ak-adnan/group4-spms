<?php
    include 'mysql.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['num'])) {
        $num = $_POST['num'];
        $semester = $_POST['semester'] ;
        $course = $_POST['course'];
        $faculty = $_POST['faculty'];
        
        $query = "INSERT INTO section (num, semester, course_id, faculty_id)
                    VALUES ('$num', '$semester', '$course', $faculty)";
        
        $conn->query($query);

        $section_id = $conn->insert_id;

        $file = fopen($_FILES['enrollment']['tmp_name'], "r");   

        fgetcsv($file);   
        
        while($id = fgetcsv($file)){
            $student = $id[0];
            $query = "INSERT INTO enrollment (student_id, section_id) VALUES ($student, $section_id)";
            $conn->query($query);
        }
        
        header("Location: sections-list.php");
        
   }else{

    $query = "SELECT section.id, section.num, section.semester, section.course_id, faculty.name, COUNT(enrollment.student_id) as 'total_student' FROM section LEFT JOIN enrollment ON section.id = enrollment.section_id LEFT JOIN faculty ON section.faculty_id = faculty.id GROUP BY section_id";
    $sections = $conn->query($query);

    $query = "SELECT id, name FROM course";
    $courses = $conn->query($query);

    $query = "SELECT id, name FROM faculty";
    $faculties = $conn->query($query);
   }
?>