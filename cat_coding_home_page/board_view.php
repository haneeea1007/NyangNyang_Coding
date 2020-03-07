<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>냥냥코딩</title>

    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
</head>

<body>

    <header>
        <?php include "header.php";?>
    </header>  

    <section>
        <div id="board_box">
            <h3 class="title">
                [ 자유게시판 ] 내용보기
            </h3>

            <?php

                $num = $_GET["num"];
                $page = $_GET["page"];

                $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
                $sql = "select * from board where num=$num";
                
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                $id = $row["id"];
                $name = $row["name"];
                $regist_day = $row["regist_day"];
                $subject = $row["subject"];
                $content = $row["content"];
                $file_name = $row["file_name"];
                $file_type = $row["file_type"];
                $file_copied = $row["file_copied"];
                $hit = $row["hit"];

                $connect = str_replace(" ", "&nbsp;", $content);
                $connect = str_replace("\n", "<br>", $content);

                $new_hit = $hit + 1;

                $sql = "update board set hit=$new_hit where num=$num";
                mysqli_query($con, $sql);

            ?>

            <ul id="view_content">
                <li>
                    <span class="col1"><b>제목 : &nbsp;</b><?=$subject?></span>
                    <span class="col2">작성자 : <?=$name?> &nbsp;|&nbsp; 작성일자 : <?=$regist_day?> &nbsp;|&nbsp; 조회수 : <?=$new_hit?></span>
                </li>

                <li>
                    <?php

                        if ($file_name) {
                            $real_name = $file_copied;
                            $file_path = "./data/".$real_name;
                            $file_size = filesize($file_path);

                            echo 
                                "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>
                                [다운로드]</a><br><br>
                                ";
                        }
                    ?>

                    <?=$content?>

                </li>
            </ul>

            <ul class="buttons_view">
                
            <?php
                 if ($userid == $id) {
            ?>
                <li><button onclick="location.href='board_form.php?mode=update&num=<?=$num?>&page=<?=$page?>'">수정</button></li>
                <li><button onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>

            <?php
                } else { 
            ?>

                <li><a href="javascript:alert('작성자 권한이 없습니다.')"><button>수정</button></a></li>
                <li><a href="javascript:alert('작성자 권한이 없습니다.')"><button>삭제</button></a></li>

            <?php
                }
            ?>
                <li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록보기</button></li>

            </ul>
        </div>
    </section>

    <footer>
        <?php include "footer.php";?>
    </footer>

</body>

</html>