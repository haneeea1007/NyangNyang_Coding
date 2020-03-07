<script>
  alert("로그아웃이 완료되었습니다.");
</script>


<?php

  // session =============================
  // 세션 unset 

  session_start();
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  unset($_SESSION["userlevel"]);
  unset($_SESSION["userpoint"]);

  // session =============================
  
  echo("
       <script>
          location.href = 'index.php';
         </script>
       ");
?>