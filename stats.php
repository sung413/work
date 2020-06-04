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
        $query = $_GET['query'];
        $text = $_GET['text'];

        $connect = mysqli_connect("localhost", "root", "111111", "db");
    ?>
    
    <body>
        <header id="header" style="width:100%; height:50px; background:#dddddd">       
        </header>
        <div>
            검색조건
            <select id="query" name="query">
                <option value="">검색항목</option>
                <option value="class">강의</option>
                <option value="student">학생</option>
            </select>
            <input id="text" type="text" placeholder="강의명 or 학번">
            <button id="button">검색</button>
        </div>
        
        <br>
        <?php 
            if($query == "student"){ 
            $query_attendance = "SELECT DISTINCT class_title FROM attendance WHERE class_number = $text";
            $result_attendance = mysqli_query($connect, $query_attendance);
        ?>
        <!-- 학생정보 -->
        <div>
            <div>출결현황</div>
            <div>학번 : <?php echo $text ?></div>
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
            
                                $query_attendance_done = "SELECT * FROM attendance WHERE class_title = '$class_title' AND class_number = $text";
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
        <?php 
            }else if($query == "class"){
                $query_class = "SELECT * FROM class WHERE class_title = '$text'";
                $result_class = mysqli_query($connect, $query_class);
        ?>  
            <!-- 강의정보 -->
            <div>
                <div>강의통계</div>
                <div>강의명 : <?php echo $text ?></div>
                    <br>
                    <table class="favor_table table_standard_set">
                        <thead>
                            <tr style="background:#999999">
                                <th scope="cols">날짜</th>
                                <th scope="cols">시간</th>
                                <th scope="cols">청강수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row_class = mysqli_fetch_array($result_class)){
                                    $class_pk = $row_class['id'];
                                    $class_date = $row_class['class_date'];
                                    $class_time = $row_class['class_time'];
                        
                                    $query_attendance = "SELECT 0 FROM attendance WHERE class_pk = '$class_pk'";
                                    $result_attendance = mysqli_query($connect, $query_attendance);
                                    $attendance_total_cnt = mysqli_num_rows($result_attendance);
                            ?>
                                <tr style="background:#eeeeee">
                                    <td scope="cols"><?php echo $class_date; ?></td>
                                    <td scope="cols"><?php echo $class_time; ?></td>
                                    <td scope="cols"><?php echo $attendance_total_cnt; ?>명</td>
                                </tr>
                                
                            <?php } ?>
                        </tbody>
                    </table>
            </div>
        <?php } ?>
        <script type="text/javascript">

            $(document).ready(function(){

                $("#header").load("header.html");

                $('#button').click(function(){

                    var query = $('#query').val();
                    var text =  $('#text').val();

                    console.log("query : "+query);
                    console.log("text : "+text);
                    

                    if(isEmpty(query) || isEmpty(text)){
                        alert("검색할 항목과 강의명 혹은 학번을 입력해주세요");
                    }else{
                        location.href = "stats.php?query="+query+"&text="+text;
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
