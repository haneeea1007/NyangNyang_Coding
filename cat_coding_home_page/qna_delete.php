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


    $num = $_GET["num"];
    $page = $_GET["page"];

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
    $sql = "delete from qna where num = $num;";

    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
        <script>
            alert('삭제가 완료되었습니다.');
            location.href = './qna_list.php?page=$page';
        </script>
    ";
?>