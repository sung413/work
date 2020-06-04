<?php
    header('content-type: text/html; charset=utf-8'); 
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect = mysqli_connect("localhost", "root", "111111", "db");


    $class_number = $_GET['class_number'];
    $name = $_GET['name'];
    $phone = $_GET['phone'];
    $password = $_GET['password'];
   
    $query_insert = "INSERT INTO student (class_number, student_name, phone, password) 
    VALUES ($class_number, '$name', '$phone', '$password')";

    if($connect){
        if($connect->query($query_insert)){
            echo("<script>location.replace('student_login.php');</script>");
        }else{
            echo mysqli_error($connect);
        }
    }else{
        echo "ㄴ";
    }

?>

