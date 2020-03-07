<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>냥냥코딩</title>

    <link rel="stylesheet" href="./css/member.css">
    <link rel="stylesheet" href="./css/cat_regist.css">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <script src="./js/cat_regist.js?ver=2"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/member_form.js"></script>

    <script>

        // 아이디 중복 체크 창 열기
        function check_id() {
            window.open("member_check_id.php?id=" + document.member_form.registId.value,
            "IDcheck", "left=700, top=300, width=320, height=150, scrollbars=no, resizable=yes");
        }

    </script>

</head>

<body onload="setBirthdaySelect();">
    <!-- header -->
    <header>
        <?php include "header.php"; ?>
    </header>

    <!-- section -->
    <section id="section_join">

        <!-- <div id="main_img_bar">
            <img src="./img/main_img.png">
        </div> -->

        <div id="main_content">

            <div id="div-regist">

                <!-- header -->
                <div id="regist-header">
                    <img src="./img/cat.png" alt="cat" width="100px" height="80px">
                    <span id="regist-text">회 원 가 입</span>
                </div>

                <!-- start of form -->
                <form name="member_form" action="./member_insert.php" method="POST">

                    <div id="input-content">

                        <!-- 아이디 입력 및 체크 -->
                        <div class="div-input-content">
                            <span class="span-content">아이디</span>
                            <input placeholder="영문 / 숫자 5~10자리" type="text" name="registId" id="registId">
                            <span id="spanCheckId"></span>
                            <button type="button" id="buttonIdCheck" onclick="check_id();">중복확인</button>
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
                            <input placeholder="한글 2~6자리" type="text" name="registName" id="registName" onkeyup="checkName();">
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
                            <input placeholder="ex) haneeea@naver.com" type="text" name="registEmail" id="registEmail" onkeyup="checkEmail();">
                            <span id="spanCheckEmail"></span>
                        </div>

                        <!-- 이메일 수신 동의 체크박스 -->
                        <div>
                            <div id="div-recive-permission">
                                <input class="recivePermission" name="email_checkbox" type="checkbox" value="Y">
                                <span id="recivePermissionSpan">e-mail 수신 동의</span>
                            </div>
                        </div>

                        <!-- 휴대폰 번호 입력 및 체크 -->
                        <div class="div-input-content">
                            <span class="span-content">휴대폰 번호</span>
                            <input placeholder="- 없이 입력" type="text" name="registPhone" id="registPhone" onkeyup="checkPhone();">
                            <span id="spanCheckPhone"></span>
                        </div>

                        <!-- sms 수신 동의 체크박스 -->
                        <div>
                            <div id="div-recive-permission">
                                <input class="recivePermission" name="sms_checkbox" type="checkbox" value="Y">
                                <span id="recivePermissionSpan">sms 수신 동의</span>
                            </div>
                        </div>

                        <!-- 우편번호 입력 및 체크 / 검색 버튼 // 웹서버가 없어서 실행X -->
                        <div class="div-input-content">
                            <span class="span-content">우편번호</span>
                            <input placeholder="ex) 00000" type="text" name="registAddressNumber" id="registAddressNumber" onkeyup="checkAddressNumber();">
                            <span id="spanCheckAddressNumber"></span>
                            <button type="button" id="buttonAddressSearch" onclick="openZipSearch();">우편번호 검색</button>
                        </div>

                        <!-- 주소 입력 및 체크 -->
                        <div class="div-input-content">
                            <span class="span-content">주소</span>
                            <input placeholder="상세주소 입력" type="text" name="registAddress" id="registAddress" onkeyup="checkAddress();">
                            <span id="spanCheckAddress"></span>
                        </div>

                        <!-- 반려동물 선택 라디오버튼 -->
                        <div class="div-input-content">
                            <span class="span-content">반려동물</span>
                            <input type="radio" name="animal" class="radioAnimal" value="고양이" checked><label class="radioLabel">고양이</label>
                            <input type="radio" name="animal" class="radioAnimal" value="강아지"><label class="radioLabel">강아지</label>
                            <input type="radio" name="animal" class="radioAnimal" value="토끼"><label class="radioLabel">토끼</label>
                            <input type="radio" name="animal" class="radioAnimal" value="그 외 동물"><label class="radioLabel">그 외 동물</label>
                        </div>

                        <!-- 개인정보 수집 및 이용 테이블 -->
                        <div id="divPermissionTable">
                            <p>* 개인정보 수집 및 이용</p>
                            <table border="1">
                                <tr>
                                    <td>구분</td>
                                    <td>목적</td>
                                    <td>항목</td>
                                    <td>보유 및 이용기간</td>
                                </tr>

                                <tr>
                                    <td>선택</td>
                                    <td>맞춤 정보 제공, 마케팅</td>
                                    <td>반려동물, 생년월일</td>
                                    <td>회원탈퇴 후 5일까지</td>
                                </tr>
                            </table>
                        </div>

                        <!-- 이용약관 동의 체크박스 -->
                        <div>
                            <input id="registPermission" type="checkbox">이용약관에 모두 동의합니다.
                            <button type="button" id="buttonPopup" onclick="buttonShowPopup();">내용보기</button>
                        </div>

                        <!-- 이용약관 상세정보 팝업창 -->
                        <div id="divPermissionPopup" style="display: none; z-index: 1; position: absolute; top: 440px; left: 210px; width: 570px; height: 450px; background-color: white; border: 2px solid lightgray; border-radius: 20px;">
                            <img src="./img/boreea.jpg" alt="boree" width="250px" height="250px" style="border-radius: 20px;">
                            <span>회원가입을 하시려면 아래 항목에 동의하셔야 합니다.<br>
                                <b>이 고양이가 귀엽다는 것에 동의하십니까?</b></span>
                            <input id="permissionCheck" type="checkbox">동의합니다.
                            <button id="button-close" type="button" onclick="buttonClose();">닫기</button>
                        </div>

                        <!-- 회원가입 완료 버튼 -->
                        <input type="button" id="button-regist" onclick="buttonRegist();" value="회원가입">

                    </div>
                </form>
                <!-- end of form -->
            </div>

        </div>
        <!-- end of div main_content -->

    </section>

    <!-- footer -->
    <footer>
        <?php include "footer.php"; ?>
    </footer>

</body>

</html>