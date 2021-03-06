<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
    </head>

    <?php
        $class_title = $_GET['class_title'];
        $class_time = $_GET['class_time'];

    ?>
    
    <body>
        <header id="header" style="width:100%; height:50px; background:#dddddd">       
        </header>
        <div>
            <label>학번</label><p>
            <input id ="class_number"></input><p>
            <label>이름</label><p>
            <input id ="name"></input><p>
            <label>핸드폰번호</label><p>
            <input id ="phone"></input><p>
            <label>비밀번호</label><p>
            <input id ="password"></input><p>
        </div>
        <div><button id="createBtn">학생등록</button></div>
        <div>
            <img id="qrcode" src='' />
        </div>
        <script type="text/javascript">

            $(document).ready(function(){

                $("#header").load("header.html");

                $('#createBtn').click(function(){

                    var class_number = $('#class_number').val();
                    var name =  $('#name').val();
                    var phone = $('#phone').val();
                    var password =  $('#password').val();
                    

                    if(isEmpty(class_number) || isEmpty(name) || isEmpty(phone) || isEmpty(password)){
                        alert("모든 정보를 기입해 주세요");
                    }else{
                        location.href = "student_info_insert.php?class_number="+class_number+"&name="+name+"&phone="+phone+"&password="+password;
                    }

                });

                function isEmpty(str){
                    if(typeof str == "undefined" || str == null || str == "")
                        return true;
                    else
                        return false ;
                }
            });
        </script>
   </body>
</html>
