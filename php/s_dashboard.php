<?php
    include 'mysql.php';

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

    $query = "SELECT section.course_id, section.semester, assessment.co_number, IF(SUM(evaluation.obtained_mark)/SUM(assessment.mark)>=0.40, 1, 0) as 'status', plo.indx
    FROM section LEFT JOIN course ON section.course_id = course.id
    LEFT JOIN program ON course.program_id = program.id
    LEFT JOIN department ON program.department_id = department.id
    LEFT JOIN school ON department.school_id = school.id
    LEFT JOIN assessment on section.id = assessment.section_id
    LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
    LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
    LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
    LEFT JOIN plo ON co.plo_id = plo.id
    WHERE enrollment.student_id = $id
    GROUP BY enrollment.student_id, section.course_id, plo.indx
    ORDER BY status DESC";

    $program_id = $conn->query("SELECT program_id FROM student WHERE id = $id")->fetch_row()[0];
    $scrss = $conn->query("SELECT DISTINCT(section.course_id) as course FROM 
    enrollment LEFT JOIN section on enrollment.section_id = section.id
    WHERE enrollment.student_id = 1416455");

    
    $data= $conn->query($query);

    $crss = array();

    foreach($data as $d){
        $course = $d['course_id'];
        if(array_key_exists($course, $crss)==false){
            $crss[$course] = array();
            $crss[$course]['ach'] = 0;
            $crss[$course]['atm'] = 0;
            
            $crss[$course]['plo'] = array();
            $crss[$course]['plo']['ach'] = array();
            $crss[$course]['plo']['fld'] = array();
        }
        if($d['status']==1){
            $crss[$course]['ach']++;
            array_push($crss[$course]['plo']['ach'], $d['indx']);
        }else{
            $crss[$course]['atm']++;
            array_push($crss[$course]['plo']['fld'], $d['indx']);
        }
    }


    if(isset($_GET['crs'])){
        $gcrs = $_GET['crs'];

        $query = "SELECT section.course_id, section.semester, assessment.co_number, ROUND(SUM(evaluation.obtained_mark)/SUM(assessment.mark)*100, 2) as prcntg, plo.indx as plo
            FROM section LEFT JOIN course ON section.course_id = course.id
            LEFT JOIN program ON course.program_id = program.id
            LEFT JOIN department ON program.department_id = department.id
            LEFT JOIN school ON department.school_id = school.id
            LEFT JOIN assessment on section.id = assessment.section_id
            LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
            LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
            LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
            LEFT JOIN plo ON co.plo_id = plo.id
            WHERE enrollment.student_id = $id AND LOWER(course.id) = LOWER('$gcrs')
            GROUP BY enrollment.student_id, section.course_id, plo.indx
            ORDER BY plo ASC";
        $scd = $conn->query($query);

        $query = "SELECT sq.plo, ROUND(sum(sq.prcntg) / COUNT(sq.plo), 2) as avg, COUNT(sq.plo) FROM(
            SELECT section.course_id, section.semester, assessment.co_number, ROUND(SUM(evaluation.obtained_mark)/SUM(assessment.mark)*100, 2) as prcntg, plo.indx as plo
                FROM section LEFT JOIN course ON section.course_id = course.id
                LEFT JOIN program ON course.program_id = program.id
                LEFT JOIN department ON program.department_id = department.id
                LEFT JOIN school ON department.school_id = school.id
                LEFT JOIN assessment on section.id = assessment.section_id
                LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
                LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
                LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
                LEFT JOIN plo ON co.plo_id = plo.id
                WHERE LOWER(course.id) = LOWER('$gcrs') 
                GROUP BY enrollment.student_id, section.course_id, plo.indx
                ORDER BY plo ASC) as sq
                GROUP BY plo";
        $ocd = $conn->query($query);

    }


    $query = "SELECT sq.plo, ROUND(sum(sq.prcntg) / COUNT(sq.plo), 2) as avg, COUNT(sq.plo) FROM (
        SELECT enrollment.student_id, program.name, section.course_id, section.semester, assessment.co_number, ROUND(SUM(evaluation.obtained_mark)/SUM(assessment.mark)*100, 2) as prcntg, plo.indx as plo
            FROM section LEFT JOIN course ON section.course_id = course.id
            LEFT JOIN program ON course.program_id = program.id
            LEFT JOIN department ON program.department_id = department.id
            LEFT JOIN school ON department.school_id = school.id
            LEFT JOIN assessment on section.id = assessment.section_id
            LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
            LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
            LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
            LEFT JOIN plo ON co.plo_id = plo.id
            WHERE enrollment.student_id = $id AND program.id = $program_id 
            GROUP BY enrollment.student_id, section.course_id, plo.indx  
        ORDER BY `enrollment`.`student_id` ASC) as sq
        GROUP BY plo";    
    $spd =  $conn->query($query);

    $query = "SELECT sq.plo, ROUND(sum(sq.prcntg) / COUNT(sq.plo), 2) as avg, COUNT(sq.plo) FROM (
        SELECT enrollment.student_id, program.name, section.course_id, section.semester, assessment.co_number, ROUND(SUM(evaluation.obtained_mark)/SUM(assessment.mark)*100, 2) as prcntg, plo.indx as plo
            FROM section LEFT JOIN course ON section.course_id = course.id
            LEFT JOIN program ON course.program_id = program.id
            LEFT JOIN department ON program.department_id = department.id
            LEFT JOIN school ON department.school_id = school.id
            LEFT JOIN assessment on section.id = assessment.section_id
            LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
            LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
            LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
            LEFT JOIN plo ON co.plo_id = plo.id
            WHERE program.id = $program_id  
            GROUP BY enrollment.student_id, section.course_id, plo.indx  
        ORDER BY `enrollment`.`student_id` ASC) as sq
        GROUP BY plo";
    $opd =  $conn->query($query);

?>