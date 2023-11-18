function alert(content, timeout){
    if (!timeout) timeout = 2500;
    mdui.snackbar({
      message: content,
      timeout: timeout
    });
}



if (!localStorage.getItem("first-visited")) {
    if(window.location.href.indexOf('en') !== -1 && navigator.language.startsWith('zh'))
      window.location.href = '/';
    else if(window.location.href.indexOf('en') === -1 && !navigator.language.startsWith('zh'))
      window.location.href = '/en';
    else{
      // 设置标记表示已访问过
      localStorage.setItem("first-visited", "true");
      
      //document.write(`
      //  <div id="floating-window" style="z-index:9999;">
      //    <div id="floating-content">
      //      <p id="floating-message">在留言提问之前请先确定<br>你已经详阅左侧栏公告了~</p>
      //     <p><button id="floating-close-button" mdui-dialog="{target: '#announcement'}" onclick="document.getElementById('floating-window').style.display = 'none';">关闭</button></p>
      //    </div>
      //  </div>
      //`);
      
      if (navigator.language.startsWith('zh')){
        alert('欢迎！您可以在 菜单-关于 中以获取更多信息。', 10000)
      } else {
        alert('Welcome! Go to menu-about for more information.', 10000)
      }
    }
}

// 在页面加载时检查是否存在上次访问的页面地址
window.addEventListener('load', function() {
  const lastVisitedPage = localStorage.getItem('lastVisitedPage');

  if (lastVisitedPage&&!document.referrer) {
    // 跳转到上次访问的页面
    window.location.href = lastVisitedPage;
  }
});

// 在页面离开前保存当前页面地址
window.addEventListener('beforeunload', function() {
  const currentPage = window.location.href;
  localStorage.setItem('lastVisitedPage', currentPage);
});




webdriver = window.navigator.webdriver;
if(webdriver){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.abort(); 
    window.stop ? window.stop() : document.execCommand("Stop");
    alert('我在做网站的时候，你有在偷偷用Selenium爬我吧？(恼)')
    window.open('/', '_self')
} else {
    console.log('webdriver check 0K')
}

var UserAgent = 
{
    useragent:window.navigator.userAgent.toLowerCase(),
    android:function()
    {
        alert(this.useragent.indexOf("android"));
        return (this.useragent.indexOf("android") >=0);
    },
    iphone:function()
    {
        return (this.useragent.indexOf("iphone") >=0);
    },
    ipad:function()
    {
        return (this.useragent.indexOf("ipad") >=0);
    },
    mobile:function()
    {
    　　return (this.useragent.indexOf("andriod") >=0) || (this.useragent.indexOf("iphone") >=0) || (this.useragent.indexOf("ipad") >=0);
    }
}
if (UserAgent!='') console.log('UserAgent check 0K') 
else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.abort(); 
    window.stop ? window.stop() : document.execCommand("Stop");
    alert('你的UA咋是空的啊')
    window.open('/', '_self')
}

document.onkeydown = function() {
    var e = window.event || arguments[0];
    if (e.keyCode == 123) {
        alert("我求求你了，你也不管理这个网站F12干啥呀！");
        return false;
    }
     if ((e.ctrlKey) && (e.keyCode == 83)) { //ctrl+s
        alert("你存个html文件不怕我往里面藏病毒吗(恼)");
        return false;
    }
     if ((e.ctrlKey) && (e.keyCode == 85)) { //ctrl+s
        alert("要看源代码是吧？我那💩山有什么好看的！");
        return false;
    }
    if ((e.ctrlKey) && (e.keyCode == 73)) { //ctrl+s
        alert("F12不行用这个是吧，你干脆直接右上角工具里找到开发者工具点开来得了呗！");
        return false;
    }
}




document.oncontextmenu = function() {
    alert('你！不准使用右键！');
    return false;
}

var httpRequest = new XMLHttpRequest();//第一步：建立所需的对象
httpRequest.open('GET', '/gonggao/index.php', true);
/**
 * 获取数据后的处理程序
 */
