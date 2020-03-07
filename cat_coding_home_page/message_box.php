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

</head>

<body>
	
	<header>
		<?php include "header.php"; ?>
	</header>

	<?php
	if (!$userid) {
		echo ("<script>
				alert('로그인 후 이용해주세요.');
				history.go(-1);
				</script>
			");
		exit;
	}
	?>

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

			<!-- 제목 설정하기 ---------------------------------------------------------------------------------->
			<h3 id="h3_list">
				<?php

				// 페이지 가져오기 // parseInt 로 바꿔주어야 함
				if (isset($_GET["page"])) {
					$page = $_GET["page"];

				} else {
					$page = 1;
				}

				// 모드 가져오기
				$mode = $_GET["mode"];

				if ($mode == "send") {
					echo "[ 보낸 쪽지함 ]";

				} else {
					echo "[ 받은 쪽지함 ]";
				}

				?>
			</h3>

			<div>
				<!-- start of 쪽지 목록 ---------------------------------------------------------------------------->
				<ul id="message"> 

					<li>
						<span class="col1">번호</span>
						<span class="col2">제목</span>
						<span class="col3">

							<!-- 모드 구분하기 -->
							<?php
							if ($mode == "send") {
								echo "받은 사람";

							} else {
								echo "보낸 사람";
							}
							?>

						</span>
						<span class="col4">작성일자</span>
					</li>

					<?php
					// DB에서 레코드셋 가져오기
					// $con == DB를 가르키는 포인터(핸들러)
					$con = mysqli_connect("127.0.0.1", "root", "123456", "test");

					// 모드 구분하기
					if ($mode == "send") {
						$sql = "select * from message where send_id='$userid' order by num desc";

					} else {
						$sql = "select * from message where rv_id='$userid' order by num desc";
					}

					$result = mysqli_query($con, $sql); // 레코드셋
					$total_record = mysqli_num_rows($result); // 전체 글 수

					$scale = 6; // 한 페이지에 보여지는 글 수

					// 전체 페이지 수($total_page) 계산 
					if ($total_record % $scale == 0) {
						$total_page = floor($total_record / $scale);

					} else {
						$total_page = floor($total_record / $scale) + 1;
					}

					// 페이지마다 시작하는 번호를 셋팅하기 위한 변수
					// ex) 첫번째 0 // 두번째 10 // 세번째 20 ... (페이지가 뒤로갈수록 시작하는 번호가 감소해야함)
					$page_setting = ($page - 1) * $scale; 

					// 페이지마다 시작하는 번호
					// ex) 전체글수 - 0 = 100 // 첫번째 페이지 100번 // 두번째 페이지 90번 ...
					$page_start = $total_record - $page_setting; 

					// 첫번째 0 < 10 && 0 < 138; // 0~9 인덱스를 가진 10개의 레코드를 조작
					for ($i = $page_setting; $i < $page_setting + $scale && $i < $total_record; $i++) {

						// data = 레코드셋 // 레코드셋의 위치로 포인터 이동 // 처음에는 레코드셋의 첫번째를 가르키고 있음
						mysqli_data_seek($result, $i); 
						
						// 레코드셋을 배열로 바꾸어서 가져온다
						$row = mysqli_fetch_array($result); 

						$num = $row["num"];
						$subject = $row["subject"];
						$regist_day = $row["regist_day"];

						// 모드 구분하기
						if ($mode == "send") {
							$msg_id = $row["rv_id"];

						} else {
							$msg_id = $row["send_id"];
						}

						// 이름 가져오기
						$result2 = mysqli_query($con, "select name from members where id='$msg_id'");
						$record = mysqli_fetch_array($result2);
						$msg_name = $record["name"];
					?>

						<!-- 수신쪽지함 목록 리스트 -->
						<li>
							<span class="col1"><?= $page_start ?></span>
							<!-- message_view.php // mode, num // GET방식 전달 -->
							<span class="col2"><a href="message_view.php?mode=<?= $mode ?>&num=<?= $num ?>"><?= $subject ?></a></span>
							<span class="col3"><?= $msg_name ?>(<?= $msg_id ?>)</span>
							<span class="col4"><?= $regist_day ?></span>
						</li>

					<?php
						$page_start--;
					} // end of for
					mysqli_close($con);
					?>

				</ul> 
				<!-- end of 쪽지 목록 ----------------------------------------------------------------------------->

				<!-- 페이지 하단 번호 목록 ------------------------------------------------------------------------>
				<ul id="page_num">

					<?php

					// 전체페이지가 2 이상, 현재페이지가 2 이상일 때 // 이전 버튼 표시 (현재 페이지 - 1)
					if ($total_page >= 2 && $page >= 2) {
						$new_page = $page - 1;

						// mode, page // GET방식
						echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전 &nbsp</a> </li>";

					} else {
						echo "<li>&nbsp;</li>";
					}

					// 페이지 번호 링크 1 ~ 전체페이지
					for ($i = 1; $i <= $total_page; $i++) {

						// 현재 페이지 번호 링크 안함
						if ($page == $i) {
							echo "<li><b> &nbsp $i &nbsp </b></li>";

						} else {
							// mode, page // GET방식
							echo "<li> <a href='message_box.php?mode=$mode&page=$i'> &nbsp $i &nbsp </a> <li>";
						}
					}

					// 전체페이지가 2 이상, 현재페이지가 마지막 페이지가 아닐 때 // 다음 버튼 표시 (현재 페이지 + 1)
					if ($total_page >= 2 && $page != $total_page) {
						$new_page = $page + 1;

						// mode, page // GET방식
						echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'> &nbsp 다음 ▶</a> </li>";
						
					} else
						echo "<li>&nbsp;</li>";
					?>
				</ul>

				<!-- <ul class="buttons"> -->

					<!-- // mode // GET방식 -->
					<!-- <li><button onclick="location.href='message_box.php?mode=rv'">받은 쪽지함</button></li>
					<li><button onclick="location.href='message_box.php?mode=send'">보낸 쪽지함</button></li>
			
					<li><button onclick="location.href='message_form.php'">쪽지 보내기</button></li> -->
				<!-- </ul> -->

			</div>
	</section>

	<footer>
		<?php include "footer.php"; ?>
	</footer>

</body>

</html>