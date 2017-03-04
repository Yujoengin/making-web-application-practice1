<?php
// <!-- ▽간단하게 아래코드의 아래 4줄의 코드로 표현할 수 있으나, 데이터의 양이 많아질경우 아래와 같이 표현해야 수정에 용이하다. -->
// <!--php
// // require("../config/config.php"); means this! ↓
// $config = array(
//   "host"=>"localhost",
//   "duser"=>"root",
//   "dpw"=>"yujoengin",
//   "dname"=>"opentutorials"
// );
// // require("../lib/db.php"); means this! ↓
// function db_init($host, $duser, $dpw, $dname){
//   $conn = mysqli_connect($host,$duser,$dpw);
//   mysqli_select_db($conn, $dname);
//   return $conn;
// }
// $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
// $result = mysqli_query($conn,'SELECT * FROM topic');
// -->
  $conn = mysqli_connect('localhost', 'root', 'yujoengin');
  mysqli_select_db($conn, 'opentutorials2');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
      <h1>Joengin's blog</h1>
    </header>
    <nav>
      <ol>
        <?php
          $sql  = 'SELECT * FROM `topic`';
          $result = mysqli_query($conn, $sql);
          // mysqli_fetch_assoc() -> php가 알아먹을수 있는 데이터로 가공하는 함수. 이것은 실행될때 행을 하나씩 돌려준다. 더이상 가져올 데이터가 없을때 NULL이 리턴된다.
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<li><a href="index.php?id='.$row['id'].'">'.$row['title'].'</a></li>';
          }
        ?>
      </ol>
    </nav>
    <article>
      <?php
        $id = mysqli_real_escape_string($conn,$_GET['id']); //mysqli_real_escape_string() <- 보안상의 이유.
        $sql = "SELECT * FROM topic WHERE id =".$id;
        $sql  = 'SELECT topic.id, topic.title, topic.description, user.name, topic.created FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id ='.$id;

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '<h2>'.htmlspecialchars($row['title'])."</h2>";
        echo '<div>'.htmlspecialchars($row['description']).'</div>';
        echo '<div>'.htmlspecialchars($row['name']).' | '.htmlspecialchars($row['created']).'</div>';
      ?>
      <h2></h2>
    </article>
  </body>
</html>
