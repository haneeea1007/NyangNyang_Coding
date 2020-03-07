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

    if (isset($_POST["item"])) {
        $num_item = count($_POST["item"]);

    } else {

        echo "
            <script>
                alert('선택된 게시글이 없습니다.');
                history.go(-1)
            </script>
        ";
    }

        $con = mysqli_connect("127.0.0.1", "root", "123456", "test");

        for ($i = 0; $i < count($_POST["item"]); $i++) {

            $num = $_POST["item"][$i];
            $sql = "select * from board where num=$num";

            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $copied_name = $row["file_copied"];

            if ($copied_name) {
                $file_path = "./data/".$copied_name;
                unlink($file_path);
            }

            $sql = "delete from board where num = $num";
            mysqli_query($con, $sql);
        }

        mysqli_close($con);

        echo "
            <script>
                alert('삭제가 완료되었습니다.');
                location.href = 'admin_manage_board.php';
            </script>
        ";

?>