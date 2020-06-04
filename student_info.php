<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <style>
            th {
                padding: 10px;
            }
            td{
                padding: 10px;
            }
        </style>
  
    </head>

    <?php
        $connect = mysqli_connect("localhost", "root", "111111", "db");
        $class_number = $_GET['class_number'];
        $name = $_GET['name'];
        $phone = $_GET['phone'];

        if(empty($class_number)){
            $class_number = "등록된 학생정보 없음";
        }else{
            setcookie('class_number', $class_number, time() + 3600 * 24 * 30);
            setcookie('student_name', urlencode($name), time() + 3600 * 24 * 30);
        }

        $query_attendance = "SELECT DISTINCT class_title FROM attendance WHERE class_number = $class_number";
        $result_attendance = mysqli_query($connect, $query_attendance);
        
    ?>
    
    <body>
        <header id="header" style="width:100%; height:50px; background:#dddddd">       
        </header>
        <div>
            <div>학번 : <?php echo $class_number; ?></div>
            <div>이름 : <?php echo $name; ?></div>
            <div>핸드폰번호 : <?php echo $phone; ?></div>
        </div>
        <br>
        <div>
            <div>출결현황</div>
                <br>
                <table class="favor_table table_standard_set">
                    <thead>
                        <tr style="background:#999999">
                            <th scope="cols">강의명</th>
                            <th scope="cols">출결현황</th>
                            <th scope="cols">출석률</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row_attendance = mysqli_fetch_array($result_attendance)){
                                $class_pk = $row_attendance['class_pk'];
                                $class_title = $row_attendance['class_title'];
                    
                                $query_class = "SELECT * FROM class WHERE class_title = '$class_title'";
                                $result_class = mysqli_query($connect, $query_class);
                                $class_total_cnt = mysqli_num_rows($result_class);
            
                                $query_attendance_done = "SELECT * FROM attendance WHERE class_title = '$class_title' AND class_number = $class_number";
                                $result_attendance_done = mysqli_query($connect, $query_attendance_done);
                                $attendance_total_cnt = mysqli_num_rows($result_attendance_done);
            
                                $attendance_state = $attendance_total_cnt."/".$class_total_cnt;
                                $attendance_percent = $attendance_total_cnt/$class_total_cnt*100;
                        ?>
                            <tr style="background:#eeeeee">
                                <td scope="cols"><?php echo $class_title; ?></td>
                                <td scope="cols"><?php echo $attendance_state; ?></td>
                                <td scope="cols"><?php echo ceil($attendance_percent); ?>%</td>
                            </tr>
                            
                        <?php } ?>
                    </tbody>
                </table>
        </div>

        <div>
            <img id="qrcode" src='' />
        </div>
        <script type="text/javascript">

            $(document).ready(function(){
                $("#header").load("header.html");
            });
        </script>
   </body>
</html>
