<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  
    </head>

    <?php
        $class_pk = $_GET['class_pk'];
        $connect = mysqli_connect("localhost", "root", "111111", "db");
        $query = "SELECT * FROM class WHERE id = $class_pk";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($result);
        $class_title = $row['class_title'];
        $class_date = $row['class_date'];
        $class_time = $row['class_time'];

        $class_number = $_COOKIE['class_number'];
    ?>
    
    <body>
        <header id="header" style="width:100%; height:50px; background:#dddddd">       
        </header>
        <div>강의명 : <?php echo $class_title; ?></div>
        <div>날짜 : <?php echo $class_date; ?></div>
        <div>시간 : <?php echo $class_time; ?></div>
        <div>학번 : <?php echo $class_number; ?></div>

        <button id="chat_button">해당 강의 채팅방으로 가기</button>
   </body>

   <script type="text/javascript">

        $(document).ready(function(){
            $("#header").load("header.html");

            var class_pk = "<?php echo $class_pk ?>";
            var class_number = "<?php echo $class_number ?>";
            var class_title = "<?php echo $class_title ?>";
            var class_date = "<?php echo $class_date ?>";
            var class_time = "<?php echo $class_time ?>";

            $.ajax({
                    type:"post",
                    url:"attendance_insert.php",
                    data:{'class_pk':class_pk, 'class_number':class_number, 'class_title':class_title},
                    async:false,
                    dataType:"html",
                    success:function(data){
                        console.log(data);

                        var obj = JSON.parse(data);
                        var check = obj.check;
                        if(check == "success"){
                            alert("출석체크 완료~");
                        }else{
                            alert("다시 로그인해주세요.");
                        }
                    }
                    , error:function(request,status,error){
                        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                    }
                });
            
            $("#chat_button").click(function(){
                setCookie('class_title', class_title, 30);
                setCookie('class_date', class_date, 30);
                setCookie('class_time', class_time, 30);
                location.href = "http://13.209.15.46:8000";
            });

            var setCookie = function(name, value, exp) {
                var date = new Date();
                date.setTime(date.getTime() + exp*24*60*60*1000);
                document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
            };
        });
        
    </script>
</html>
