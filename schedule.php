<head>
    <meta charset="utf-8">
    <title>schedule board</title>
    <style>
        p {
            font-size: 0.75em;
            color: white;
            opacity: 1;
            padding: 5px;
            background-image: linear-gradient(to right, rgba(251, 166, 138, 0) 0%, rgba(251, 166, 138, 1) 35%, rgba(251, 166, 138, 1) 65%, rgba(251, 166, 138, 0) 100%);
        }
        caption {
            font-size: 1.25em;
            font-weight: thin;
            color: #ffffff;
            padding: 5px;
            background-image: linear-gradient(to right, rgba(251, 166, 138, 0) 0%, rgba(251, 166, 138, 1) 35%, rgba(251, 166, 138, 1) 65%, rgba(251, 166, 138, 0) 100%);
        }
        thead {
            border: 1px solid #FF5722;
            position: sticky;
            z-index: 9999;
            top: 0; /* 将表头固定在页面顶部 */
        }
        /* 设置表格边框和间距 */
        table {
          width: 95%;
          top: 0px;
          margin-bottom: 15px;
          border-collapse: collapse;
          border-spacing: 0;
          text-align: center;
          font-size: 1.25em;
        }
        
        /* 设置表头样式 */
        th {
          font-weight: bold;
          background-color: #FF5722;
          color: #ffffff;
          padding: 0.5vw;
        }
        
        /* 设置表格单元格样式 */
        td {
          border: 1px solid #FF5722;
          color: #ffffff;
          padding: 0.5vw;
          word-wrap: break-word;
          white-space: pre-wrap;
        }
        
        td.diagonal {
          transform: rotate(45deg);
        }

        tr {
          background-color: #FF8964;
        }
        
        tr:hover {
          background-color: #FF5722;
          color: #ffffff;
        }
        
        #id {
            width: 4vw;
        }
        
        #name {
            width: 15vw;
        }
        
        #reply {
            width: 53vw;
        }
        
        #time {
            width: 20vw;
        }
        
        #ip {
            width: 8vw;
        }
        @media (orientation: portrait){
            table {
                font-size: 1.25em;
            }
            th {
                padding: 0.5vh;
            }
            td {
                padding: 0.5vh;
            }
            td:nth-child(5),
            th:nth-child(5) {
              display: none;
            }
        
            #name {
                width: 19vw;
            }
            
            #reply {
                width: 57vw;
            }
        }
        
        @media (max-width: 500px) {
            table {
                font-size: 0.8em;
            }
        }
        
        ::-webkit-scrollbar {
            width: 0.5em;
            background-color: #FBA68A;
        }
        
        ::-webkit-scrollbar-thumb {
            background-color: #FF4A11;
        }
    
        ::selection {
            background-color: #D32A1C;
            color: #ffffff;
        }

    </style>
</head>
<body>
<center>
<?php
// 根据浏览器语言设置适当的区域设置
$referer = $_SERVER['HTTP_REFERER'];
$isChinese = strpos($referer, 'en') === false;

// Twitch API 访问凭证
$clientID = 'xrunsfzqxqqpo91ind4ptsvayxbs3j';
$clientSecret = 'wm40par0pj52jqhby6edzrnux5w3am';

// 缓存文件路径
$schedule_cacheFile = './data/twitch_schedule_cache.json';

