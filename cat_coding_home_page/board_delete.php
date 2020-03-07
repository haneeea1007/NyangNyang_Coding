<?php

    $num = $_GET["num"];
    $page = $_GET["page"];

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
    $sql = "select * from board where num = $num";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

    if ($copied_name) {

        $file_path = "./data/".$copied_name;
        unlink($file_path);
    }

    $sql = "delete from board where num = $num";

    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
        <script>
            alert('삭제가 완료되었습니다.');
            location.href = 'board_list.php?page=$page';
        </script>
        ";
?>