<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>냥냥코딩</title>

	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/message.css">
	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

	<script>
		// 입력 검증
		function check_input() {

			if (!document.message_form.subject.value) {
				alert("제목을 입력해 주세요.");
				document.message_form.subject.focus();
				return;
			}

			if (!document.message_form.content.value) {
				alert("내용을 입력해 주세요.");
				document.message_form.content.focus();
				return;
			}

			document.message_form.submit();
		}
	</script>

</head>

<body>

	<header>
		<?php include "header.php"; ?>
	</header>

	<section>

	<div id="message_menu">
		<h4>Message</h4>
		<ul>
			<li><span><a href="message_box.php?mode=rv">♥ 받은 쪽지함 </a></span></li>
			<li><span><a href="message_box.php?mode=send">♥ 보낸 쪽지함</a></span></li>
			<li><span><a href="message_form.php">♥ 쪽지 보내기</a></span></li>
		</ul>
		</div>

		<div id="message_box">

			<h3 id="write_title">
				[ 답장하기 ]
			</h3>

			<?php
			// message_view.php // num // GET 방식
			$num  = $_GET["num"];

			$con = mysqli_connect("127.0.0.1", "root", "123456", "test");
			$sql = "select * from message where num=$num";

			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			
			$send_id = $row["send_id"];
			$rv_id = $row["rv_id"];
			$subject = $row["subject"];
			$content = $row["content"];

			// 양식 지정하기
			$subject = "RE: " . $subject;

			$content = "> " . $content;
			$content = str_replace("\n", "\n>", $content);
			$content = "\n\n\n-----------------------------------------------\n" . $content;

			$result2 = mysqli_query($con, "select name from members where id='$send_id'");
			$record = mysqli_fetch_array($result2);

			$send_name = $record["name"];
			?>

			<!-- message_insert.php // send_id // GET 방식 -->
			<form name="message_form" method="post" action="message_insert.php?send_id=<?= $userid ?>">

				<input type="hidden" name="rv_id" value="<?= $send_id ?>">

				<div id="write_msg">
					<ul>
						<li>
							<span class="col1">보내는 사람 : </span>
							<span class="col2"><?= $userid ?></span>
						</li>

						<li>
							<span class="col1">받는 사람 : </span>
							<span class="col2"><?= $send_name ?>(<?= $send_id ?>)</span>
						</li>

						<li>
							<span class="col1">제목 : </span>
							<span class="col2"><input name="subject" type="text" value="<?= $subject ?>"></span>
						</li>

						<li id="text_area">
							<span class="col1">내용 : </span>
							<span class="col2">
								<textarea name="content"><?= $content ?></textarea>
							</span>
						</li>
					</ul>

					<button type="button" onclick="check_input()">보내기</button>

				</div>
			</form>

		</div>
	</section>

	<footer>
		<?php include "footer.php"; ?>
	</footer>

</body>

</html>