<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>냥냥코딩</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/message.css">
	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

	<header>
		<?php include "header.php"; ?>
	</header>

	<section>

	<div id="message_menu">
		<ul>
			<h4>Message</h4>
			<li><span><a href="message_box.php?mode=rv">♥ 받은 쪽지함 </a></span></li>
			<li><span><a href="message_box.php?mode=send">♥ 보낸 쪽지함</a></span></li>
			<li><span><a href="message_form.php">♥ 쪽지 보내기</a></span></li>
		</ul>
		</div>
	
		<div id="message_box">
			<div id="message_view">
			<h3 class="title">

				<?php
				// message_box.php // mode, num // GET 방식
				$mode = $_GET["mode"];
				$num  = $_GET["num"];

				$con = mysqli_connect("127.0.0.1", "root", "123456", "test");
				$sql = "select * from message where num=$num";
				$result = mysqli_query($con, $sql);

				$row = mysqli_fetch_array($result);
				$send_id    = $row["send_id"];
				$rv_id      = $row["rv_id"];
				$regist_day = $row["regist_day"];
				$subject    = $row["subject"];
				$content    = $row["content"];

				$content = str_replace(" ", "&nbsp;", $content);
				$content = str_replace("\n", "<br>", $content);

				// 모드 구분하기
				if ($mode == "send") {
					$result2 = mysqli_query($con, "select name from members where id='$rv_id'");

				} else {
					$result2 = mysqli_query($con, "select name from members where id='$send_id'");
				}

				$record = mysqli_fetch_array($result2);
				$msg_name = $record["name"];

				// 제목 설정하기
				if ($mode == "send") {
					echo "[ 보낸 쪽지 ]";

				} else {
					echo "[ 받은 쪽지 ]";
				}
				?>
				
			</h3>

			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :</b> <?= $subject ?></span>
					<span class="col2">작성자 : <?= $msg_name ?> &nbsp;|&nbsp; 작성일자 : <?= $regist_day ?></span>
				</li>

				<li>
					<?= $content ?>
				</li>
			</ul>

			<ul class="buttons">
				<!-- message_box.php // mode // GET 방식 -->
				<?php
					if ($mode == "send") {
						echo "<li><button onclick=location.href='message_box.php?mode=send'>목록보기</button></li>";
					} else {
						echo "<li><button onclick=location.href='message_box.php?mode=rv'>목록보기</button></li>";
					}
				?>

				<!-- message_response_form.php // num // GET 방식 -->
				<li><button onclick="location.href='message_response_form.php?num=<?= $num ?>'">답장하기</button></li>

				<!-- message_delete.php // num, mode // GET 방식 -->
				<li><button onclick="location.href='message_delete.php?num=<?= $num ?>&mode=<?= $mode ?>'">삭제</button></li>
			</ul>
			</div>
		</div> <!-- message_box -->
	</section>

	<footer>
		<?php include "footer.php"; ?>
	</footer>

</body>

</html>