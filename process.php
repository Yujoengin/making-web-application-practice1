<?php
  //데이터베이스 접속
  $conn = mysqli_connect('localhost', 'root', 'yujoengin');
  mysqli_select_db($conn, 'opentutorials2');
  //작성자가 user테이블에 존재하는지 여부를 체크
  $sql = "SELECT * FROM `user` WHERE `name` = '".mysqli_real_escape_string($conn,$_POST['name'])."'";
  $result = mysqli_query($conn,$sql);
  var_dump($result);
  if($result->num_rows > 0) {//존재한다면 user.id를 알아낸다.
    $row=mysqli_fetch_assoc($result);
    var_dump($row);
  }
  else {//존재하지 않다면 저자를 user 추가 후 id를 알아낸다.

  }


  //제목, 저자, 본문 등을 topic 테이블에 추가
?>
