<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>냥냥코딩</title>

    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">

</head>

<body>
    
    <header>
        <?php include "header.php";?>
    </header>  

    <section>

        <div id="message_menu">
            <ul>
                <h4>Admin Mode</h4>
                <li><span><a href="admin_manage_member.php">♥ 회원 관리 </a></span></li>
                <li><span><a href="admin_manage_board.php">♥ 게시판 관리</a></span></li>
                <li><span><a href="admin_manage_qna.php">♥ Q & A 관리</a></span></li>
            </ul>
        </div>
        

        <div id="admin_box">

            <h3 id="member_title">
                [ 관리자 모드 ] 게시판 관리
            </h3>

            <ul id="board_list">
                <li class="title">
                    <span class="col1">선택</span>
                    <span class="col2">번호</span>
                    <span class="col3">이름</span>
                    <span class="col4">제목</span>
                    <span class="col5">첨부파일</span>
                    <span class="col6">작성날짜</span>
                </li>

                <form method="post" action="admin_board_delete.php">

            <?php

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];

                } else {
                    $page = 1;
                }

                $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
                $sql = "select * from board order by num desc";
                $result = mysqli_query($con, $sql);

                $num_board = mysqli_num_rows($result); // 전체 글 수

                $scale = 6;

                if ($num_board % $scale == 0) {
                    $total_page = floor($num_board / $scale);

                } else {
                    $total_page = floor($num_board / $scale) + 1;
                }

                $page_setting = ($page - 1) * $scale;

                $page_start = $num_board - $page_setting;

                for ($i = $page_setting; $i < $num_board && $i < $page_setting + $scale; $i++) {

                    mysqli_data_seek($result, $i);
                    $row = mysqli_fetch_array($result);

                    $num = $row["num"];
                    $name = $row["name"];
                    $subject = $row["subject"];
                    $file_name = $row["file_name"];
                    $regist_day = $row["regist_day"];

                    // 날짜 자르기
                    $regist_day = substr($regist_day, 0, 10);

            ?>
                    <li>
                        <span class="col1"><input type="checkbox" id="checkbox" name="item[]" value="<?=$num?>"></span>
                        <span class="col2"><?=$page_start?></span>
                        <span class="col3"><?=$name?></span>
                        <span class="col4"><?=$subject?></span>
                        <span class="col5"><?=$file_name?></span>
                        <span class="col6"><?=$regist_day?></span>
                    </li>
                    
            <?php
                $page_start--;
            }
            mysqli_close($con);
            ?>
            
                    <button type="submit">선택 삭제</button>
                </form>
            </ul>

            <ul id="page_num">

            <?php
                if ($total_page >=2 && $page >= 2) {
                    $new_page = $page - 1;
                    echo "<li><a href='admin_manage_board.php?page=$new_page'>◀ 이전&nbsp</a></li>";

                } else {
                    echo "<li>&nbsp;</li>";
                }

                for ($i = 1; $i <= $total_page; $i++) {

                    if ($page == $i) {

                        echo "<li><b> $i </b></li>";

                    } else {
                        echo "<li><a href='admin_manage_board.php?page=$i'> &nbsp$i&nbsp </a></li>";
                    }
                }
                
                if ($total_page >= 2 && $page != $total_page) {

                    $new_page = $page + 1;
                    echo "<li><a href='admin_manage_board.php?page=$new_page'>다음 ▶&nbsp</a></li>";

                } else {
                    echo "<li>&nbsp;</li>";
                }
            ?>

            </ul>
            
        </div>  
    </section>

    <footer>
        <?php include "footer.php";?>
    </footer>

</body>
</html>