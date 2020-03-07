<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>냥냥코딩</title>

    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
    <link rel="stylesheet" href="./css/admin.css">

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
            [ 관리자 모드 ] 회원 관리
        </h3>

        <ul id="member_list">
            <li>
                <span class="col1">번호</span>
                <span class="col2">아이디</span>
                <span class="col3">이름</span>
                <span class="col4">레벨</span>
                <span class="col5">포인트</span>
                <span class="col6">가입일</span>
                <span class="col7">수정</span>
                <span class="col8">삭제</span>
            </li>

            <?php

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];

                } else {
                    $page = 1;
                }

                $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
                $sql = "select * from members order by num desc";

                $result = mysqli_query($con, $sql);
                $num_members = mysqli_num_rows($result); // 전체 회원 수

                $scale = 6;

                if ($num_members % $scale == 0) {
                    $total_page = floor($num_members / $scale);

                } else {
                    $total_page = floor($num_members / $scale) + 1;
                }

                $page_setting = ($page - 1) * $scale;

                $page_start = $num_members - $page_setting;

                // 리스트 반복 출력
                // while ($row = mysqli_fetch_array($result)) { 와 동일한 코드
                // for ($i = $num_members; $i > 0; $i--) {
                for ($i = $page_setting; $i < $num_members && $i < $page_setting + $scale; $i++) {

                    mysqli_data_seek($result, $i);

                    $row = mysqli_fetch_array($result);

                    $num = $row["num"];
                    $id = $row["id"];
                    $name = $row["name"];
                    $level = $row["level"];
                    $point = $row["point"];
                    $regist_day = $row["regist_day"];

            ?>

                <li>
                    <form name="" method="post" action="admin_member_update.php?num=<?=$num?>">
                        <span class="col1"><?=$page_start?></span>
                        <span class="col2"><?=$id?></span>
                        <span class="col3"><?=$name?></span>
                        <span class="col4"><input name="level" value="<?=$level?>" type="text"></span>
                        <span class="col5"><input name="point" value="<?=$point?>" type="text"></span>
                        <span class="col6"><?=$regist_day?></span>
                        <span class="col7"><button type="submit">수정</button></span>
                        <span class="col8"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
                    </form>
                </li>

            <?php
                // $num_members--;
                $page_start--;
            }
            mysqli_close($con);
            ?>

        </ul>

        <ul id="page_num_member">

            <?php
                if ($total_page >=2 && $page >= 2) {
                    $new_page = $page - 1;
                    echo "<li><a href='admin_manage_member.php?page=$new_page'>◀ 이전&nbsp</a></li>";

                } else {
                    echo "<li>&nbsp;</li>";
                }

                for ($i = 1; $i <= $total_page; $i++) {

                    if ($page == $i) {

                        echo "<li><b> $i </b></li>";

                    } else {
                        echo "<li><a href='admin_manage_member.php?page=$i'> &nbsp$i&nbsp </a></li>";
                    }
                }
                
                if ($total_page >= 2 && $page != $total_page) {

                    $new_page = $page + 1;
                    echo "<li><a href='admin_manage_member.php?page=$new_page'>다음 ▶&nbsp</a></li>";

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