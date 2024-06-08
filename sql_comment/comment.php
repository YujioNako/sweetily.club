<?php
// 连接数据库
$servername = "127.0.0.1";
$username = "root";
$password = "Ldc123456";
$dbname = "messages";

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取用户提交的评论
$name = $_POST["name"];
$comment = $_POST["comment"];

// 将评论插入到数据库中
$sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";


function sendmailto($mailto, $mailsub, $mailbd)
{
    $mail_data = array(
        'mailto' => $mailto,
        'subject' => $mailsub,
        'body' => $mailbd
    );

    $mail_url = 'https://pro-ivan.com/api/e-mail/'; // 替换为实际的邮件发送 URL
    $mail_data = http_build_query($mail_data);

    $ch = curl_init($mail_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $mail_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $mail_response = curl_exec($ch);
    curl_close($ch);

    //echo $mail_response;
}
$mailto='2531667489@qq.com'; //收件人
$subject="新留言通报(妮露狐粉丝站)"; //邮件主题
$body="<b><font size=2.5>User_Name ". $name ."</font></b><br><br><b>Comment</b><font size=2 style='margin-left:10px;'><pre>└". $comment ."</pre></font><br><br><font size=1.5 color=#808080>" ."<br>In page ".$_SERVER["HTTP_REFERER"]."<br>end.</font>"; //邮件内容
sendmailto($mailto,$subject,$body);

if ($conn->query($sql) === TRUE) {
    echo "评论已提交";
    header("refresh:5;url=".$_SERVER['HTTP_REFERER']);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header("refresh:5;url=".$_SERVER['HTTP_REFERER']);
}

// 关闭数据库连接
$conn->close();

?>