<?php

  // 아이디, 비밀번호 // POST 방식
  $id = $_POST["login-id"];
  $pass = $_POST["login-password"];

  $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
  $sql = "select * from members where id='$id'";

  $result = mysqli_query($con, $sql);
  $num_match = mysqli_num_rows($result);

  // 아이디 레코드 가져와서 점검하기
  if (!$num_match) {
    echo ("
            <script>
              window.alert('등록되지 않은 아이디입니다!')
              history.go(-1)
            </script>
          ");

  // 비밀번호 레코드 가져오기
  } else {
    $row = mysqli_fetch_array($result);
    $db_pass = $row["pass"];

    mysqli_close($con);

    // 비밀번호가 일치하지 않을 때
    if ($pass != $db_pass) {

      echo ("
                <script>
                  window.alert('비밀번호가 틀립니다!')
                  history.go(-1)
                </script>
            ");
      exit;
          
    // 비밀번호가 일치할 때 // 로그인 완료
    } else {

      echo "<script>
              alert('냥냥코딩에 오신 것을 환영합니다.');
            </script>";

      // session ==================================================
      // DB에서 가져온 정보를 세션에 넣어줌 // header에서 세션값 점검
      session_start();

      $_SESSION["userid"] = $row["id"];
      $_SESSION["username"] = $row["name"];
      $_SESSION["userlevel"] = $row["level"];
      $_SESSION["userpoint"] = $row["point"];

      // session ==================================================

      // 메인 페이지로 이동
      echo ("
                <script>
                  location.href = 'index.php';
                </script>
              ");
    }
  }
?>