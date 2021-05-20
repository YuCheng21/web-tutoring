<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <title>首頁</title>
    <style>
    body {
        background-image: url(https://cdn.jsdelivr.net/gh/YuCheng21/cdn-yucheng@master/blog/wallpaper/001.png);
        background-size: cover;
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

    .fa-users {
        margin: 50px;
        color: #4CAF50;
        text-shadow: 2px 2px 2px #000;
    }

    .input-group {
        margin-top: 50px;
    }

    .card {
        padding: 50px;
        background-color: rgba(0, 0, 0, 0.4);
        border-radius: 2%;
        width: 500px;
        margin: 1rem auto;
    }

    .card h1 {
        color: white;
        text-shadow: 2px 2px 2px #000;
    }

    .result_msg {
        color: red;
        font-size: 20px;
        margin: 20px;
        text-shadow: 2px 2px 2px #000;
    }
    li{
        color: white;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-12" style="text-align: center;">
                <div class="card">
                    <i class="fas fa-users fa-9x"></i>
                    <h1>簡易學生選課系統</h1>
                    <form method="post">
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">學號</span>
                            </div>
                            <input type="text" class="form-control" name="stu_id" placeholder="請輸入學號">
                            <div class="input-group-append">
                                <button class="btn primary-bgcolor border-dark" type="submit" name="login">登入</button>
                                <button class="btn primary-bgcolor border-dark" type="submit" name="hint">提示</button>
                            </div>
                        </div>
                    </form>
<?php
if (isset($_POST['login'])) {
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        echo "<p class='result_msg'>資料庫連線錯誤</p>";
        die();
    }

    $stu_id = $_POST["stu_id"];
    $query = "SELECT * FROM student WHERE stu_id = $stu_id";
    $result = $conn->query($query);
    if (!$result) {
        echo "<p class='result_msg'>輸入內容錯誤 !</p>";
        die();
    }

    $rows = $result->num_rows;
    if ($rows) {
        session_start();
        $_SESSION['stu_id'] = $stu_id;
        header("Location: user.php");
    } else {
        echo "<p class='result_msg'>無該學號資料 !</p>";
        die();
    }
    $result->close();
    $conn->close();
}
if (isset($_POST['hint'])) {
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        echo "<p class='result_msg'>資料庫連線錯誤</p>";
        die();
    }
    $query = "SELECT * FROM student";
    $result = $conn->query($query);
    if (!$result) {
        die();
    }
    $rows = $result->num_rows;
    for($j=0; $j<$rows; ++$j){
        $row = $result->fetch_array(MYSQLI_NUM);
        $r0 = htmlspecialchars($row[0]);
        $r1 = htmlspecialchars($row[1]);
        echo "<li class='mt-2'>$r0\t$r1</li>";
    }

    $result->close();
    $conn->close();
}
?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>