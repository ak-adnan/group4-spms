<?php
    include 'mysql.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $id = strtolower($_POST['id']);
        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $vc = $_POST['vc'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $query = "INSERT INTO university (id, name, address, city, country, vc, email, phone) 
            VALUES ('$id', '$name', '$address', '$city', '$country', '$vc', '$email', '$phone')";


        $admin_email = $_POST['admin-email'];
        $admin_password = $_POST['admin-password'];
        
        $query2 = "INSERT INTO admin (email, password, university_id)
                    VALUES ('$admin_email', '$admin_password', '$id')";

        $conn->query($query);
        $conn->query($query2);

        header("Location: universities-list.php");
   }else{
        $query = "SELECT university.id, university.name, university.vc, university.email, COUNT(DISTINCT(school.id)) as school, COUNT(DISTINCT(department.id)) as department FROM university LEFT JOIN (school LEFT JOIN department ON school.id = department.school_id) ON university.id = university_id GROUP BY university.id";
        $datas = $conn->query($query);
   }

?>