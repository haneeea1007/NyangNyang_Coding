<!-- <div id="main_img_bar">
    <img src="./img/main_img.png" style="margin-top: 50px;">
</div> -->

  <!-- 슬라이드 쇼 -->
  <div class="slideshow">

    <!-- 각 슬라이드 -->
    <div class="slideshow_slides">
      <a href="#"><img src="./img/nyangcoding_banner1.png" alt="slide1"></a>
      <a href="#"><img src="./img/nyangcoding_banner2.png" alt="slide2"></a>
      <a href="#"><img src="./img/nyangcoding_banner3.png" alt="slide3"></a>
      <a href="#"><img src="./img/nyangcoding_banner4.png" alt="slide4"></a>
    </div>

    <!-- 왼쪽 오른쪽 버튼 -->
    <div class="slideshow_nav">
      <a href="#" class="prev">prev</a>
      <a href="#" class="next">next</a>
    </div>

    <!-- 아래 위치표시 -->
    <div class="slideshow_indicator">
      <a href="#">&nbsp;</a>
      <a href="#">&nbsp;</a>
      <a href="#">&nbsp;</a>
      <a href="#">&nbsp;</a>
    </div>

  </div>

<div id="main_content">

<!-- 최근 게시글 div -->
    <div id="latest">
        <h4>&nbsp;&nbsp;최근 게시글</h4>
        <ul>

<!-- 최근 게시글 DB SELECT -->
<?php

    $con = mysqli_connect("localhost", "root", "123456", "test");
    $sql = "select * from board order by num desc limit 4";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "최근 게시글이 없습니다.";

    } else {

        while ($row = mysqli_fetch_array($result)) {
            
            $regist_day = substr($row["regist_day"], 0, 10);

?>

            <li>
                <span><a href="./board_list.php?"><?=$row["subject"]?></a></span>
                <span><?=$row["name"]?></span>
                <span><?=$regist_day?></span>
            </li>

<?php
        }
    }
?>

        </ul>
    </div>

<!-- 포인트 랭킹 div -->
    <div id="point_rank">
        <h4>&nbsp;&nbsp;포인트 랭킹</h4>
        <ul>

<!-- 포인트 랭킹 DB SELECT -->
<?php

    $rank = 1;
    $sql = "select * from members order by point desc limit 4";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "가입 회원이 없습니다.";

    } else {
        while ($row = mysqli_fetch_array($result)) {

            $name = $row["name"];
            $id = $row["id"];
            $point = $row["point"]." P";
            $name = $name." 고양이";

?>

            <li>
                <span><?=$rank?>등</span>
                <span><?=$name?></span>
                <span><?=$id?></span>
                <span><?=$point?></span>
            </li>

<?php

            $rank++;

        }
    }
    mysqli_close($con);
?>

        </ul>
    </div>
</div>