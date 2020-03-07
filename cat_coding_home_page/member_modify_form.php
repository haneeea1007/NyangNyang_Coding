<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>냥냥코딩</title>

	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/member.css">
	<link rel="stylesheet" href="./css/cat_regist.css">
	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

	<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="./js/cat_regist.js"></script>

</head>

<body onload="setBirthdaySelect();">

	<header>
		<?php include "header.php"; ?>
	</header>

	<!-- DB에서 회원정보 가져오기 -->
	<?php
	$con = mysqli_connect("127.0.0.1", "root", "123456", "test");
	$sql = "select * from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$pass = $row["pass"];
	$name = $row["name"];
	$email = $row["email"];
	$phone = $row["phone"];
	$addnum = $row["addnum"];
	$address = $row["address"];
	$animal = $row["animal"];
	$email_check = $row["email_check"];
	$sms_check = $row["sms_check"];
	
	// 라디오 값 셋팅하기
	$selectAnimal = array("", "", "", "");

	switch ($animal) {

		case "고양이":
			$selectAnimal[0] = "checked";
			break;

		case "강아지":
			$selectAnimal[1] = "checked";
			break;

		case "토끼":
			$selectAnimal[2] = "checked";
			break;

		default:
			$selectAnimal[3] = "checked";
			break;
	}

	// 동의 체크박스 값 셋팅하기
	if ($email_check === "Y") {
		$selectEmailCheck = "checked";
	} else {
		$selectEmailCheck = "";
	}

	if ($sms_check === "Y") {
		$selectSMSCheck = "checked";
	} else {
		$selectSMSCheck = "";
	}

	mysqli_close($con);

	?>

	<section id="section_info">
		<div id="main_content_modify">
			<div id="div-regist">

				<!-- header -->
				<div id="regist-header">
					<img src="./img/cat.png" alt="cat" width="100px" height="80px">
					<span id="regist-text">My Page</span>
				</div>

				<!-- start of form -->
				<!-- member_modify.php // id // GET방식 전달 -->
				<form name="member_form" method="post" action="member_modify.php?id=<?= $userid ?>">

					<div id="input-content">

						<!-- 아이디 입력 및 체크 -->
						<div class="div-input-content">
							<span class="span-content">아이디</span>
							<input type="text" name="registId" id="registId" value="<?= $userid ?>" disabled>
							<span id="spanCheckId"></span>
							<!-- <button type="button" id="buttonIdCheck" onclick="check_id();">중복확인</button> -->
						</div>

						<!-- 비밀번호 입력 및 체크 -->
						<div class="div-input-content">
							<span class="span-content">비밀번호</span>
							<input placeholder="영문 / 숫자 / 특수문자 8~12자리" type="password" name="registPassword1" id="registPassword1" onkeyup="checkPassword1();">
							<span id="spanCheckPassword1"></span>
						</div>

						<!-- 비밀번호 재입력 -->
						<div class="div-input-content">
							<span class="span-content">비밀번호 확인</span>
							<input placeholder="비밀번호 다시 입력" type="password" name="registPassword2" id="registPassword2" onkeyup="checkPassword2();">
							<span id="spanCheckPassword2"></span>
						</div>

						<!-- 이름 입력 및 체크 -->
						<div class="div-input-content">
							<span class="span-content">이름</span>
							<input type="text" name="registName" id="registName" onkeyup="checkName();" value="<?= $name ?>">
							<span id="spanCheckName"></span>
						</div>

						<!-- 생년월일 선택 -->
						<div class="div-input-content">
							<span class="span-content">생년월일</span>
							<select name="selectBirthYear" id="selectBirthYear"></select>
							<select name="selectBirthMonth" id="selectBirthMonth" onchange="setDaySelect();"></select>
							<select name="selectBirthDay" id="selectBirthDay"></select>
							<span id="spanCheckName"></span>
						</div>

						<!-- 이메일 입력 및 체크 -->
						<div class="div-input-content">
							<span class="span-content">e-mail</span>
							<input type="text" name="registEmail" id="registEmail" onkeyup="checkEmail();" value="<?= $email ?>">
							<span id="spanCheckEmail"></span>
						</div>

						<!-- 이메일 수신 동의 체크박스 -->
						<div>
							<div id="div-recive-permission">
								<input class="recivePermission" name="email_checkbox" type="checkbox" value="Y" <?=$selectEmailCheck?>>
								<span id="recivePermissionSpan">e-mail 수신 동의</span>
							</div>
						</div>

						<!-- 휴대폰 번호 입력 및 체크 -->
						<div class="div-input-content">
							<span class="span-content">휴대폰 번호</span>
							<input type="text" name="registPhone" id="registPhone" onkeyup="checkPhone();" value="<?= $phone ?>">
							<span id="spanCheckPhone"></span>
						</div>

						<!-- sms 수신 동의 체크박스 -->
						<div>
							<div id="div-recive-permission">
								<input class="recivePermission" name="sms_checkbox" type="checkbox" value="Y" <?=$selectSMSCheck?>>
								<span id="recivePermissionSpan">sms 수신 동의</span>
							</div>
						</div>

						<!-- 우편번호 입력 및 체크 / 검색 버튼 -->
						<div class="div-input-content">
							<span class="span-content">우편번호</span>
							<input type="text" name="registAddressNumber" id="registAddressNumber" onkeyup="checkAddressNumber();" value="<?= $addnum ?>">
							<span id="spanCheckAddressNumber"></span>
							<button type="button" id="buttonAddressSearch" onclick="openZipSearch();">우편번호 검색</button>
						</div>

						<!-- 주소 입력 및 체크 -->
						<div class="div-input-content">
							<span class="span-content">주소</span>
							<input type="text" name="registAddress" id="registAddress" onkeyup="checkAddress();" value="<?= $address ?>">
							<span id="spanCheckAddress"></span>
						</div>

						<!-- 반려동물 선택 라디오버튼 -->
						<div class="div-input-content">
							<span class="span-content">반려동물</span>
							<input type="radio" name="animal" class="radioAnimal" value="고양이" <?= $selectAnimal[0] ?>><label class="radioLabel">고양이</label>
							<input type="radio" name="animal" class="radioAnimal" value="강아지" <?= $selectAnimal[1] ?>><label class="radioLabel">강아지</label>
							<input type="radio" name="animal" class="radioAnimal" value="토끼" <?= $selectAnimal[2] ?>><label class="radioLabel">토끼</label>
							<input type="radio" name="animal" class="radioAnimal" value="그 외 동물" <?= $selectAnimal[3] ?>><label class="radioLabel">그 외 동물</label>
						</div>

						<!-- 수정 완료 버튼 -->
						<input type="button" id="button-regist" onclick="buttonModify();" value="수정완료">

					</div>
				</form> <!-- end of form -->
			</div>
		</div> <!-- main_content -->

	</section>

	<footer>
		<?php include "footer.php"; ?>
	</footer>

</body>

</html>