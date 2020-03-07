<?php

    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

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

    // 새로운 파일 첨부가 없을 때
    if ($upfile_name == "") {
        $sql = "update board set subject='$subject', content='$content' where num=$num";
        
    // 새로운 파일 첨부가 있을 때
    } else {

        // 원래 있던 파일을 삭제
        $sql = "select file_copied from board where num=$num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $delete_file_name = $row["file_copied"];

        unlink($upload_dir.$delete_file_name);

        $sql = "update board set subject='$subject', content='$content', file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' where num=$num";
    }
    
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
            <script>
                alert('수정이 완료되었습니다.');
                location.href = 'board_view.php?num=$num&page=$page';
            </script>
        ";
?>