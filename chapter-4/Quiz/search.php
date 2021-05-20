<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <title>已選課程</title>
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

      .result_msg {
          color: red;
          font-size: 20px;
          margin: 20px;
      }
    </style>
</head>

<body>
    <?php
session_start();
if(!isset($_SESSION['stu_id'])){
  header("Location: home.php");
  exit();
}

$stu_id = $_SESSION['stu_id'];
$cls_name = $_SESSION['cls_name'];
$cls_year = $_SESSION['cls_year'];
$stu_name = $_SESSION['stu_name'];

echo <<<EOF
    <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-12">
        <form method="post" class="mt-3">
          <button class="btn primary-bgcolor" type="submit" name="logout"><i
              class="fas fa-chevron-circle-left mr-1"></i>返回操作頁面</button>
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
    session_start();
    $_SESSION['stu_id'] = $stu_id;
    $_SESSION['cls_name'] = $cls_name;
    $_SESSION['cls_year'] = $cls_year;
    $_SESSION['stu_name'] = $stu_name;
    header("Location: user.php");
}

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("資料庫連線錯誤");
}

$query = "SELECT course.course_id,course_name,course_score FROM selection, course WHERE selection.course_id=course.course_id AND stu_id=$stu_id";
$result = $conn->query($query);
if (!$result) {
    die("資料庫詢問錯誤");
}

echo <<<_END
    <div class="card text-center mt-4 mb-5">
    <div class="card-header mb-3">
      <h2>已選課程表單</h2>
    </div>
    <div class="card-body">

      <table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr>
            <th>課程代碼</th>
            <th>課程名稱</th>
            <th>學分數</th>
          </tr>
    _END;

$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);
    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    echo "<tr><td>$r0</td><td>$r1</td><td>$r2</td></tr>";
}
echo <<<_END
        </tbody>
        </table>
      </div>
    _END;
$result->close();
$conn->close();
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>