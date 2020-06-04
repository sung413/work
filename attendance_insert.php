<?php
    header('content-type: text/html; charset=utf-8'); 
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect = mysqli_connect("localhost", "root", "111111", "db");


    $class_pk = $_POST['class_pk'];
    $class_number = $_POST['class_number'];
    $class_title = $_POST['class_title'];
   
    $query_insert = "INSERT INTO attendance (class_pk, class_title, class_number) 
    VALUES ($class_pk, '$class_title', $class_number)";

    if($connect){
        if($connect->query($query_insert)){
            $result = array(check => "success");
        }else{
            $result = array(check => "fail");
        }
    }else{
        $result = array(check => "fail");
    }

    echo json_encode($result);

?>

