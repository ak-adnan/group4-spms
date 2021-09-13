<?php
    include 'mysql.php';

    if(isset($_GET['semester'])){
        $prog = $_GET['program'];
        $semester = $_GET['semester'];

        $query = "SELECT sq.program, sq.plo, SUM(sq.status) as ach, COUNT(sq.plo) as total FROM
        (SELECT program.name as program, plo.indx as plo, IF(SUM(evaluation.obtained_mark)/SUM(assessment.mark) >=.40, 1, 0) as status
                            FROM section LEFT JOIN course ON section.course_id = course.id
                            LEFT JOIN faculty on section.faculty_id = faculty.id
                            LEFT JOIN program ON course.program_id = program.id
                            LEFT JOIN department ON program.department_id = department.id
                            LEFT JOIN school ON department.school_id = school.id
                            LEFT JOIN assessment on section.id = assessment.section_id
                            LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
                            LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
                            LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
                            LEFT JOIN plo ON co.plo_id = plo.id
                            WHERE LOWER(section.semester) = LOWER('$semester') AND LOWER(program.name) = LOWER('$prog') 
                            GROUP BY enrollment.student_id, section.course_id, plo.indx) as sq
                            GROUP BY plo
                            ORDER BY plo ASC";
        $catd = $conn -> query($query);

        $query = "SELECT sq.plo, sq.co, ROUND(SUM(sq.prcntg)/COUNT(sq.co), 2) as prcntg, COUNT(sq.co) as total FROM
        (SELECT program.name as program, plo.indx as plo, co.indx as co, ROUND(SUM(evaluation.obtained_mark)/SUM(assessment.mark)*100, 2) as prcntg
        FROM section LEFT JOIN course ON section.course_id = course.id
        LEFT JOIN faculty on section.faculty_id = faculty.id
        LEFT JOIN program ON course.program_id = program.id
        LEFT JOIN department ON program.department_id = department.id
        LEFT JOIN school ON department.school_id = school.id
        LEFT JOIN assessment on section.id = assessment.section_id
        LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
        LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
        LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
        LEFT JOIN plo ON co.plo_id = plo.id
        WHERE LOWER(section.semester) = LOWER('$semester') AND LOWER(program.name) = LOWER('$prog') 
        GROUP BY enrollment.student_id, section.course_id, plo.indx, co.indx) as sq
        WHERE sq.prcntg >= 40
        GROUP BY plo, co
        ORDER BY co, plo ASC";

        $cosd = $conn->query($query);

        
    }
    

?>