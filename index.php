<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
      zzz
    </header>
  </body>
</html>

<!-- ▽간단하게 아래코드의 아래 4줄의 코드로 표현할 수 있으나, 데이터의 양이 많아질경우 아래와 같이 표현해야 수정에 용이하다. -->
<!--php
// require("../config/config.php"); means this! ↓
$config = array(
  "host"=>"localhost",
  "duser"=>"root",
  "dpw"=>"yujoengin",
  "dname"=>"opentutorials"
);
// require("../lib/db.php"); means this! ↓
function db_init($host, $duser, $dpw, $dname){
  $conn = mysqli_connect($host,$duser,$dpw);
  mysqli_select_db($conn, $dname);
  return $conn;
}
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$result = mysqli_query($conn,'SELECT * FROM topic');
-->
<?php
  $conn = mysqli_connect('localhost', 'root', 'yujoengin');
  mysqli_select_db($conn, 'opentutorials2');
  $sql  = 'SELECT * FROM `topic`';
  $result = mysqli_query($conn, $sql);
  // mysqli_fetch_assoc() -> php가 알아먹을수 있는 데이터로 가공하는 함수. 이것은 실행될때 행을 하나씩 돌려준다. 더이상 가져올 데이터가 없을때 NULL이 리턴된다.
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<a href="index.php?id='.$row['id'].'">'.$row['title'].'</a><br />';
  }
  $id = $_GET['id'];
  $sql = "SELECT * FROM topic WHERE id =".$id;
  $sql  = 'SELECT topic.id, topic.title, topic.description, user.name, topic.created FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id ='.$id;

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo htmlspecialchars($row['title'])."<br />";
  echo htmlspecialchars($row['description'])."<br />";
  echo htmlspecialchars($row['created'])."<br />";
  echo htmlspecialchars($row['name']);
?>
