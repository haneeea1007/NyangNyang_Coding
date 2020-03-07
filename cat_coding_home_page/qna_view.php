<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>냥냥코딩</title>

    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/qna.css">
</head>

<body>

    <header>
        <?php include "header.php";?>
    </header>  

    <section>
        <div id="board_box">
            <h3 class="title">
                [ Q & A ] 내용보기
            </h3>

            <?php
            
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];

                } else {
                    $page = 1;
                }

                $num = $_GET["num"];
                $page = $_GET["page"];

                $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
                $sql = "select * from qna where num=$num";
                
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                $id = $row["id"];
                $name = $row["name"];
                $regist_day = $row["regist_day"];
                $subject = $row["subject"];
                $content = $row["content"];
                $hit = $row["hit"];

                $connect = str_replace(" ", "&nbsp;", $content);
                $connect = str_replace("\n", "<br>", $content);

                $new_hit = $hit + 1;

                $sql = "update qna set hit=$new_hit where num=$num";
                mysqli_query($con, $sql);

            ?>

            <ul id="view_content">
                <li>
                    <span class="col1"><b>제목 : &nbsp;</b><?=$subject?></span>
                    <span class="col2">작성자 : <?=$name?> &nbsp;|&nbsp; 작성일자 : <?=$regist_day?> &nbsp;|&nbsp; 조회수 : <?=$new_hit?></span>
                </li>

                <li>
                    <?=$content?>
                </li>

            </ul>

            <ul class="buttons_view">
            
            <?php
                 if ($userid == 'admin') {
            ?>

                <li><button onclick="location.href='qna_form.php?mode=response&num=<?=$num?>&page=<?=$page?>'">답변하기</button></li>

            <?php
                } else { 
            ?>

                <li><a href="javascript:alert('관리자 권한이 없습니다.')"><button>답변하기</button></a></li>

            <?php
                }
            ?>

            <?php
                 if ($userid == $id) {
            ?>
            
                <li><button onclick="location.href='qna_form.php?mode=update&num=<?=$num?>&page=<?=$page?>'">수정</button></li>
                <li><button onclick="location.href='qna_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
            
            <?php
                } else { 
            ?>

                <li><a href="javascript:alert('작성자 권한이 없습니다.')"><button>수정</button></a></li>
                <li><a href="javascript:alert('작성자 권한이 없습니다.')"><button>삭제</button></a></li>

            <?php
                }
            ?>
                <li><button onclick="location.href='qna_list.php?page=<?=$page?>'">목록보기</button></li>

            </ul>
        </div>
    </section>

    <footer>
        <?php include "footer.php";?>
    </footer>

</body>

</html>