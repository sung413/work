<?php
    header('content-type: text/html; charset=utf-8'); 
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect = mysqli_connect("localhost", "root", "111111", "db");


    $class_title = $_POST['class_title'];
    $class_date = $_POST['class_date'];
    $class_time = $_POST['class_time'];
   
    $query_insert = "INSERT INTO class (class_title, class_date, class_time) 
    VALUES ('$class_title', '$class_date', '$class_time')";

    if($connect){
        if($connect->query($query_insert)){
            $class_pk = mysqli_insert_id($connect);
            $result = array(check => "success", class_pk => $class_pk);
        }else{
            $result = array(check => "fail");
        }
    }else{
        $result = array(check => "fail");
    }

    echo json_encode($result);

?>

