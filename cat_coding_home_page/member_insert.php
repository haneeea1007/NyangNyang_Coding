<?php

    $id = $_POST["registId"];
    $pass = $_POST["registPassword1"];
    $name = $_POST["registName"];
    $email = $_POST["registEmail"];
    $phone = $_POST["registPhone"];
    $addnum = $_POST["registAddressNumber"];
    $address = $_POST["registAddress"];
    $animal = $_POST["animal"];

    // checkbox POST로 넘어오는 값 
    // 체크O value 값, 체크X == NULL
    $email_check = $_POST["email_checkbox"];
    $sms_check = $_POST["sms_checkbox"];

    // 체크했을때 Y, 체크안했을때 N 값을 넣어줌
    if ($email_check === NULL) {
        $email_check = "N";
    } 

    if ($sms_check === NULL) {
        $sms_check = "N";
    } 

    $byear = $_POST["selectBirthYear"];
    $bmonth = $_POST["selectBirthMonth"];
    $bday = $_POST["selectBirthDay"];

    $birth = $byear.$bmonth.$bday;
    $regist_day = date("Y-m-d (H:i)"); // 현재 년-월-일-시-분 저장

    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");

    $sql = "insert into members(id, pass, name, birth, email, phone, addnum, address, animal, regist_day, level, point, email_check, sms_check)";
    $sql .= "values('$id', '$pass', '$name', '$birth', '$email', '$phone', '$addnum', '$address', '$animal', '$regist_day', 9, 0, '$email_check', '$sms_check')";

    mysqli_query($con, $sql); // $sql 실행
    mysqli_close($con);

    echo "
        <script>
            location.href = './index.php';
        </script>
        ";

?>