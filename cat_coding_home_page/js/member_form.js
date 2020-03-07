// 모든 자료 로드 후, 자동 실행
// 아이디 중복검사 스팬
$(document).ready(function () {

    var registId = $("#registId"),
        spanCheckId = $("#spanCheckId");

    registId.blur(function () {

        var idValue = registId.val();
        var exp = /^[a-zA-Z0-9]{5,10}$/;

        if (idValue === "") {
            spanCheckId.html("<span style='color:orange'>아이디를 입력해 주세요.</span>");
        
        } else if (!exp.test(idValue)) {
            spanCheckId.html("<span style='color:orange'>영문 / 숫자 5~10자리 입력</span>");

        } else {
            
            $.ajax({

                type: 'POST',
                url: './member_checkId.php',
                data: {"registId": idValue},
                success: function (data) {

                    if (data === "1") {
                        spanCheckId.html("<span style='color:orange'>중복된 아이디 입니다.</span>");

                    } else if (data === "0") {
                        spanCheckId.html("");

                    } else {
                        spanCheckId.html("<span style='color:orange'>에러가 발생했습니다.</span>");
                    }
                }
            });
        }

    });
});