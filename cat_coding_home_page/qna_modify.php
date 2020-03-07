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

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
    $sql = "update qna set subject = '$subject', content = '$content' where num = $num";
    
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
            <script>
                alert('수정이 완료되었습니다.');
                location.href = './qna_view.php?num=$num&page=$page';
            </script>
    ";
?>