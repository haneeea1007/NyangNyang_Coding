<?php
  $id = $_POST["registId"];

  $con = mysqli_connect("127.0.0.1", "root", "123456", "test");
  $sql = "select * from members where id = '$id'";

  $result = mysqli_query($con, $sql);
  $result_record = mysqli_num_rows($result);

  if ($result_record) {
     echo "1";
  } else {
     echo "0";
  }

  mysqli_close($con);

 ?>
