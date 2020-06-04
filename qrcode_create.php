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
        date_default_timezone_set('Asia/Seoul');
        $class_title = $_GET['class_title'];
        $class_date = $_GET['class_date'];
        $class_time = $_GET['class_time'];
        $date = date("Ymd");
    ?>
    
    <body>
        <header id="header" style="width:100%; height:50px; background:#dddddd">       
        </header>
        <div>
            <label>강의명</label><p>
            <input id ="class_title" placeholder="강의명을 입력하세요"></input><p>
            <label>날짜</label><p>
            <input id ="class_date" value="<?php echo $date ?>"></input><p><p>
            <label>시간</label><p>
            <input id ="class_time" placeholder="강의시간을 입력하세요"></input><p>
        </div>
        <div><button id="createBtn">QR코드 생성</button></div>
        <div>
            <img id="qrcode" src='' />
        </div>
        <script type="text/javascript">

            $(document).ready(function(){

                $("#header").load("header.html");

                $('#createBtn').click(function(){
                    // input에 입력하는 값들을 뽑아서 변수에 저장
                    var class_title = $('#class_title').val();
                    var class_date =  $('#class_date').val();
                    var class_time =  $('#class_time').val();

                    console.log("class_title : "+class_title);
                    console.log("class_date : "+class_date);
                    console.log("class_time : "+class_time);

                    $.ajax({
                        type:"post",
                        url:"class_info_insert.php",
                        data:{'class_title':class_title, 'class_date':class_date, 'class_time':class_time},
                        async:false,
                        dataType:"html",
                        success:function(data){
                            console.log(data);

                            var obj = JSON.parse(data);
                            var check = obj.check;
                            if(check == "success"){
                                var class_pk = obj.class_pk;
                                var default_url = "http://13.209.15.46/qrcode_class.php?";
                                var create_qr_url = default_url+"class_pk="+class_pk;
                                var userurl = encodeURIComponent(create_qr_url);
                                // 뒤에 코드가 길어지니까 그냥 한번 변수에 주소를 저장
                                googleQRUrl = "https://chart.googleapis.com/chart?chs=177x177&cht=qr&choe=UTF-8&chl=";
                                $('#qrcode').attr('src', googleQRUrl + userurl);
                                alert("QR코드가 생성되었습니다");
                            }
                        }
                        , error:function(request,status,error){
                            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                    });
                });

                
            });
        </script>
   </body>
</html>
