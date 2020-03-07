
// 아이디 체크
function checkId() {

    var regExp = /^[a-z0-9]{5,10}$/;
    var registId = document.getElementById("registId").value;

    if (regExp.test(registId) === false) {
        document.getElementById("spanCheckId").innerHTML = "영문 / 숫자 5~10자리 입력";
    } else {
        document.getElementById("spanCheckId").innerHTML = "";
    }

}

// 비밀번호 체크
function checkPassword1() {

    var regExp = /^(?=.*[\w])(?=.*[~!@#$%^&*()-_=+]).{8,12}$/;
    var registPassword1 = document.getElementById("registPassword1").value;

    if (regExp.test(registPassword1) === false) {
        document.getElementById("spanCheckPassword1").innerHTML = "영문 / 숫자 / 특수문자 8~12자리 입력";
    } else {
        document.getElementById("spanCheckPassword1").innerHTML = "";
    }

}

// 비밀번호 재입력 체크
function checkPassword2() {

    var registPassword1 = document.getElementById("registPassword1").value;
    var registPassword2 = document.getElementById("registPassword2").value;

    if (registPassword1 !== registPassword2) {
        document.getElementById("spanCheckPassword2").innerHTML = "비밀번호가 일치하지 않습니다.";
    } else {
        document.getElementById("spanCheckPassword2").innerHTML = "";
    }

}

// 이름 체크
function checkName() {

    var regExp = /^[가-힣]{2,6}$/;
    var registName = document.getElementById("registName").value;

    if (regExp.test(registName) === false) {
        document.getElementById("spanCheckName").innerHTML = "한글 2~6자리 입력";
    } else {
        document.getElementById("spanCheckName").innerHTML = "";
    }

}

// 이메일 체크
function checkEmail() {

    var regExp = /^[a-z0-9]+@[a-z]+\.[a-z]+$/;
    var registEmail = document.getElementById("registEmail").value;

    if (regExp.test(registEmail) === false) {
        document.getElementById("spanCheckEmail").innerHTML = "이메일이 올바르지 않습니다.";
    } else {
        document.getElementById("spanCheckEmail").innerHTML = "";
    }

}

// 전화번호 체크
function checkPhone() {

    var regExp = /^([0-9]{3})([0-9]{4})([0-9]{4})$/;
    var registPhone = document.getElementById("registPhone").value;

    if (regExp.test(registPhone) === false) {
        document.getElementById("spanCheckPhone").innerHTML = "휴대폰 번호가 올바르지 않습니다.";
    } else {
        document.getElementById("spanCheckPhone").innerHTML = "";
    }

}

// 우편번호 찾기 팝업
function openZipSearch() {

    new daum.Postcode({

        oncomplete: function (data) {
            document.getElementById("registAddressNumber").value = data.zonecode;
            document.getElementById("registAddress").value = data.address;
            // $('[name=addr2]').val(data.buildingName);
        }

    }).open();

}

// 우편번호 체크
function checkAddressNumber() {

    var regExp = /^[0-9]{5}$/;
    var registAddress = document.getElementById("registAddressNumber").value;

    if (regExp.test(registAddress) === false) {
        document.getElementById("spanCheckAddressNumber").innerHTML = "우편번호가 올바르지 않습니다.";
    } else {
        document.getElementById("spanCheckAddressNumber").innerHTML = "";
    }

}

// 주소 체크
function checkAddress() {

    var regExp = /^[\w\s가-힣-]+$/;
    var registAddress = document.getElementById("registAddress").value;

    if (regExp.test(registAddress) === false) {
        document.getElementById("spanCheckAddress").innerHTML = "주소가 올바르지 않습니다.";
    } else {
        document.getElementById("spanCheckAddress").innerHTML = "";
    }

}

// 회원가입 완료 버튼을 눌렀을 때 이벤트
function buttonRegist() {

    var registCheck = document.getElementById("registPermission");

    if (document.getElementById("spanCheckId").innerHTML === "" &&
        document.getElementById("spanCheckPassword1").innerHTML === "" &&
        document.getElementById("spanCheckPassword2").innerHTML === "" &&
        document.getElementById("spanCheckName").innerHTML === "" &&
        document.getElementById("selectBirthYear").value !== "년" &&
        document.getElementById("selectBirthMonth").value !== "월" &&
        document.getElementById("selectBirthDay").value !== "일" &&
        document.getElementById("spanCheckEmail").innerHTML === "" &&
        document.getElementById("spanCheckPhone").innerHTML === "" &&
        document.getElementById("spanCheckAddress").innerHTML === "" &&
        document.getElementById("registId").value !== "" &&
        document.getElementById("registPassword1").value !== "" &&
        document.getElementById("registPassword2").value !== "" &&
        document.getElementById("registName").value !== "" &&
        document.getElementById("registEmail").value !== "" &&
        document.getElementById("registPhone").value !== "" &&
        document.getElementById("registAddressNumber").value !== "" &&
        document.getElementById("registAddress").value !== "") {

        if (registCheck.checked === false) {
            alert("이용약관에 동의해주세요.");

        } else {
            alert("회원가입이 완료되었습니다.");
            // location.href = "./cat_login.html";
            document.member_form.submit();

        }

    } else {
        alert("입력 정보 중 올바르지 않은 항목이 있습니다.");
    }
}

// 이용약관 동의 팝업 닫기
function buttonClose() {
    var popup = document.getElementById("divPermissionPopup");
    var popupCheck = document.getElementById("permissionCheck");
    var registCheck = document.getElementById("registPermission");

    if (popupCheck.checked === true) {
        registCheck.checked = true;
        popup.style.display = 'none';
    } else {
        alert("반드시 약관에 동의하셔야 합니다.");
    }
}

// 이용약관 동의 팝업 보여주기
function buttonShowPopup() {
    var popup = document.getElementById("divPermissionPopup");
    popup.style.display = 'block';
}

// 생년월일 셋팅
function setBirthdaySelect() {

    var yearOption = document.getElementById("selectBirthYear");
    var monthOption = document.getElementById("selectBirthMonth");
    var dayOption = document.getElementById("selectBirthDay");
    var creatOption = null;

    for (var i = 2021; i >= 1906; i--) {

        creatOption = document.createElement("option");
        
        if (i === 2021) {
            creatOption.innerHTML = "년";
            yearOption.appendChild(creatOption);

        } else {
        creatOption.value = i.toString();
        creatOption.innerHTML = i.toString() + "년";
        yearOption.appendChild(creatOption);
        }
    }
    for (var i = 0; i <= 12; i++) {
        
        creatOption = document.createElement("option"); 
        
        if (i >= 1 && i <= 9) {
            i = "0" + i.toString();
        }

        if (i === 0) {
            creatOption.innerHTML = "월";
            monthOption.appendChild(creatOption);

        } else {
            creatOption.value = i.toString();
            creatOption.innerHTML = i.toString() + "월";
            monthOption.appendChild(creatOption);
        }
    }
    for (var i = 0; i <= 31; i++) {
        
        creatOption = document.createElement("option");

        if (i >= 1 && i <= 9) {
            i = "0" + i.toString();
        }

        if (i === 0) {
            creatOption.innerHTML = "일";
            dayOption.appendChild(creatOption);

        } else {
            creatOption.value = i.toString();
            creatOption.innerHTML = i.toString() + "일";
            dayOption.appendChild(creatOption);
        }
    }
}

// 달마다 달라지는 일수 셋팅
function setDaySelect() {

    var monthOption = document.getElementById("selectBirthMonth");
    var dayOption = document.getElementById("selectBirthDay");
    var creatOption = null;

    while (dayOption.hasChildNodes()) {
        dayOption.removeChild(dayOption.childNodes[0]);
    }

    switch (monthOption.selectedIndex.valueOf() + 1) {

        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:

            for (var i = 1; i <= 31; i++) {
                creatOption = document.createElement("option");

                if (i >= 1 && i <= 9) {
                    i = "0" + i.toString();
                }

                creatOption.value = i.toString();
                creatOption.innerHTML = i.toString() + "일";
                dayOption.appendChild(creatOption);
            }

            break;

        case 2:

            for (var i = 1; i <= 29; i++) {
                creatOption = document.createElement("option");

                if (i >= 1 && i <= 9) {
                    i = "0" + i.toString();
                }

                creatOption.value = i.toString();
                creatOption.innerHTML = i.toString() + "일";
                dayOption.appendChild(creatOption);
            }

            break;

        default:

            for (var i = 1; i <= 30; i++) {
                creatOption = document.createElement("option");

                if (i >= 1 && i <= 9) {
                    i = "0" + i.toString();
                }
                
                creatOption.value = i.toString();
                creatOption.innerHTML = i.toString() + "일";
                dayOption.appendChild(creatOption);
            }

            break;
    }
}

// 회원정보 수정 완료 버튼을 눌렀을 때 이벤트
function buttonModify() {

    var registCheck = document.getElementById("registPermission");

    if (document.getElementById("spanCheckPassword1").innerHTML === "" &&
        document.getElementById("spanCheckPassword2").innerHTML === "" &&
        document.getElementById("spanCheckName").innerHTML === "" &&
        document.getElementById("spanCheckEmail").innerHTML === "" &&
        document.getElementById("spanCheckPhone").innerHTML === "" &&
        document.getElementById("spanCheckAddress").innerHTML === "" &&
        document.getElementById("registPassword1").value !== "" &&
        document.getElementById("registPassword2").value !== "" &&
        document.getElementById("registName").value !== "" &&
        document.getElementById("selectBirthYear").value !== "년" &&
        document.getElementById("selectBirthMonth").value !== "월" &&
        document.getElementById("selectBirthDay").value !== "일" &&
        document.getElementById("registEmail").value !== "" &&
        document.getElementById("registPhone").value !== "" &&
        document.getElementById("registAddressNumber").value !== "" &&
        document.getElementById("registAddress").value !== "") {

            alert("회원정보 수정이 완료되었습니다.");
            // location.href = "./cat_login.html";
            document.member_form.submit();

    } else {
        alert("입력 정보 중 올바르지 않은 항목이 있습니다.");
    }
}