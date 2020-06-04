<?php
    header('content-type: text/html; charset=utf-8'); 
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect = mysqli_connect("localhost", "root", "111111", "db");


    $class_number = $_GET['class_number'];
    $password = $_GET['password'];
   
    $query_select = "SELECT * FROM student WHERE class_number = $class_number AND password = '$password'";

    if($connect){
            $result_select = mysqli_query($connect, $query_select);
            $row_select = mysqli_fetch_array($result_select);

            $class_number = $row_select['class_number'];
            $name = $row_select['student_name'];
            $phone = $row_select['phone'];

            echo("<script>location.replace('student_info.php?class_number=$class_number&name=$name&phone=$phone');</script>");

    }else{
        echo "ㄴ";
    }

?>

