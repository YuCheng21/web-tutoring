<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get-Score</title>
    <style>
        body{
            text-align: center;
            background-color: #ffc954
        }
        .box{
            max-width: 600px;
            max-width: 600px;
            border: solid 4px #444;
            padding: 30px;
            margin: 10px auto;
            background-color: #f3f3f3;
        }
        .box h1{
            border-bottom: solid 4px #444;
            background-color: #ff3d4a;
        }
        form{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="box" style="">
    <h1 style="">簡易成績查詢系統</h1>
    <div class="box">
        <form method="post">
            <input type="submit" value="查詢全部成績" name="search-all">
            <input type="submit" value="重置">
        </form>
        <form method="post">
            <label for="id">查詢學號 :</label>
            <input type="text" name="id" id="id">
            <input type="submit" value="查詢">
            <br>
        </form>
    </div>
    <?php
        if(isset($_POST['search-all'])){
            $hn = 'localhost';
            $db = 'webtutoring';
            $un = 'root';
            $pw = 'mysql';
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die("連線錯誤!!");
            $query = "SELECT * FROM scores";
            $result   = $conn->query($query);
            if (!$result) echo "查詢錯誤!!";
            else{
                echo <<<_END
                    <table border="2" align="center" cellpadding="2" cellspacing="2">
                    <tr>
                        <th>學號</th>
                        <th>分數</th>
                    </tr>
                _END;
                $rows = $result->num_rows;
                for ($j = 0 ; $j < $rows ; ++$j){
                    $row = $result->fetch_array(MYSQLI_NUM);
                    $r0 = htmlspecialchars($row[0]);
                    $r1 = htmlspecialchars($row[1]);
                    echo "<tr><td>$r0</td><td>$r1</td></tr>";
                }
                echo <<<_END
                    </table>
                _END;
                $result->close();
            }
            $conn->close();

        }
        if (!empty($_POST['id']))
        {
            $hn = 'localhost';
            $db = 'webtutoring';
            $un = 'root';
            $pw = 'mysql';
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die("連線錯誤!!");
            $id   = $_POST["id"];
            $query    = "SELECT score FROM scores WHERE id = $id";
            $result   = $conn->query($query);
            if (!$result) echo "查詢錯誤!!";
            else{
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $score = $row['score'];
                $result->close();
            }
            $conn->close();
        }
        if(!empty($score) && !empty($id)){
            if ($score >= 80){
                echo <<<_END
                <h2>學號 $id 的成績</h2>
                <p style="font-size: 30px; background-color: green;">$score</p>
                _END;
            }else if($score >=60){
                echo <<<_END
                <h2>學號 $id 的成績</h2>
                <p style="font-size: 30px; background-color: yellow;">$score</p>
                _END;
            }else{
                echo <<<_END
                <h2>學號 $id 的成績</h2>
                <p style="font-size: 30px; background-color: red;">$score</p>
                _END;
            }
        }
        ?>
</div>
</body>
</html>
