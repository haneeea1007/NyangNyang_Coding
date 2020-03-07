<?php

    // member_modify_form.php // id // GET방식 전달
    $id = $_GET["id"];

    // member_modify_from.php // member_form // submit 전달
    $pass = $_POST["registPassword1"];
    $name = $_POST["registName"];
    $email = $_POST["registEmail"];
    $phone = $_POST["registPhone"];
    $addnum = $_POST["registAddressNumber"];
    $address = $_POST["registAddress"];
    $animal = $_POST["animal"];

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
          
    $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
    $sql = "update members set pass='$pass', name='$name', email='$email', birth='$birth', phone='$phone', addnum='$addnum', address='$address', animal='$animal', email_check='$email_check', sms_check='$sms_check'";
    $sql .= " where id='$id'";

    mysqli_query($con, $sql);
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
