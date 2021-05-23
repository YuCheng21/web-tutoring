<?php
$stu_id = $_GET['stu_id'];
$course_id = $_GET['course_id'];

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    echo "<p class='result_msg'>資料庫連線錯誤</p>";
    die();
}
$query = "INSERT INTO selection (stu_id, course_id) VALUES ($stu_id, $course_id)";

$result = $conn->query($query);
if (!$result) {
    session_start();
    $_SESSION['msg'] = "加選課程失敗，可能重複選課 !";
    header('Location: user.php');
    // die();
}else{
    session_start();
    $_SESSION['msg'] = "加選課程成功 !";
    header('Location: user.php');
}

?>