httpRequest.onreadystatechange = function () {
    if (httpRequest.readyState == 4 && httpRequest.status == 200) {
        var gonggao = httpRequest.responseText;//获取到json字符串，还需解析
        document.getElementById('GG').innerHTML = gonggao
    }
};
httpRequest.send();//第三步：发送请求  将请求参数写在URL中

var httpRequest1 = new XMLHttpRequest();//第一步：建立所需的对象
httpRequest1.open('GET', '/events/index.php', true);
/**
 * 获取数据后的处理程序
 */
httpRequest1.onreadystatechange = function () {
    if (httpRequest1.readyState == 4 && httpRequest1.status == 200) {
        var event = httpRequest1.responseText;//获取到json字符串，还需解析
        document.getElementById('event-content').innerHTML = event
    }
};
httpRequest1.send();//第三步：发送请求  将请求参数写在URL中

function about() {
    window.open('/new-about.html', '_self');
}
function cn() {
    window.open('/', '_self');
}
function en() {
    window.open('/en', '_self');
}
function carrd() {
    window.open('https://sweetily.carrd.co/#', '_blank')
}

// 动态添加meta资源https
if (window.location.protocol.split(":")[0] == 'https') {
	var meta = document.createElement('meta');
	meta.content = "upgrade-insecure-requests";
	meta.setAttribute('http-equiv', "Content-Security-Policy");
	document.getElementsByTagName('head')[0].appendChild(meta);
}

function closewin(){
    document.getElementById('float_win').style.visibility='hidden' ;
}

function rickroll(){
    window.location.href="https://vdse.bdstatic.com//192d9a98d782d9c74c96f09db9378d93.mp4";
}

// 全局错误处理函数
window.onerror = function(message, source, lineno, colno, error) {
  alert('加载异常，请尝试刷新或向我们报告，不影响使用则忽略此信息：<br>' + message + ' in ' + lineno + ', ' + colno, 10000);
};

// 向新元素中添加文本 到顶端的快捷键
var newText = `<button class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme mdui-text-color-white-text" onclick="window.scrollTo({top: 0,behavior: 'smooth'});" style="opacity: 0.75;"><i class="mdui-icon material-icons" style="color:white">arrow_upward</i></button>`;
document.write(newText);

//节日祝福设置
var holidayWishes = [
  { date: "05-01", message: "祝元旦快乐！", cookieName: "new-year-wish-received" }, // 元旦
  { date: "02-10", message: "祝除夕快乐，希望来年也能多多支持！", cookieName: "chinese-new-year-eve-wish-received" }, // 春节
  { date: "02-11", message: "祝春节快乐！", cookieName: "chinese-new-year-wish-received" }, // 春节
  { date: "04-05", message: "祝清明节安康！", cookieName: "qingming-festival-wish-received" }, // 清明节
  { date: "05-01", message: "祝劳动节快乐！", cookieName: "labor-day-wish-received" }, // 劳动节
  { date: "05-04", message: "祝青年节快乐！", cookieName: "youth-day-wish-received" }, // 青年节
  { date: "06-01", message: "祝儿童节快乐！就算成年了也要保持童心哦~", cookieName: "childrens-day-wish-received" }, // 儿童节
  { date: "06-07", message: "祝各位学子高考顺利！", cookieName: "gaokao-wish-received" }, // 高考
  { date: "06-22", message: "祝端午节安康！", cookieName: "dragonboat-festival-wish-received" }, // 端午节
  { date: "09-28", message: "祝中秋节快乐！", cookieName: "mid-autumn-wish-received" }, // 中秋节
  { date: "10-01", message: "祝国庆节快乐！", cookieName: "national-day-wish-received" }, // 国庆节
  { date: "12-25", message: "祝圣诞节快乐！", cookieName: "christmas-wish-received" } // 圣诞节
];


