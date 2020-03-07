<meta charset="UTF-8">

<?php

    session_start();

    if (isset($_SESSION["userid"])) {
        $userid = $_SESSION["userid"];

    } else {
        $userid = "";
    }

    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];

    } else {
        $username = "";
    }

    if (!$userid) {
        
        echo "
            <script>
            alert('로그인 후 이용해 주세요.');
            history.go(-1)
            </script>
        ";

        exit;
    }

    // 시간 셋팅하기
	date_default_timezone_set('Asia/Seoul');

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i)");

    $group_num = 0;
    $depth = 0;
    $ord = 0;
    $hit = 0;

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");

    $sql = "insert into qna (group_num, depth, ord, id, name, subject, content, regist_day, hit)";
    $sql .= "values('$group_num', '$depth', '$ord', '$userid', '$username', '$subject', '$content', '$regist_day', '$hit');";

    mysqli_query($con, $sql);    
    
    //현재 최대큰번호를 가져와서 그룹번호로 저장하기
    $sql = "select max(num) from qna;";
    $result = mysqli_query($con,$sql);
    
    if (!$result) {
       die('Error: ' . mysqli_error($con));
    }
    
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];
    
    $sql= "update qna SET group_num = $max_num where num = $max_num;";
    $result = mysqli_query($con,$sql);
    
    if (!$result) {
       die('Error: ' . mysqli_error($con));
    }
     
    mysqli_close($con);

    echo "
        <script>
            alert('작성이 완료되었습니다.');
            location.href = './qna_list.php';
        </script>
    ";

?>