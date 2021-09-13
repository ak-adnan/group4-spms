<?php
    include 'mysql.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $section_id = $_POST['section_id'];
        $query = "SELECT course_id FROM section WHERE id = $section_id";
        $course_id = $conn->query($query)->fetch_row()[0];
        $plo_list = $_POST['plo_list'];
        foreach($plo_list as $plo_id){
            $co = $_POST["plo".$plo_id];
            if($co ==0){
                continue;
            }
            $query = "INSERT INTO co (indx, plo_id, course_id, section_id)
                        VALUES($co, $plo_id, '$course_id', $section_id)";
            $conn->query($query);
        }
        header("Locaton: ../sections-list.php");
        
   }else{
        
   }    
   
   if(isset($_GET['section_id'])){
    $section_id = $_GET['section_id'];
    $query = "SELECT co.plo_id as 'plo_id', plo.indx as 'plo_indx', co.id as 'co_id', co.indx as 'co_indx'  FROM
    co LEFT JOIN plo ON co.plo_id = plo.id
    WHERE co.course_id = ANY (SELECT course_id from section WHERE id = $section_id) AND section_id IS NULL
    ORDER BY plo.indx";
    $plos = $conn->query($query);
}

   

?>