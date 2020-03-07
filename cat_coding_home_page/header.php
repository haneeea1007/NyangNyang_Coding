<?php
    // session ==================================================
    // login 에서 가져온 세션값이 있는지 점검
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

    if (isset($_SESSION["userlevel"])) {
        $userlevel = $_SESSION["userlevel"];
    } else {
        $userlevel = "";
    }

    if (isset($_SESSION["userpoint"])) {
        $userpoint = $_SESSION["userpoint"];
    } else {
        $userpoint = "";
    }
    // session ==================================================

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");

    $sql = "select point from members where id='$userid'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $new_point = $row["point"];

    $userpoint = $new_point;
    
    mysqli_query($con, $sql);

    mysqli_close($con);

?>

<!-- 타이틀 & 오른쪽 상단 메뉴 ------------------------------------------------------------------------>

<div id="top">

    <h3>
        <a href="./index.php">
            <img id="title_img" src="./img/nyangcoding_title.png" width="200px" height="40px">
        </a>
    </h3>

    <ul id="top_menu">
    <!-- start of ul -->

<!-- 세션값 점검해서 리스트 보여주기 ---------------------------------------------------------------->

<!-- 1. 세션값이 없을 때 (로그인X) -->
<?php
    if (!$userid) {
?>
        <li><a href="./login_form.php">&nbsp;로그인&nbsp;</a></li>
        <li> | </li>
        <li><a href="./member_form.php">&nbsp;회원가입&nbsp;</a></li>

<!-- 2. 세션값이 있을 때 (로그인O) -->
<?php
    } else {
        $logged = "<b>".$username." 고양이</b> ( 레벨 : ".$userlevel." / 포인트 : ".$userpoint." P )&nbsp;";
?>

        <li><?=$logged?></li>
        <li> | </li>
        <li><a href="./logout.php">&nbsp;로그아웃&nbsp;</a></li>
        <li> | </li>
        <li><a href="member_modify_form.php">&nbsp;마이페이지&nbsp;</a></li>

<!-- 3. 관리자 모드일 때 (관리자 로그인O)-->
<?php
    }
    if ($userlevel == 1) {
?>
        <li> | </li>
        <li><a href="admin_manage_member.php">&nbsp;관리자모드</a></li>
<?php
    }
?>
<!-- 세션값 점검해서 리스트 보여주기 -------------------------------------------------------------->

    </ul>
    <!-- end of ul -->
</div>

<!-- 메뉴바 --------------------------------------------------------------------------------------->
<div id="menu_bar">
    <ul>
    <span id="span-padding"></span>
        <li><a href="./index.php">H O M E</a></li><span id="span-padding"></span>
        <li><a href="./board_list.php">자유게시판</a></li><span id="span-padding"></span>
        <li><a href="./qna_list.php">Q & A</a></li><span id="span-padding"></span>
        <li><a href="./message_box.php?mode=rv">쪽지함</a></li><span id="span-padding"></span>
    </ul>
</div>