<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>냥냥코딩</title>

	<link rel="stylesheet" type="text/css" href="./css/message.css">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
	
	<script>
		// 입력 검증
		function check_input() {
			if (!document.message_form.rv_id.value) {
				alert("받는 사람을 입력해 주세요.");
				document.message_form.rv_id.focus();
				return;
			}
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
		<ul>
			<h4>Message</h4>
			<li><span><a href="message_box.php?mode=rv">♥ 받은 쪽지함 </a></span></li>
			<li><span><a href="message_box.php?mode=send">♥ 보낸 쪽지함</a></span></li>
			<li>♥ 쪽지 보내기</li>
		</ul>
		</div>

		<div id="message_box">

			<h3 id="write_title">
				[ 쪽지 보내기 ]
			</h3>

			<!-- <ul class="top_buttons">
				<li><span><a href="message_box.php?mode=rv">받은 쪽지함 </a></span></li>
				<li><span><a href="message_box.php?mode=send">보낸 쪽지함</a></span></li>
			</ul> -->

			<!-- message_insert.php // send_id // GET 방식 -->
			<form name="message_form" method="post" action="message_insert.php?send_id=<?= $userid ?>">
				<div id="write_msg">
					<ul>
						<li>
							<span class="col1">보내는 사람 : </span>
							<span class="col2"><?= $userid ?></span>
						</li>
						<li>
							<span class="col1">받는 사람 ID : </span>
							<span class="col2"><input name="rv_id" type="text"></span>
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

					<button type="button" onclick="check_input()">전송하기</button>

				</div>
			</form>
		</div> <!-- message_box -->
	</section>

	<footer>
		<?php include "footer.php"; ?>
	</footer>

</body>

</html>