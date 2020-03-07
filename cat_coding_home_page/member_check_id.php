<!-- 아이디 중복검사 팝업창 -->
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title></title>

   <style>
      h3 {
         padding-left: 30px;
         /* border-left: 5px solid #edbf07; */
      }

      .close {
         margin: 20px 0 0 80px;
         cursor: pointer;
      }

      li {
         font-size: 13px;
      }
   </style>

</head>

<body>

   <h5>[ 아이디 중복 확인 ]</h5>
   <p>

      <?php

      $id = $_GET["id"];

      if (!$id) {
         echo "<li>아이디를 입력해 주세요.</li>";

      } else {
         $con = mysqli_connect("127.0.0.1", "root", "123456", "test");

         $sql = "select * from members where id= '$id'";
         $result = mysqli_query($con, $sql);
         $num_record = mysqli_num_rows($result);

         if ($num_record) {
            echo "<li>".$id." 이미 존재하는 아이디 입니다.</li>";
            echo "<li>다른 아이디를 입력해 주세요.</li>";

         } else {
            echo "<li>".$id." 사용 가능한 아이디 입니다.";
         }

         mysqli_close($con);
      }

      ?>

   </p>
   <div class="close">
      <img src="./img/close.png" onclick="javascript:self.close();">
   </div>

</body>

</html>