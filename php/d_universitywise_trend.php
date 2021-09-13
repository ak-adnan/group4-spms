<?php
    include 'mysql.php';

    if(isset($_GET['semester'])){
        
        $uni = $_GET['uni'];
        $prog = $_GET['prog'];
        $program = explode(',', $prog);
        $semester = $_GET['semester'];
        $plo = $_GET['plo'];
        $plos = explode(',', $plo);

        $query = "SELECT sq.plo, SUM(sq.status) as ach, COUNT(sq.plo) as atm FROM
        (SELECT program.name as program, plo.indx as plo, IF(SUM(evaluation.obtained_mark)/SUM(assessment.mark) >=.40, 1, 0) as status
                                    FROM section LEFT JOIN course ON section.course_id = course.id
                                    LEFT JOIN faculty on section.faculty_id = faculty.id
                                    LEFT JOIN program ON course.program_id = program.id
                                    LEFT JOIN department ON program.department_id = department.id
                                    LEFT JOIN school ON department.school_id = school.id
                                    LEFT JOIN university ON school.university_id = university.id
                                    LEFT JOIN assessment on section.id = assessment.section_id
                                    LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
                                    LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
                                    LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
                                    LEFT JOIN plo ON co.plo_id = plo.id
                                    WHERE LOWER(university.id) = LOWER('$uni') AND LOWER(section.semester) = LOWER('$semester') AND LOWER(program.name) = LOWER('$program[0]') 
                                    GROUP BY enrollment.student_id, section.course_id, plo.indx) as sq
                                    GROUP BY plo
                                    ORDER BY plo ASC";
        $accd = $conn->query($query);

        $query = "SELECT sq3.progid, sq3.program, ROUND((SUM(IF(sq3.status=13, 1, 0)) / COUNT(sq3.student)) * 100, 2) as prcntg FROM
        (SELECT sq2.progid, sq2.program, sq2.student, SUM(sq2.status) as status FROM
        (SELECT sq.progid, sq.program, sq.student, sq.plo, max(sq.status) as status FROM
        (SELECT program.id as progid, CONCAT(program.name, ' in ', department.id) as program, enrollment.student_id as student, plo.indx as plo, IF(SUM(evaluation.obtained_mark)/SUM(assessment.mark) >=.40, 1, 0) as status
                                    FROM section LEFT JOIN course ON section.course_id = course.id
                                    LEFT JOIN faculty on section.faculty_id = faculty.id
                                    LEFT JOIN program ON course.program_id = program.id
                                    LEFT JOIN department ON program.department_id = department.id
                                    LEFT JOIN school ON department.school_id = school.id
                                    LEFT JOIN university ON school.university_id = university.id
                                    LEFT JOIN assessment on section.id = assessment.section_id
                                    LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
                                    LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
                                    LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
                                    LEFT JOIN plo ON co.plo_id = plo.id
                                    WHERE LOWER(university.id) = LOWER('$uni') AND LOWER(section.semester) = LOWER('$semester') AND LOWER(program.name) = LOWER('$program[0]')";
        
        if(sizeof($program)>1){
            for($i=1; $i<sizeof($program); $i++){
                $query.= " OR LOWER(program.name) = LOWER('$program[$i]')";
            }
        }
        
                                    $query.= " GROUP BY program.id, enrollment.student_id, section.course_id, plo.indx) as sq
                                    GROUP BY progid, student, plo) as sq2
                                    GROUP BY progid, student) sq3
                                    GROUP BY progid";  
        $grdd = $conn->query($query);    
        
        $query = "SELECT sq.plo, ROUND(SUM(sq.status)/COUNT(sq.plo) * 100, 2) as prcntg FROM
        (SELECT enrollment.student_id as student, plo.indx as plo, IF(SUM(evaluation.obtained_mark)/SUM(assessment.mark) >=.40, 1, 0) as status
                                    FROM section LEFT JOIN course ON section.course_id = course.id
                                    LEFT JOIN faculty on section.faculty_id = faculty.id
                                    LEFT JOIN program ON course.program_id = program.id
                                    LEFT JOIN department ON program.department_id = department.id
                                    LEFT JOIN school ON department.school_id = school.id
                                    LEFT JOIN university ON school.university_id = university.id
                                    LEFT JOIN assessment on section.id = assessment.section_id
                                    LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
                                    LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
                                    LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
                                    LEFT JOIN plo ON co.plo_id = plo.id
                                   WHERE LOWER(university.id) = LOWER('$uni') AND LOWER(program.name) = LOWER('$program[0]') AND plo.indx = $plos[0]";
        
        if(sizeof($plos)>1){
            for($i=1; $i<sizeof($plos); $i++){
                $query.= " OR plo.indx = $plos[$i]";
            }
        }
        
        $query .= " GROUP BY  enrollment.student_id, section.course_id, plo.indx) as sq
                                    GROUP BY plo";

        $plod = $conn->query($query);
    }
?>