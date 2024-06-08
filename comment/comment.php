<meta charset="utf-8">
<?php
    session_start();
    error_reporting(0);
    require 'ip2region/Ip2Region.php';
    
    
    //if(strpos($_POST["comment"], "密码") !== false) exit("管理密码为：yujionako<br>点击<a href=".$_SERVER["HTTP_REFERER"]."#留言板>此处</a>以返回");


    $limit = 60;  // 间隔阈值
    $currentTime = time();  // 当前时间戳
    
    if (isset($_SESSION['lastAccessTime'])) {
        $lastAccessTime = $_SESSION['lastAccessTime'];
    
        if ($currentTime - $lastAccessTime < $limit) {
            // 访问频率超过限制，执行相应的操作，比如拒绝访问或提示用户稍后再试
            exit('<script>alert("访问频率过高，请等待2分钟后再试！");window.open("'.$_SERVER['HTTP_REFERER'].'#留言板", "_self");</script>');
        }
    }
    
    // 更新最后访问时间
    $_SESSION['lastAccessTime'] = $currentTime;
    

    
    function getIp()
     {
      $ip=false;
      if(!empty($_SERVER["HTTP_CLIENT_IP"])){
       $ip = $_SERVER["HTTP_CLIENT_IP"];
      }
      if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
       if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
       for ($i = 0; $i < count($ips); $i++) {
        if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
         $ip = $ips[$i];
         break;
        }
       }
      }
      return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
     }
    $ip = getIp();
     
     //根据ip获取城市、网络运营商等信息
    $ip2region = new Ip2Region();
    $info = $ip2region->btreeSearch($ip);
    $region = $info['region'];
    
    
    date_default_timezone_set("Asia/Shanghai");
    $title = $_POST["name"]; //You have to get the form data
    $gain = $_POST["comment"];
    $contact = $_POST["contact"];
    $subtime=date("Y-m-d H:i:s");
    $fileName = './comment.txt'; //Open your .txt file
    $location = explode('|',$region)[2];
    //ftruncate($file, 0); //Clear the file to 0bit
    $content = "User_Name ". $title. PHP_EOL. " Comment  ". $gain. PHP_EOL. "  Time.   ". $subtime. "(UTC+8)". PHP_EOL. "---------". PHP_EOL;
    if(empty($gain)||empty($title)){
        print('<br>评论失败！表单中未包含昵称或留言内容！');
        echo '<br>点击<a href=';
        echo $_SERVER["HTTP_REFERER"];
        echo '#留言板>此处</a>以返回';
    }
    else{
        function strPosFuck($content) 
        {   
        $fuck = file_get_contents('bannedword.txt');  // 读取关键字文本信息  
        $content = trim($content);    $fuckArr = explode("\n",$fuck);  // 把关键字转换为数组  
        for ($i=0; $i < count($fuckArr) ; $i++)   
        {  
        // $fuckArr[$i] = trim($fuckArr[$i]);  
        if ($fuckArr[$i] == "") {     
        continue;  //如果关键字为空就跳过本次循环   
        # code...   
        }    
        if (strpos($content,trim($fuckArr[$i])) != false)    
          {    
          return $fuckArr[$i];  //如果匹配到关键字就返回关键字     
          # code...     
          }   
          }    return false;  // 如果没有匹配到关键字就返回 false 
          }   
          $key = strPosFuck($content); 
          if ($key) 
          {  
          echo "昵称或评论中存在不当词汇：".$key;  
          echo '<br>点击<a href=';
          echo $_SERVER["HTTP_REFERER"];
          exit ('#留言板>此处</a>以返回'); 
          } 
          else 
          { 
            $file = fopen($fileName, 'r');
            $content_txt = fread($file, filesize($fileName));
            $contents = $content . $content_txt;
            fclose($file);
            $file = fopen($fileName, 'w');
            fwrite($file, $contents);
            fclose($file);
            
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
            
            // 将评论插入到数据库中
            $sql = "INSERT INTO comments (name, comment, location) VALUES ('$title', '$gain', '$location')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Success!<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // 关闭数据库连接
            $conn->close();
          
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
            
                echo $mail_response;
            }
            $mailto='2531667489@qq.com'; //收件人
            $subject="新留言通报(妮露狐粉丝站)"; //邮件主题
            $body="<b><font size=2.5>User_Name ". $title ." (Contact ".$contact.")</font></b><br><br><b>Comment</b><font size=2 style='margin-left:10px;'><pre>└". $gain ."</pre></font><br><br><font size=1.5 color=#808080>  Time.   ". $subtime. "(UTC+8)" ."<br>from ".$location."(".$ip.")<br>In page ".$_SERVER["HTTP_REFERER"]."<br>end.</font>"; //邮件内容
            sendmailto($mailto,$subject,$body);
            //echo "finish".date('时间：Y年m月d日  H:i');
            
            $referer = $_SERVER['HTTP_REFERER'];
            $isChinese = strpos($referer, 'en') === false;
            
            if($isChinese) {
                print('评论成功!!请注意，您的评论可能不会立刻出现在下方栏框!<br>浏览器询问是否重新提交表单时请不要点击确定，否则服务器将收到重复的留言');
                echo '<br>点击<a href=';
                echo $_SERVER["HTTP_REFERER"];
                echo '#留言板>此处</a>以返回';
            }
            else {
                print('Your comment may not appear below soon.<br>Do not submit your comment again or we will receive same comment for twice.');
                echo '<br>Click <a href=';
                echo $_SERVER["HTTP_REFERER"];
                echo '#留言板>here</a> to back where you from!';
            }
          }
    }
    //die(header("Location: ".$_SERVER["HTTP_REFERER"]));
?>