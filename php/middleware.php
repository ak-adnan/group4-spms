<?php
    session_start();

    middlewareCheck();

    function middlewareCheck(){
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                    "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

        if(!isset($_SESSION['role'])){
            if(preg_match("/login.php/i", $_SERVER['REQUEST_URI'])!=1){
                header("Location: $link/login.php");
            }
        }else if(isset($_SESSION['role'])){

            if(($_SESSION['role'])==3 && preg_match("/admin/i", $_SERVER['REQUEST_URI'])!=1){

                header("Location: $link/admin/");

            }else if(($_SESSION['role'])==6){
                if(preg_match("/dean/i", $_SERVER['REQUEST_URI']) || preg_match("/faculty/i", $_SERVER['REQUEST_URI'])){
                }else{
                    header("Location: $link/faculty/");
                }
            }else if(($_SESSION['role'])==4){
                if(preg_match("/head/i", $_SERVER['REQUEST_URI']) || preg_match("/faculty/i", $_SERVER['REQUEST_URI'])){
                }else{
                    header("Location: $link/faculty/");
                }
            }else if(($_SESSION['role'])==2){
                if(preg_match("/faculty/i", $_SERVER['REQUEST_URI'])){
                }else{
                    header("Location: $link/faculty/");
                }
            }else if(($_SESSION['role'])==1){
                if(preg_match("/student/i", $_SERVER['REQUEST_URI'])){
                }else{
                    header("Location: $link/student/");
                }
            }
        }
    }
    
?>