<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>냥냥코딩</title>

	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/cat_login.css">
	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

</head>

<body>
	<header>
		<?php include "header.php"; ?>
	</header>
	<section>

		<!-- <div id="main_img_bar">
			<img src="./img/main_img.png">
		</div> -->

		<div id="main_content">
			<div id="div-login">

				<div id="login-header">
					<img src="./img/cat.png" alt="cat" width="100px" height="80px">
					<span id="login-text">L O G - I N</span>
				</div>

				<!-- start of form -->
				<form name="login_form" action="./login.php" method="POST">

					<div id="div-input-id">
						<span id="span-id">아이디</span><input type="text" name="login-id" id="loginId"><br>
					</div>

					<div id="div-input-password">
						<span id="span-password">비밀번호</span><input type="password" name="login-password" id="loginPassword" onkeyup="enterkey();">
					</div>

					<input type="button" id="button-login" onclick="buttonLogin();" value="로그인" on>
					<input type="button" id="button-regist" onclick="buttonRegist();" value="회원가입">

					<input id="input-checkbox" type="checkbox">아이디 저장

					<span id="span-search"><a onclick="window.open('./cat_search_id_password.html', '_blank', 'left=520, top=200, width=500, height=430')">아이디 및 비밀번호 찾기</a></span>

				</form>
				<!-- end of form -->

			</div>

			<!-- start of script ----------------------------------------------------------------------------------->
			<script>
				// 엔터키 자동 로그인
				function enterkey() {

					if (window.event.keyCode == 13) {
						buttonLogin();
					}
				}

				// 로그인 버튼 클릭 이벤트
				function buttonLogin() {

					if (!document.login_form.loginId.value) {
						alert("아이디를 입력해 주세요");
						document.login_form.id.focus();
						return;
					}

					if (!document.login_form.loginPassword.value) {
						alert("비밀번호를 입력해 주세요");
						document.login_form.pass.focus();
						return;
					}
					document.login_form.submit();
				}

				// 회원가입 버튼 클릭 이벤트
				function buttonRegist() {
					location.href = "./member_form.php";
				}
			</script>

		</div> <!-- main_content -->
	</section>

	<footer>
		<?php include "footer.php"; ?>
	</footer>

</body>

</html>