<?php
    include 'mysql.php';
    
    ## table - university
    $query = "CREATE TABLE University ( 
        id VARCHAR(10) NOT NULL PRIMARY KEY , 
        name VARCHAR(255) NOT NULL , 
        address TEXT NOT NULL , 
        city VARCHAR(255) NOT NULL , 
        country VARCHAR(255) NOT NULL ,
        vc VARCHAR(255) NULL, 
        email VARCHAR(255) NOT NULL , 
        phone VARCHAR(20) NOT NULL
    )";
    
    if($conn->query($query)){
        echo'University table created successfully <br/>';
    }else{
        echo'Error creating table University: '. $conn->error . '<br/>';
    }

    ## table - admin
    $query = "CREATE TABLE Admin ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        name VARCHAR(255) NOT NULL DEFAULT 'Mr. Admin', 
        email VARCHAR(255) NOT NULL UNIQUE, 
        password VARCHAR(255) NOT NULL , 
        university_id VARCHAR(10) NOT NULL,
        FOREIGN KEY(university_id) REFERENCES University(id)
    )";
    if($conn->query($query)){
        echo'Admin table created successfully <br/>';
    }else{
        echo'Error creating table Admin: '. $conn->error . '<br/>';
    }

    ## table - school
    $query = "CREATE TABLE School ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        name VARCHAR(255) NOT NULL , 
        dean VARCHAR(255) NULL ,
        dean_id INT NULL, 
        university_id VARCHAR(10) NOT NULL ,
        FOREIGN KEY(university_id) REFERENCES University(id)
    )";
    if($conn->query($query)){
        echo'School table created successfully <br/>';
    }else{
        echo'Error creating table School: '. $conn->error . '<br/>';
    }

    ## table - department
    $query = "CREATE TABLE Department ( 
        id VARCHAR(10) NOT NULL PRIMARY KEY, 
        name VARCHAR(255) NOT NULL , 
        head VARCHAR(255) NULL ,
        head_id INT NULL,
        school_id INT NOT NULL , 
        FOREIGN KEY (school_id) REFERENCES School(id)
    )";
    if($conn->query($query)){
        echo'Department table created successfully <br/>';
    }else{
        echo'Error creating table Department: '. $conn->error . '<br/>';
    }

    ## table - program
    $query = "CREATE TABLE Program ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        name VARCHAR(255) NOT NULL , 
        department_id VARCHAR(10) NOT NULL , 
        total_credits INT NULL , 
        FOREIGN KEY (department_id) REFERENCES Department(id)
    )";
    if($conn->query($query)){
        echo'Program table created successfully <br/>';
    }else{
        echo'Error creating table Program: '. $conn->error . '<br/>';
    }

    ## table - plo
    $query = "CREATE TABLE Plo ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        indx INT NOT NULL , 
        name VARCHAR(255) NOT NULL , 
        details TEXT NULL , 
        program_id INT NOT NULL,
        FOREIGN KEY (program_id) REFERENCES Program(id)
    )";
    if($conn->query($query)){
        echo'PLO table created successfully <br/>';
    }else{
        echo'Error creating table PLO: '. $conn->error . '<br/>';
    }

    ## table - course
    $query = "CREATE TABLE Course ( 
        id VARCHAR(10) NOT NULL PRIMARY KEY, 
        name VARCHAR(255) NOT NULL , 
        credits FLOAT NOT NULL , 
        level INT NOT NULL , 
        total_co INT NOT NULL , 
        program_id INT NOT NULL ,
        FOREIGN KEY (program_id) REFERENCES Program(id)    
    )";
    if($conn->query($query)){
        echo'Course table created successfully <br/>';
    }else{
        echo'Error creating table Course: '. $conn->error . '<br/>';
    }

    ## table - faculty
    $query = "CREATE TABLE Faculty ( 
        id INT NOT NULL PRIMARY KEY, 
        name VARCHAR(255) NOT NULL , 
        email VARCHAR(255) NOT NULL UNIQUE, 
        password VARCHAR(255) NOT NULL , 
        department_id VARCHAR(10) NOT NULL , 
        FOREIGN KEY (department_id) REFERENCES Department(id)
    )";
    if($conn->query($query)){
        echo'Faculty table created successfully <br/>';
    }else{
        echo'Error creating table Faculty: '. $conn->error . '<br/>';
    }

    ## table - section
    $query = "CREATE TABLE Section ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        num VARCHAR(10) NOT NULL , 
        semester VARCHAR(30) NOT NULL , 
        course_id VARCHAR(10) NOT NULL , 
        faculty_id INT NULL , 
        FOREIGN KEY (course_id) REFERENCES Course(id),
        FOREIGN KEY (faculty_id) REFERENCES Faculty(id)
    )";
    if($conn->query($query)){
        echo'Section table created successfully <br/>';
    }else{
        echo'Error creating table Section: '. $conn->error . '<br/>';
    }

    ## table - co
    $query = "CREATE TABLE Co ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        indx INT NOT NULL , 
        name VARCHAR(255) NULL , 
        detail TEXT NULL , 
        plo_id INT NOT NULL ,
        course_id VARCHAR(10) NOT NULL, 
        section_id INT NULL ,
        FOREIGN KEY (plo_id) REFERENCES Plo(id),
        FOREIGN KEY (course_id) REFERENCES Course(id),
        FOREIGN KEY (section_id) REFERENCES Section(id)
    )";
    if($conn->query($query)){
        echo'Co table created successfully <br/>';
    }else{
        echo'Error creating table Co: '. $conn->error . '<br/>';
    }

    ## table - student
    $query = "CREATE TABLE Student ( 
        id INT NOT NULL  PRIMARY KEY, 
        name VARCHAR(255) NOT NULL , 
        email VARCHAR(255) NOT NULL UNIQUE, 
        password VARCHAR(255) NOT NULL , 
        program_id INT NOT NULL,
        FOREIGN KEY (program_id) REFERENCES Program(id)
    )";
    if($conn->query($query)){
        echo'Student table created successfully <br/>';
    }else{
        echo'Error creating table Student: '. $conn->error . '<br/>';
    }

    ## table - enrollment
    $query = "CREATE TABLE Enrollment ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        student_id INT NOT NULL , 
        section_id INT NOT NULL , 
        FOREIGN KEY (student_id) REFERENCES Student(id),
        FOREIGN KEY (section_id) REFERENCES Section(id)
    )";
    if($conn->query($query)){
        echo'Enrollment table created successfully <br/>';
    }else{
        echo'Error creating table Enrollment: '. $conn->error . '<br/>';
    }

    ## table - assessment
    $query = "CREATE TABLE Assessment ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        question_number INT NOT NULL , 
        question_content VARCHAR(255) NULL , 
        type VARCHAR(20) NOT NULL ,
        mark INT NOT NULL , 
        attendence_number INT NULL , 
        co_number INT NOT NULL , 
        section_id INT NOT NULL,
        FOREIGN KEY (section_id) REFERENCES Section(id)
    )";
    if($conn->query($query)){
        echo'Assessment table created successfully <br/>';
    }else{
        echo'Error creating table Assessment: '. $conn->error . '<br/>';
    }

    ## table - evaluation
    $query = "CREATE TABLE Evaluation ( 
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        enrollment_id INT NOT NULL , 
        assessment_id INT NOT NULL ,
        obtained_mark INT NOT NULL , 
        attendence_percentage INT NULL,
        FOREIGN KEY(enrollment_id) REFERENCES Enrollment(id),
        FOREIGN KEY(assessment_id) REFERENCES Assessment(id)
    )";
    if($conn->query($query)){
        echo'Evaluation table created successfully <br/>';
    }else{
        echo'Error creating table Evaluation: '. $conn->error . '<br/>';
    }
?>