function checkForHolidayWishes() {
  var today = new Date();
  var monthDayStr = today.toLocaleDateString("zh-CN", { month: "2-digit", day: "2-digit" }).replace('/', '-');

  for (var i = 0; i < holidayWishes.length; i++) {
    var holiday = holidayWishes[i];
    var alreadyReceived = localStorage.getItem(holiday.cookieName) || false;

    if (monthDayStr === holiday.date && !alreadyReceived) {
      alert(holiday.message, 8000);
      console.log("假期祝福已送出~")
      localStorage.setItem(holiday.cookieName, true);
    }
    else if(monthDayStr === holiday.date && alreadyReceived) console.log("已经送过祝福了~");
  }
}

//checkForHolidayWishes();




if(document.getElementById("footer")!=null){
if (window.location.href.indexOf('en') === -1)
document.getElementById('footer').innerHTML = "<br><HR style='FILTER:alpha(opacity=100,finishopacity=0,style=3)' width='90%' color=#C0C0C0 SIZE=3><div class='mdui-container-fluid' style='max-width:1500px;'><h3 id='留言板'>留言板</h3><div class='mdui-table-fluid mdui-table th' style='width:100%;'><br><form action='/comment/comment.php' method='post'><center><table class='mdui-table' style='max-width:1200px;'><tbody><tr><th><label class='mdui-textfield-label'>昵称</label><input type='text' class='mdui-textfield-input' name='name' placeholder='请输入昵称' required='required' maxlength='25' style='width:98%;'><br><label class='mdui-textfield-label'>评论</label><input type='text' class='mdui-textfield-input' name='comment' placeholder='要讲文明哟~' required='required' maxlength='200' style='width:98%;'><br><label class='mdui-textfield-label' style='display:none'>电邮</label><input type='text' class='mdui-textfield-input' name='contact' placeholder='或者其他联系方式（选填）' maxlength='200' style='width:98%;display:none;'><br><center><input class='mdui-btn mdui-ripple mdui-btn-raised mdui-btn-dense mdui-color-theme' type='submit' id ='submitButton' value='发送' onclick='' style='color:#FFFFFF!important;margin-right: 10px;'></center></th></tr></tbody></table></center></form><br><embed src='/sql_comment/' style='width:100%;max-width:1200px;'/></div></div><br><div style='margin-bottom: -15px; padding-bottom:20px; padding-top:20px; margin-left: -10px; margin-right: -10px;background: linear-gradient(to top, rgba(238, 238, 238, 1) 70%, rgba(238, 238, 238, 0.8) 85%, rgba(238, 238, 238, 0) 100%);'><font size='2' color=#C0C0C0>©2022-2023 Powered by <a href='https://github.com/Tvogmbh/' target='_blank' style='display:inline-block;text-decoration: none;'><font size='2' color='#C0C0C0' target='_blank'>Tvogmbh</font></a> · Pro-Ivan Studio 版权所有</font><br><a href='https://stats.uptimerobot.com/Oo6ykFNrDn' target='_blank' style='display:inline-block;text-decoration: none;'><font size='2' color=#C0C0C0>站点在线状态</font></a><font size='2' color=#C0C0C0> · </font><a href='/test_server/' target='_blank' style='display:inline-block;text-decoration: none;'><font size='2' color=#C0C0C0>网站服务状态</font></a><br><a href='http://beian.miit.gov.cn' style='display:inline-block;text-decoration:none;height:20px;line-height:20px;' target='_blank'><font size='2' color=#C0C0C0>京ICP备2022003448号-1/2</font></a><font size='2' color=#C0C0C0> · </font><a target='_blank' href='http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11011402012324' style='display:inline-block;text-decoration:none;height:20px;line-height:20px;'><img src='/img/beian.png' style='float:left;'/><font size='2' color=#C0C0C0>京公网安备 11011402012324号</font></a></div>";
else
document.getElementById('footer').innerHTML = "<br><HR style='FILTER:alpha(opacity=100,finishopacity=0,style=3)' width='90%' color=#C0C0C0 SIZE=3><div class='mdui-container-fluid' style='max-width:1500px;'><h3 id='留言板'>Leave a message?</h3><div class='mdui-table-fluid mdui-table th' style='width:100%;'><br><form action='/comment/comment.php' method='post'><center><table class='mdui-table' style='max-width:1200px;'><tbody><tr><th><label class='mdui-textfield-label'>Nickname</label><input type='text' class='mdui-textfield-input' name='name' placeholder='Nickname plz~' required='required' maxlength='25' style='width:98%;'><br><label class='mdui-textfield-label'>Content</label><input type='text' class='mdui-textfield-input' name='comment' placeholder='Be polite~' required='required' maxlength='200' style='width:98%;'><label class='mdui-textfield-label' style='display:none'>电邮</label><input type='text' class='mdui-textfield-input' name='contact' placeholder='或者其他联系方式（选填）' maxlength='200' style='width:98%;display:none;'><br><center><input class='mdui-btn mdui-ripple mdui-btn-raised mdui-btn-dense mdui-color-theme' type='submit' id ='submitButton' value='Submit' onclick='' style='color:#FFFFFF!important;margin-right: 10px;'></center></th></tr></tbody></table></center></form><br><embed src='/sql_comment/' style='width:100%;max-width:1200px;'/></div></div><br><div style='margin-bottom: -15px; padding-bottom:20px; padding-top:20px; margin-left: -10px; margin-right: -10px;background: linear-gradient(to top, rgba(238, 238, 238, 1) 70%, rgba(238, 238, 238, 0.8) 85%, rgba(238, 238, 238, 0) 100%);'><font size='2' color=#C0C0C0>©2022-2023 Powered by <a href='https://github.com/Tvogmbh/' target='_blank' style='display:inline-block;text-decoration: none;'><font size='2' color='#C0C0C0' target='_blank'>Tvogmbh</font></a> · Pro-Ivan Studio & Sweetily All Right Reserve</font><br><a href='https://stats.uptimerobot.com/Oo6ykFNrDn' target='_blank' style='display:inline-block;text-decoration: none;'><font size='2' color=#C0C0C0>Website status</font></a><font size='2' color=#C0C0C0> · </font><a href='/test_server/' target='_blank' style='display:inline-block;text-decoration: none;'><font size='2' color=#C0C0C0>Server Status</font></a><br><a href='http://beian.miit.gov.cn' style='display:inline-block;text-decoration:none;height:20px;line-height:20px;' target='_blank'><font size='2' color=#C0C0C0>京ICP备2022003448号-1/2</font></a><font size='2' color=#C0C0C0> · </font><a target='_blank' href='http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11011402012324' style='display:inline-block;text-decoration:none;height:20px;line-height:20px;'><img src='/img/beian.png' style='float:left;'/><font size='2' color=#C0C0C0>京公网安备 11011402012324号</font></a></div>";
}

setTimeout(function() {
    if(document.getElementById('body').offsetWidth<=720&&document.getElementById('title').innerHTML.length>18){
        document.getElementById('title').style.fontSize  = '14px';
    }
    else{
    
        if(document.getElementById('body').offsetWidth<=720&&document.getElementById('title').innerHTML.length>14){
            document.getElementById('title').style.fontSize  = '18px';
        }
    }
}, 250);

window.addEventListener('resize', function() {
    if(typeof(myChart)!="undefined"){
        myChart.resize();
    }
    if (document.getElementById('body').offsetWidth<1450) {document.getElementById('twitchVideo').style = 'display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;max-height:540px;height: calc(100vw / 16 * 9);';document.getElementById('twitter-container').style = '';}
    else {document.getElementById('twitchVideo').style = 'display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;float:right;max-height:540px;';document.getElementById('twitter-container').style = 'float:left;margin: 10px;';}
});
