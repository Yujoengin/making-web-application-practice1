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
    <title>BLOG</title>
    <style media="screen">
      body{
        margin: 0;
      }
      body.black{
        background-color: black;
        color: white;
      }
      body.white{
        background-color: white;
        color: black;
      }
      header{
        border-bottom: 1px solid grey;
      }
      header h1{
        margin-left: 20px;
      }
      #content{
        padding-left: 0px;
        margin-left: 217px;
        margin-right: 10px;
      }
      nav{
        width: 200px;
        height: 700px;
        border-right: 1px solid grey;
        float: left;
      }
      nav ol{
        margin:0px;
        padding: 20px;
        list-style: none;
      }
      nav ol li{
        padding-bottom: 5px;
      }
    </style>
  </head>
  <body id="body">
    <header>
      <h1><a href="index.php">Joengin's blog</a></h1>
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
    <div id="content">
      <article>
        <form class="" action="process.php" method="post">
          <p>
            제목 : <input type="text" name="title" value=""><br />
          </p>
          <p>
            이름 : <input type="text" name="name" value=""><br />
          </p>
          <p>
            본문 : <textarea name="description" value="" rows="8" cols="40"></textarea><br />
          </p>
          <p>
            <input type="submit" name="submit" value="전송">
          </p>
        </form>

        <?php
        ?>
      </article>
      <input type="button" name="name" value="White" onclick="btn_white()">
      <input type="button" name="name" value="Black" onclick="btn_black()">
      <a href="write.php">쓰기</a>
    </div>
    <script type="text/javascript">
      function btn_white() {
        document.getElementById("body").className = "white";
      }
      function btn_black() {
        document.getElementById("body").className = "black";
      }
    </script>
  </body>
</html>
