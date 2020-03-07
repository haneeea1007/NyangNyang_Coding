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
        <?php include "header.php"; ?>
    </header>

    <section>

        <div id="board_box">
            <h3>
                [ 자유게시판 ]
            </h3>

            <ul id="board_list">
                <li id="list_title">
                    <span class="col1"><b>번호</b></span>
                    <span class="col2"><b>제목</b></span>
                    <span class="col3"><b>작성자</b></span>
                    <span class="col4"><b>첨부</b></span>
                    <span class="col5"><b>작성일자</b></span>
                    <span class="col6"><b>조회수</b></span>
                </li>

                <?php
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];

                    } else {
                        $page = 1;
                    }

                    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
                    $sql = "select * from board order by num desc";

                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result);

                    $scale = 6;

                    if ($total_record % $scale == 0) {
                        $total_page = floor($total_record / $scale);

                    } else {
                        $total_page = floor($total_record / $scale) + 1;
                    }

                    $page_setting = ($page - 1) * $scale;

                    $page_start = $total_record - $page_setting;

                    for ($i = $page_setting; $i < $page_setting + $scale && $i < $total_record; $i++) {

                        mysqli_data_seek($result, $i);

                        $row = mysqli_fetch_array($result);

                        $num = $row["num"];
                        $id = $row["id"];
                        $name = $row["name"];
                        $subject = $row["subject"];
                        $regist_day = $row["regist_day"];
                        $hit = $row["hit"];

                        if ($row["file_name"]) {
                            $file_image = "<img src='./img/file.gif' height='13'>";

                        } else {
                            $file_image = "";
                        }
                    ?>

                        <li>
                            <span class="col1"><?=$page_start?></span>
                            <span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                            <span class="col3"><?=$name?></span>
                            <span class="col4"><?=$file_image?></span>
                            <span class="col5"><?=$regist_day?></span>
                            <span class="col6"><?=$hit?></span>
                        </li>

                    <?php
                        $page_start--;
                    }
                    mysqli_close($con);
                    ?>
            </ul>

            <ul id="page_num">

            <?php
                if ($total_page >=2 && $page >= 2) {
                    $new_page = $page - 1;
                    echo "<li><a href='board_list.php?page=$new_page'>◀ 이전&nbsp</a></li>";

                } else {
                    echo "<li>&nbsp;</li>";
                }

                for ($i = 1; $i <= $total_page; $i++) {

                    if ($page == $i) {

                        echo "<li><b> $i </b></li>";

                    } else {
                        echo "<li><a href='board_list.php?page=$i'> &nbsp$i&nbsp </a></li>";
                    }
                }
                
                if ($total_page >= 2 && $page != $total_page) {

                    $new_page = $page + 1;
                    echo "<li><a href='board_list.php?page=$new_page'>다음 ▶&nbsp</a></li>";

                } else {
                    echo "<li>&nbsp;</li>";
                }
            ?>

            </ul>

            <ul class="buttons_list">

                <li>

                <?php    
                    if ($userid) {
                ?>

                <li><button id="button_list_write" type="button" onclick="location.href='board_form.php?mode=insert'">작성하기</button></li>

                <?php
                    } else { 
                ?>

                <a href="javascript:alert('로그인 후 이용해 주세요.')"><button id="button_list_write">작성하기</button></a>

                <?php
                    }
                ?>

                </li>
            </ul>
        </div>
    </section>

    <footer>
        <?php include "footer.php";?> 
    </footer>

</body>

</html>