// 检查缓存是否存在且未过期
if (file_exists($schedule_cacheFile) && time() - filemtime($schedule_cacheFile) < 2 * 60 * 60) {
    // 使用缓存数据
    $scheduleData = json_decode(file_get_contents($schedule_cacheFile), true);
} else {
    // 获取访问令牌
    $getTokenURL = 'https://id.twitch.tv/oauth2/token';
    $getTokenData = array(
        'client_id' => $clientID,
        'client_secret' => $clientSecret,
        'grant_type' => 'client_credentials',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $getTokenURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($getTokenData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $accessToken = $data['access_token'];

    // Twitch 主播用户名
    $username = 'sweetily';

    // 获取 broadcaster ID
    $getUserURL = 'https://api.twitch.tv/helix/users?login=' . $username;
    $headers = array(
        'Client-ID: ' . $clientID,
        'Authorization: Bearer ' . $accessToken,
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $getUserURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $broadcasterID = $data['data'][0]['id'];

    // 获取直播时间表数据
    $getScheduleURL = 'https://api.twitch.tv/helix/schedule?broadcaster_id=' . $broadcasterID;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $getScheduleURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $scheduleData = $data['data']['segments'];

    // 将数据写入缓存文件
    file_put_contents($schedule_cacheFile, json_encode($scheduleData));
}

// 创建 HTML 表格
// 星期表示的映射
$weekDaysMap = array(
    'Monday' => '周一',
    'Tuesday' => '周二',
    'Wednesday' => '周三',
    'Thursday' => '周四',
    'Friday' => '周五',
    'Saturday' => '周六',
    'Sunday' => '周日'
);

if (isset($scheduleData) && is_array($scheduleData)) {
    echo '<table>';
    $startTime = $scheduleData[0]['start_time'];
    if ($isChinese)
        echo '<caption>直播预告</caption><caption>下一次直播时间为 ' . $weekDaysMap[date('l', strtotime($startTime))] . 'UTC+8 ' . date('H:i', strtotime($startTime)) . '</caption><thead style="white-space:nowrap"><tr><th>标题</th><th>计划日期</th><th>开始时间</th><th>结束时间</th></tr></thead>';
    else
        echo '<caption>Upcoming stream</caption><caption>The next stream is on ' . date('l', strtotime($startTime)) . ' at ' . date('H:i', strtotime($startTime)) . ' UTC+8</caption><thead style="white-space:nowrap"><tr><th>Title</th><th>Scheduled Date</th><th>Start Time</th><th>End Time</th></tr></thead>';
    echo '<tbody>';
    $index = 1;
    foreach ($scheduleData as $segment) {
        if (isset($segment['start_time']) && isset($segment['end_time']) && isset($segment['title']) && $index <= 7) {
            $startTime = $segment['start_time'];
            $endTime = $segment['end_time'];
            $title = $segment['title'];

            echo '<tr>';
            echo '<td>' . $title . '</td>';
            if ($isChinese)
                echo '<td>' . date('Y-m-d', strtotime($startTime)) . ' (' . $weekDaysMap[date('l', strtotime($startTime))] . ')</td>';
            else
                echo '<td>' . date('Y-m-d', strtotime($startTime)) . ' (' . date('l', strtotime($startTime)) . ')</td>';
            echo '<td>' . date('H:i', strtotime($startTime)) . '</td>';
            echo '<td>' . date('H:i', strtotime($endTime)) . '</td>';
            echo '</tr>';
            $index = $index + 1;
        }
    }
} else {
    echo '时间表不存在<br>Schedule undefined.';
}
echo '</tbody>';
echo '</table>';


// 缓存文件路径
$videos_cacheFile = './data/twitch_videos_cache.json';

// 检查缓存是否存在且未过期
if (file_exists($videos_cacheFile) && time() - filemtime($videos_cacheFile) < 2 * 60 * 60) {
    // 使用缓存数据
    $videosData = json_decode(file_get_contents($videos_cacheFile), true);
} else {
    // 获取直播录像列表
    $videosUrl = 'https://api.twitch.tv/helix/videos?user_id=' . $broadcasterID . '&type=archive&first=10';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $videosUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $videosData = json_decode($response, true);

    // 将数据写入缓存文件
    file_put_contents($videos_cacheFile, json_encode($videosData));
}

if (isset($videosData['data']) &&  is_array($videosData['data'])) {
    $videos = $videosData['data'];

    echo '<table style="">';
    if ($isChinese)
        echo '<caption>录播信息</caption><thead style="white-space:nowrap"><tr><th>录播标题</th><th>开始时间</th><th>链接</th><th>时长</th></tr></thead>';
    else
        echo '<caption>Record</caption><thead style="white-space:nowrap"><tr><th>Title</th><th>Start time</th><th>Record url</th><th>Duration</th></tr></thead>';
    echo '<tbody>';
    // 输出录像时间表和对应的录播地址
    foreach ($videos as $video) {
        $startTime = $video['created_at'];
        $url = $video['url'];
        $duration = $video['duration'];
        $title = $video['title'];

        $datetime = new DateTime($startTime, new DateTimeZone('UTC'));
        // 将时区设置为 UTF+8
        $datetime->setTimezone(new DateTimeZone('Asia/Shanghai')); // 将 'Asia/Shanghai' 替换为目标时区
        $startTime = $datetime->format('Y-m-d H:i');

        echo '<tr>';
        echo '<td>' . $title . '</td>';
        echo '<td>' . $startTime . '</td>';
        echo '<td><a href="' . $url . '" target="_blank" style="color: white; text-decoration: underline white;">Link</a></td>';
        echo '<td>' . $duration . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '暂无录播信息<br>No videos information now';
}

function UTC8($timestamp) {
    // 创建一个 DateTime 对象，并设置时区为 UTC
    $datetime = new DateTime();
    $datetime->setTimestamp($timestamp);
    $datetime->setTimezone(new DateTimeZone('UTC'));
    
    // 将时区设置为 UTC+8
    $datetime->setTimezone(new DateTimeZone('Asia/Shanghai')); // 将 'Asia/Shanghai' 替换为目标时区
    
    // 格式化日期和时间
    $utc8DateTime = $datetime->format('m-d H:i:s');
    
    echo $utc8DateTime;
}

if($isChinese) {
    echo '<p>上次更新(时间表|录播表)：';
} else {
    echo '<p>Last update time (Schedule|Videos): ';
}
echo UTC8(filemtime($schedule_cacheFile)).' | ';
echo UTC8(filemtime($videos_cacheFile)).'</p>';
?>
</center>
</body>