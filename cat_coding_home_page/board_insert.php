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

    if (isset($_SESSION["userpoint"])) {
        $userpoint = $_SESSION["userpoint"];

    } else {
        $userpoint = "";
    }


    // 시간 셋팅하기
	date_default_timezone_set('Asia/Seoul');

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");

    $upload_dir = './data/';

    $upfile_name = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type = $_FILES["upfile"]["type"];
    $upfile_size = $_FILES["upfile"]["size"];
    $upfile_error = $_FILES["upfile"]["error"];

    if ($upfile_name && !$upfile_error) {

        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext = $file[1];

        $new_file_name = date("Y_m_d_H_i_s");
        // $new_file_name = $new_file_name;
        $copied_file_name = $new_file_name.".".$file_ext;
        $uploaded_file = $upload_dir.$copied_file_name;

        if ($upfile_size > 1000000) {

            echo "
                <script>
                alert('파일 크기는 1MB을 넘을 수 없습니다.');
                history.go(-1)
                </script>
                ";

            exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {

            echo "
                <script>
                alert('파일을 복사하는 데 실패하였습니다.');
                history.go(-1)
                </script>
                ";

            exit;
        }

    } else {

        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
    }

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");

    $sql = "insert into board (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied)";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, '$upfile_name', '$upfile_type', '$copied_file_name')";

    mysqli_query($con, $sql);

    $sql = "select point from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $point_up = 100;
    $new_point = $row["point"] + $point_up;

    $sql = "update members set point=$new_point where id='$userid'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
        <script>
        alert('작성이 완료되었습니다.');
        location.href = 'board_list.php';
        </script>
        ";

?>