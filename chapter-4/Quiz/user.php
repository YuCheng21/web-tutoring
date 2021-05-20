<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <title>操作介面</title>
  <style>
        body {
            background-color: #99C7CB;
        }

        .primary-color {
            color: #4CAF50;
        }

        .primary-bgcolor {
            background-color: #4CAF50;
        }

        .primary-bgcolor:hover {
            background-color: #FF9800;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 15px 1px #444444;
        }

        .card:hover {
            box-shadow: 0 4px 20px 2px #444444;
        }

        .card-header {
            border-radius: 10px !important;
            background-color: #4CAF50;
        }

        li {
            font-size: 20px;
        }
        .result_msg{
          color: red;
          font-size: 20px;
          margin: 20px;
        }
    </style>
</head>
<body>
<?php
session_start();
header("Cache-Control: no cache");

if(!isset($_SESSION['stu_id'])){
  header("Location: index.php");
  exit();
}
$stu_id = $_SESSION['stu_id'];

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("資料庫連線錯誤");
}

$query = "SELECT stu_id,cls_name,cls_year,stu_name FROM student AS std, class AS cls WHERE cls.cls_id=std.cls_id AND stu_id=$stu_id";
$result = $conn->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$cls_name = $row["cls_name"];
$cls_year = $row["cls_year"];
$stu_name = $row["stu_name"];

echo <<<EOF
    <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-12">
        <form method="post" class="mt-3">
          <button class="btn primary-bgcolor" type="submit" name="logout"><i
              class="fas fa-chevron-circle-left mr-1"></i>登出返回首頁</button>
          <button class="btn primary-bgcolor" type="submit" name="search"><i
              class="fas fa-search mr-1"></i>查詢已選課程</button>
        </form>
        <div class="card text-center mt-4 mb-5">
          <div class="card-header ">
            <h2>個人資料</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-md-6">
                <li>學號 : $stu_id</li>
              </div>
              <div class="col-lg-3 col-md-6">
                <li>班級 : $cls_name</li>
              </div>
              <div class="col-lg-3 col-md-6">
                <li>入學年 : $cls_year</li>
              </div>
              <div class="col-lg-3 col-md-6">
                <li>姓名 : $stu_name</li>
              </div>
            </div>
          </div>
        </div>
    EOF;

if (isset($_POST['logout'])) {
    unset($_SESSION['stu_id']);
    header("Location: index.php");
}

if (isset($_POST['search'])) {
    session_start();
    $_SESSION['stu_id'] = $stu_id;
    $_SESSION['cls_name'] = $cls_name;
    $_SESSION['cls_year'] = $cls_year;
    $_SESSION['stu_name'] = $stu_name;
    header("Location: search.php");
}

echo <<<_END
    <div class="card text-center mt-4 mb-5">
    <div class="card-header mb-3">
      <h2>課程總表</h2>
    </div>
    _END;

if (isset($_POST['add'])) {
    $course_id = $_POST["course_id"];
    $query = "INSERT INTO selection (stu_id, course_id) VALUES ($stu_id, $course_id)";
    if (!$conn->query($query)) {
      $result_msg = "課程代碼錯誤或重複選課 !";
    } else {
      $result_msg = "新增課程成功 !";
    }
    echo <<<EOF
      <script>
        $(document).ready(function () {
            $(".toast#liveToast").toast('show');
        });
      </script>
    EOF;
}

if (isset($_POST['del'])) {
    $course_id = $_POST["course_id"];
    $query = "DELETE FROM selection WHERE stu_id = $stu_id AND course_id = $course_id";
    if (!$conn->query($query)) {
      $result_msg = "課程代碼錯誤 !";
    } else {
      $result_msg = "刪除課程成功 !";
    }
    echo <<<EOF
    <script>
      $(document).ready(function () {
          $(".toast#liveToast").toast('show');
      });
    </script>
    EOF;
}
echo <<<_END
    <div class="card-body">
      <form method="post" class="mb-3">
        <div class="input-group input-group-lg">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-barcode mr-1"></i><b>課程代碼</b></span>
          </div>
          <input type="text" class="form-control" name="course_id" placeholder="請輸入課程代碼">
          <div class="input-group-append">
            <button class="btn primary-bgcolor border-dark" type="submit" name="add"><i
                class="fas fa-plus mr-1"></i>新增課程</button>
            <button class="btn primary-bgcolor border-dark" type="submit" name="del"><i
                class="fas fa-trash-alt mr-1"></i>刪除課程</button>
          </div>
        </div>
      </form>

      <table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr>
            <th>課程代碼</th>
            <th>課程名稱</th>
            <th>學分數</th>
          </tr>
    _END;

$query = "SELECT * FROM course";
$result = $conn->query($query);
if (!$result) {
    die("資料庫詢問錯誤");
}

$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $r0 = htmlspecialchars($row["course_id"]);
    $r1 = htmlspecialchars($row["course_name"]);
    $r2 = htmlspecialchars($row["course_score"]);
    echo "<tr><td>$r0</td><td>$r1</td><td>$r2</td></tr>";
}

echo <<<_END
        </tbody>
        </table>
      </div>
    _END;

$result->close();
$conn->close();
echo <<<EOF
  <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
        data-delay="5000">
        <div class="toast-header">
            <i class="fas fa-exclamation-circle mr-1"></i>
            <strong class="mr-auto">訊息</strong>
            <small>剛剛</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" style="width: 200px;">
            $result_msg
        </div>
    </div>
  </div>
EOF;
?>
  </body>
</html>