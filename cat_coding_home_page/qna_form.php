<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>냥냥코딩</title>

    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/qna.css">
    <link rel="stylesheet" href="./css/common.css">

    <script>
        function check_input() {

            if (!document.board_form.subject.value) {
                alert("제목을 입력해 주세요.");
                document.board_form.subject.focus();
                return;
            
            } else if (!document.board_form.content.value) {
                alert("내용을 입력해 주세요.");
                document.board_form.content.focus();
                return;

            } else {
                document.board_form.submit();
            }
        }
    </script>
</head>

<body>
    
    <header>
        <?php include "header.php"; ?>
    </header>

    <section>
        <div id="board_box">

            <?php 

                $mode = $_GET["mode"];

                // 작성하기 모드일 때 ========================================================================
                if ($mode == 'insert') {

                    echo "<h3 id='board_title'>
                            [ Q & A ] 작성하기
                        </h3>";

            ?>

            <form name="board_form" method="post" action="qna_insert.php" enctype="multipart/form-data">
                <ul id="board_form">
                    <li>
                        <span class="col1">이름 : </span>
                        <span class="col2"><?=$username?></span>
                    </li>

                    <li>
                        <span class="col1">제목 : </span>
                        <span class="col2"><input name="subject" type="text"></span>
                    </li>

                    <li id="text_area">
                        <span class="col1">내용 : </span>
                        <span class="col2">
                            <textarea name="content"></textarea>
                        </span>
                    </li>

                </ul>

                <ul class="buttons">
                    <li><button type="button" onclick="check_input();">작성완료</button></li>
                    <li><button type="button" onclick="location.href='qna_list.php'">목록보기</button></li>
                </ul>
            </form>
                    
                
            <?php

                // 수정하기 모드일 때============================================================================
                } else if ($mode == 'update') {

                    echo "<h3 id='board_title'>
                            [ Q & A ] 수정하기
                        </h3>";

                    $num = $_GET["num"];
                    $page = $_GET["page"];
        
                    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
                    $sql = "select * from qna where num = $num";
        
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
        
                    $name = $row["name"];
                    $subject = $row["subject"];
                    $content = $row["content"];
            
            ?>

            <form name="board_form" method="post" action="qna_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
                <ul id="board_form">
                    <li>
                        <span class="col1">이름 : </span>
                        <span class="col2"><?=$username?></span>
                    </li>

                    <li>
                        <span class="col1">제목 : </span>
                        <span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
                    </li>

                    <li id="text_area">
                        <span class="col1">내용 : </span>
                        <span class="col2">
                            <textarea name="content"><?=$content?></textarea>
                        </span>
                    </li>

                </ul>

                <ul class="buttons">
                    <li><button type="button" onclick="check_input();">수정완료</button></li>
                    <li><button type="button" onclick="location.href='qna_list.php'">목록보기</button></li>
                </ul>
            </form>

            <?php

                // 답변하기 모드일 때============================================================================
                } else if ($mode == 'response') {

                    echo "<h3 id='board_title'>
                            [ Q & A ] 답변하기
                        </h3>";

                    $num = $_GET["num"];
                    $page = $_GET["page"];

                    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
                    $sql = "select * from qna where num = $num";

                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);

                    $name = $row["name"];
                    $subject = $row["subject"];
                    $content = $row["content"];

                ?>

                <form name="board_form" method="post" action="qna_response.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
                    <ul id="board_form">
                        <li>
                            <span class="col1">이름 : </span>
                            <span class="col2"><?=$username?></span>
                        </li>

                        <li>
                            <span class="col1">제목 : </span>
                            <span class="col2"><input name="subject" type="text" value="└[ re ♥ ] <?=$subject?>"></span>
                        </li>

                        <li id="text_area">
                            <span class="col1">내용 : </span>
                            <span class="col2">
                                <textarea name="content"><?="▶ ".$content?></textarea>
                            </span>
                        </li>

                    </ul>

                    <ul class="buttons">
                        <li><button type="button" onclick="check_input();">답변완료</button></li>
                        <li><button type="button" onclick="location.href='qna_list.php?page=<?=$page?>'">목록보기</button></li>
                    </ul>
                </form>

            <?php
                }
            ?>

        </div>
    </section>

    <footer>
        <?php include "footer.php"; ?>
    </footer>
    
</body>

</html>