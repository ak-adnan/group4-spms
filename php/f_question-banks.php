<?php
    include 'mysql.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
   }else{
        $query = "SELECT * FROM assessment LEFT JOIN section ON assessment.section_id = section.id WHERE question_content IS NOT NULL";
        $qstns = $conn->query($query);
   }   

?>