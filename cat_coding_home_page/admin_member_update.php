<?php

    session_start();

    if (isset($_SESSION["userlevel"])) {
        $userlevel = $_SESSION["userlevel"];

    } else {
        $userlevel = "";
    }

    if ($userlevel != 1) {
      
        echo "
            <script>
                alert('관리자 권한이 필요합니다.');
                history.go(-1)
            </script>
        ";

        exit;
    }

    $num = $_GET["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
    $sql = "update members set level=$level, point=$point where num=$num";

    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
        <script>
            alert('수정이 완료되었습니다.');
            location.href = 'admin_manage_member.php';
        </script>
      ";
?>