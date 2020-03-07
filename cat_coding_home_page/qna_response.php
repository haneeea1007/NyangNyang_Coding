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

    $num = $_GET["num"];
    $page = $_GET["page"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i)");
    $hit = 0;

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
    $sql = "select * from qna where num=$num;";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $row = mysqli_fetch_array($result);

    // 현재 그룹 넘버를 가져와서 저장
    $group_num = (int) $row['group_num'];

    // 현재 들여쓰기값을 가져와서 증가한 후 저장
    $depth = (int) $row['depth'] + 1;

    // 현재 순서값을 가져와서 증가한 후 저장
    $ord = (int) $row['ord'] + 1;

    // 현재 그룹 넘버가 같은 모든 레코드를 찾아서 현재 $ord값보다 같거나 큰 레코드에 $ord 값을 1을 증가시켜 저장
    $sql = "update qna set ord = ord+1 where group_num = $group_num and ord >= $ord";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $sql = "insert into qna (group_num, depth, ord, id, name, subject, content, regist_day, hit)";
    $sql .= "values('$group_num', '$depth', '$ord', '$userid', '$username', '$subject', '$content', '$regist_day', '$hit');";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $sql = "select max(num) from qna;";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $row = mysqli_fetch_array($result);
    $max_num = $row['max(num)'];

    echo "
        <script>
            location.href = './qna_view.php?num=$max_num&hit=$hit&page=$page';
        </script>
    ";

?>
