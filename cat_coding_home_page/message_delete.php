<meta charset='utf-8'>

<?php

	// message_view.php // num, mode // GET 방식
	$num = $_GET["num"];
	$mode = $_GET["mode"];

	$con = mysqli_connect("127.0.0.1", "root", "123456", "test");
	$sql = "delete from message where num=$num";

	mysqli_query($con, $sql);
	mysqli_close($con);                // DB 연결 끊기

	if ($mode == "send") {
		$url = "message_box.php?mode=send";

	} else {
		$url = "message_box.php?mode=rv";
	}

	echo "
	<script>
		alert('삭제가 완료되었습니다.');
		location.href = '$url';
	</script>
	";
?>

  
