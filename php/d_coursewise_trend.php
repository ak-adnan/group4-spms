<?php
    include 'mysql.php';

    if(isset($_GET['semester'])){
        $course = $_GET['course'];
        $semester = $_GET['semester'];
        $plo = $_GET['plo'];

        $query = "SELECT sq.faculty, sq.course_id, sq.semester, ROUND(SUM(sq.prcntg)/COUNT(sq.plo), 2) as avg, sq.plo
        FROM(SELECT section.course_id, section.semester, faculty.name as faculty, ROUND(SUM(evaluation.obtained_mark)/SUM(assessment.mark)*100, 2) as prcntg, plo.indx as plo
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
                    WHERE LOWER(course.id) = LOWER('$course') AND LOWER(section.semester) = LOWER('$semester')
                    GROUP BY enrollment.student_id, section.course_id, plo.indx
                    ORDER BY plo ASC) as sq
                    GROUP BY faculty, plo
                    ORDER BY faculty, plo ASC";  
        $insd = $conn->query($query);

        $query = "SELECT sq.plo, sq.course_id as course, sq.semester, SUM(sq.prcntg)/COUNT(sq.course_id) as avg FROM
        (SELECT plo.indx as plo, section.course_id, section.semester, ROUND(SUM(evaluation.obtained_mark)/SUM(assessment.mark)*100, 2) as prcntg
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
            WHERE LOWER(course.id) = LOWER('$course') AND plo.indx = $plo AND LOWER(section.semester) = LOWER('$semester')
            GROUP BY enrollment.student_id, section.course_id, plo.indx
            ORDER BY plo ASC) as sq
            GROUP BY sq.plo, sq.course_id
            ORDER BY plo, course";
        $crsd = $conn->query($query); 

        $query = "SELECT sq.plo, SUM(sq.status) as ach, COUNT(sq.status) as total
        FROM (
        SELECT plo.indx as plo, IF(SUM(evaluation.obtained_mark)/SUM(assessment.mark)>=0.40, 1, 0) as 'status'
                        FROM section LEFT JOIN assessment on section.id = assessment.section_id
                        LEFT JOIN evaluation ON assessment.id = evaluation.assessment_id
                        LEFT JOIN enrollment ON evaluation.enrollment_id = enrollment.id
                        LEFT JOIN co ON assessment.co_number = co.indx AND section.id = co.section_id
                        LEFT JOIN plo ON co.plo_id = plo.id
                        WHERE LOWER(section.semester) = LOWER('$semester') AND LOWER(section.course_id) = LOWER('$course')  
                        GROUP BY enrollment.student_id, section.course_id, plo.indx
                        ORDER BY status DESC) as sq
                        GROUP BY sq.plo";
        $afpd = $conn->query($query);
    }
    

?>