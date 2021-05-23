<?php
$stu_id = $_GET['stu_id'];
$course_id = $_GET['course_id'];

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    echo "<p class='result_msg'>資料庫連線錯誤</p>";
    die();
}
$query = "DELETE FROM selection WHERE stu_id = $stu_id AND course_id = $course_id";
$result = $conn->query($query);
if (!$result) {
    session_start();
    $_SESSION['msg'] = "退選課程失敗 !";
    header('Location: user.php');
    // die();
}else{
    session_start();
    $_SESSION['msg'] = "退選課程成功 !";
    header('Location: user.php');
}
?>