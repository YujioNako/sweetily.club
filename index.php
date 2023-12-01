<!doctype html>
<html lang="zh-cmn-Hans">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
		<meta name="renderer" content="webkit" />
		<meta name="force-rendering" content="webkit" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="shortcut icon" href="/img/favicon.png">
		<link rel="stylesheet" href="/mdui/css/mdui.css" />
		<link rel="stylesheet" href="/src/index.css">
		<title>Sweetily's Fan Club-妮露狐的粉丝站</title>
		<meta name="keywords" content="twitch,sweetily,youtube,youtuber,game,genshin,starrail,原神,动漫,二次元,动画,游戏,ACG">
		<meta name="description" content="Fan made website for Sweetily!">
		<style>
		    li:hover {
              cursor: pointer;
              background-color: #eeeeee;
            }

            .level-box {
              width: 3.0em;
              height: 1.2em;
              background-color: #CCCCCC; /* 默认背景颜色 */
              border-radius: 6px;
              display: inline-block;
              text-align: center;
              margin-left: 10px;
            }
            
            .level-text {
              font-size: 16px;
              font-weight: bold;
              color: #FFFFFF; /* 默认文字颜色 */
            }
            
            /* 根据不同的等级设置不同的颜色 */
            .level-box.offline {
              background-color: #CCCCCC;
            }
            
            .level-box.onlive {
              background-color: #FF0000;
              animation: blink 3s infinite;
            }
            
            @keyframes blink {
              0% {
                opacity: 0;
              }
              50% {
                opacity: 1;
              }
              100% {
                opacity: 0;
              }
            }
            
            #congratulate {
                border: 5px solid #ffcc00;
                border-radius: 5px;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                color: #333333;
                display: none;
                max-width: 1200px;
                box-sizing: border-box;
            }
        
        </style>
		<script src="/src/echarts.min.js"></script>
		<script>
            function getAverageColor(img) {
              var canvas = document.createElement('canvas');
              var ctx = canvas.getContext('2d');
              var width = canvas.width = img.naturalWidth;
              var height = canvas.height = img.naturalHeight;
            
              ctx.drawImage(img, 0, 0);
            
              var imageData = ctx.getImageData(0, 0, width, height);
              var data = imageData.data;
              var r = 0;
              var g = 0;
              var b = 0;
              var skip = 0;
            
              for (var i = 0, l = data.length; i < l; i += 4) {
                if(data[i]<10&&data[i+1]<10&&data[i+2]<10) {skip++;continue;}
                if(data[i]>=245&&data[i+1]>=245&&data[i+2]>=245) {skip++;continue;}
                r += data[i];
                g += data[i+1];
                b += data[i+2];
              }
            
              r = Math.floor(1.00 * r / ((data.length / 4)-skip));
              g = Math.floor(1.00 * g / ((data.length / 4)-skip));
              b = Math.floor(1.00 * b / ((data.length / 4)-skip));
              

            
              return { r: r<=255?r:255, g: g<=255?g:255, b: b<=255?b:255 };
            }
            
            function load_border() {
                var rgb = getAverageColor(document.getElementById('avatar'));
                var rgbStr = ' rgb(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')';
                document.getElementById('avatar').style.border = '3px solid' + rgbStr;
            }
		</script>
		<script type="text/javascript">

            // 检查浏览器类型
            function isIE() {
              var userAgent = window.navigator.userAgent;
              return userAgent.indexOf('MSIE') !== -1 || userAgent.indexOf('Trident') !== -1;
            }
            
            // 将当前页面添加到收藏夹
            function AddFavorite(url, title) {
              var pageTitle = title||document.title;
              var pageUrl = url||window.location.href;
            
              if (isIE()) {
                // IE浏览器
                window.external.AddFavorite(pageUrl, pageTitle);
              } else {
                // Firefox浏览器
                if (window.sidebar && window.sidebar.addPanel) {
                  window.sidebar.addPanel(pageTitle, pageUrl, '');
                } else {
                  // 其他浏览器
                  alert('请使用Ctrl+D将页面添加到收藏夹。');
                }
              }
            }
        </script>
		<script>
        	var _hmt = _hmt || [];
        	(function() {
         	 var hm = document.createElement("script");
         	 hm.src = "https://hm.baidu.com/hm.js?f71f0ca15bd2e2ac9b74ea79f4798a26";
         	 var s = document.getElementsByTagName("script")[0]; 
         	 s.parentNode.insertBefore(hm, s);
        	})();
    	</script>
	</head>
	
	<body class="mdui-drawer-body-left mdui-theme-primary-deep-orange mdui-theme-accent-deep-orange">
	    <div id="loading_a" class="mdui-dialog" style="display: block;position: fixed;top: 0px;left: 0px;right: 0px;bottom: 0px;margin: auto;max-height:23%;pointer-events: none;">
	        <div class="mdui-dialog-title" style="pointer-events: none;">请稍等</div>
            <div class="mdui-dialog-content" style="pointer-events: none;">本页面渲染量较大，需要一定时间准备……<br>如果是第一次打开本页，等待时间可能更长</div>
            <div class="mdui-progress" style="position: fixed; bottom: 5%; align:center;">
              <div class="mdui-progress-indeterminate"></div>
            </div>
        </div>
        <div id="loading_l" class="mdui-overlay" style="z-index: 3000;"></div>
	    <div id="background"></div>
		<div class="mdui-drawer" id="left-drawer" style="z-index:3000;">
			<img src="/img/Ivan.svg" style="max-width: 100%; max-height: 100%;">
			<ul class="mdui-list">
			    <li id="menu_carrd" class="mdui-list-item mdui-ripple" onclick="carrd()">
					<i class="mdui-list-item-icon mdui-icon material-icons">home</i>
					<div class="mdui-list-item-content">妮露狐的个人主页</div>
				</li>
				<li id="menu_notice" class="mdui-list-item mdui-ripple" mdui-dialog="{target: '#announcement'}">
					<i class="mdui-list-item-icon mdui-icon material-icons">message</i>
					<div class="mdui-list-item-content">关于&告知</div>
				</li>
				<li id="menu_event" class="mdui-list-item mdui-ripple" mdui-dialog="{target: '#event'}">
					<i class="mdui-list-item-icon mdui-icon material-icons">event</i>
					<div class="mdui-list-item-content">妮露狐的活动！</div>
				</li>
				<li id="menu_support" class="mdui-list-item mdui-ripple" mdui-dialog="{target: '#support'}">
					<i class="mdui-list-item-icon mdui-icon material-icons">account_balance_wallet</i>
					<div class="mdui-list-item-content">支持我们</div>
				</li>
				<li id="menu_lang" class="mdui-list-item mdui-ripple" onclick="en()">
					<i class="mdui-list-item-icon mdui-icon material-icons">language</i>
					<div class="mdui-list-item-content">English</div>
				</li>
			</ul>
			<img src="/img/leftbar_bg.png" style="max-width: 100%; max-height: 100%; bottom: 0px; position: fixed; pointer-events: none;">
		</div>
		<div class="mdui-dialog" id="announcement">
			<div class="mdui-dialog-title">关于&告知</div>
			<div class="mdui-dialog-content">
				<div id="GG"></div>
			</div>
			<div class="mdui-dialog-actions">
				<button class="mdui-btn mdui-ripple mdui-text-color-theme mdui-text-color-white" mdui-dialog-close >关闭</button>
			</div>
		</div>
		<div class="mdui-dialog" id="support">
			<div class="mdui-dialog-title">支持我们</div>
			<div class="mdui-dialog-content">
                如果您有在关照了妮露狐之后仍有余力，还请多多支持我们！
				<br>
				<img src="/sponsor/weixin.webp" class="support-img" width="48%" />
				<img src="/sponsor/alipay.webp" class="support-img" width="48%" style="margin-left:2%;"/>
			</div>
			<div class="mdui-dialog-actions">
				<button class="mdui-btn mdui-ripple mdui-text-color-theme mdui-text-color-white" mdui-dialog-close >关闭</button>
			</div>
		</div>
		<div class="mdui-dialog" id="event">
			<div class="mdui-dialog-title">妮露狐的活动！</div>
			<div class="mdui-dialog-content">
				<div id="event-content"></div>
			</div>
			<div class="mdui-dialog-actions">
				<button class="mdui-btn mdui-ripple mdui-text-color-theme mdui-text-color-white" mdui-dialog-close >关闭</button>
			</div>
		</div>
		</div>
		<div class="mdui-appbar">
			<div class="mdui-toolbar mdui-color-theme" style="position:fixed;z-index:1000;margin-top:-75px;margin-left:-10px;" mdui-headroom>
				<a href="javascript:;" mdui-drawer="{target: '#left-drawer'}" class="mdui-btn mdui-btn-icon" onclick="setTimeout(function() {if(typeof(myChart)!='undefined')myChart.resize();if (document.getElementById('body').offsetWidth<1450) {document.getElementById('twitchVideo').style = 'display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;max-height:540px;height: calc(100vw / 16 * 9);';document.getElementById('twitter-container').style = '';}else {document.getElementById('twitchVideo').style = 'display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;float:right;max-height:540px;';document.getElementById('twitter-container').style = 'float:left;margin: 10px;';}}, 301);" style="color:white">
					<i class="mdui-icon material-icons">menu</i>
				</a>
				<a id="title" href="/new.html" class="mdui-typo-headline" style="color:white">妮露狐的粉丝站</a>
				<div class="mdui-toolbar-spacer"></div>
				<a href="javascript:;" class="mdui-btn mdui-btn-icon" onclick="AddFavorite('http://pro-ivan.cn','Pro-Ivan')">
					<i class="mdui-icon material-icons" mdui-tooltip="{content: '收藏本页'}" style="color:white">star</i>
				</a>
			</div>
		</div>
		<div id="body" class="mdui-container-fluid">
		    <div class="mdui-panel" style="margin-top:70px">
		        <div id='baseinfo_box' class="mdui-table-fluid mdui-table th" style="width: 100%;margin: 0 auto;">
		            <div>
    		            <img id="avatar" class="mdui-img-circle" src="/img/default.gif" width=100px height=100px  referrerpolicy="no-referrer" crossorigin="anonymous" style="margin:10px 15px;float:left;border:3px solid grey;box-sizing: border-box;" onload="load_border();" onerror="this.src='/img/error.png'">
    		            <div style="float:left;margin-left:5px; margin-top: 10px;">
    		                <h1 id="name" style="margin-left:10px; display: inline-block;">未输入uid</h1>
    		                <div id="level-box" class="level-box">
                              <span id="level-text" class="level-text">Off</span>
                            </div>
                            <div id="official_verify" class="mdui-typo-body-3-opacity" style="margin-left:10px; margin-right:10px;"><i class="mdui-list-item-icon mdui-icon material-icons">error</i>&nbsp;输入id才看得到观测记录哦~</div>
    		            </div>
    		            <div id='link_box' style='float:right;margin-top:32px;'>
    		            <a id="twitch_link" href="https://www.twitch.tv/sweetily" class="mdui-btn mdui-btn-icon" style="float:right;margin-right:25px;" target="_blank" mdui-tooltip="{content: 'Twitch主页'}">
        					<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="-4 -4 24 24"><g>  <path d="M3.857 0 1 2.857v10.286h3.429V16l2.857-2.857H9.57L14.714 8V0H3.857zm9.714 7.429-2.285 2.285H9l-2 2v-2H4.429V1.143h9.142v6.286z"/><path d="M11.857 3.143h-1.143V6.57h1.143V3.143zm-3.143 0H7.571V6.57h1.143V3.143z"/></svg>
        				</a>
        				<a id="YT_link" href="https://www.youtube.com/@SweetilyVT" class="mdui-btn mdui-btn-icon" style="float:right;margin-right:22px;" target="_blank" mdui-tooltip="{content: 'Youtube主页'}">
        					<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="-4 -4 24 24"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/></svg>
        				</a>
    		            <a id="twitter_link" href="https://twitter.com/SweetilyVT" class="mdui-btn mdui-btn-icon" style="float:right;margin-right:22px;" target="_blank" mdui-tooltip="{content: '推特主页'}">
        					<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="-4 -4 24 24"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
        				</a>
    		            <a id="discord_link" href="http://discord.gg/sweetily" class="mdui-btn mdui-btn-icon" style="float:right;margin-right:22px;" target="_blank" mdui-tooltip="{content: 'Discord'}">
        					<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="-4 -4 24 24"><path d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612Zm5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612Z"/></svg>
        				</a>
        				</div>
		            </div>
	                <div class="mdui-table-fluid mdui-table mdui-typo" style="margin-bottom:15px; margin-left: 15px; max-width: 95%;background-color:rgba(0,0,0,0)!important">
                      <blockquote>
                        <p id="sign" class="mdui-typo-body-2-opacity"></p>
                      </blockquote>
                    </div>
		        </div>
		        <br>
		        <HR style='FILTER:alpha(opacity=100,finishopacity=0,style=3)' width='90%' color=#C0C0C0 SIZE=3>
		        <br>
		        <div id="twitch-embed"></div>
		        
		        <br>
		        <HR style='FILTER:alpha(opacity=100,finishopacity=0,style=3)' width='90%' color=#C0C0C0 SIZE=3>
		        
		        <div class="mdui-typo">
		            <h1>Twitch观测</h1>
		        </div>
		        <div id="congratulate" class="mdui-table-fluid mdui-table" style="width: 100%; margin: 0 auto; text-align: center;">
		        </div>
		        <div id="base_info" style="margin-top:15px;"></div><br>
		        <div id="chart_box" class="mdui-table-fluid mdui-table th" style="width: 100%;height: auto;margin: 0 auto;">
		            <div id="chart" style="height:95%;width:99%;margin-top:15px;"><h1><center onclick="init(false,true)" style="cursor: pointer;">点击以加载观测内容</center></h1></div>
		        </div>
		        <div id="notes" class="mdui-table-fluid mdui-table th" style="width: 100%; text-align: center;box-sizing: border-box;margin: 0 auto;"></div><br>
		        <HR style='FILTER:alpha(opacity=100,finishopacity=0,style=3)' width='90%' color=#C0C0C0 SIZE=3>
		        
		        <div id='story' calss="mdui-typo" style="">
		            <div class="mdui-typo"><h1>设定</h1></div>
		            <div class="mdui-typo"><h3 style="margin-left:15px;">章节·一</h3></div>
		            <p style="margin-left:30px;">我记忆的起点，是我醒来时听到的海浪声。浪声轻柔，伴着安稳的节奏。彼时，我似乎是刚从长眠中苏醒，眼皮沉重，如同注入了铅。模糊的视线里，一切熟悉而又陌生——我似乎来过这里的，但我不知道这片土地的名字，不知道自己身处何处。</p>
		            <p style="margin-left:30px;">我茫然地沿着海岸，向前，向前。周围逐渐有人聚集过来，目光交错，其中有好奇，有不解。他们的口中脱落出词语，汇聚成句子；我能理解那些句子的意义，却终究无法回应其中的任何一句。</p>
		            <div class="mdui-typo">
                    <blockquote>
                        <p>你是<strong><em>谁</em></strong>？</p>
                        <p>你来自<strong><em>何处</em></strong>？</p>
                        <p>那个……<strong><em>是真的耳朵吗？</em></strong></p>
                    </blockquote>
                    </div>
                    <p style="margin-left:30px;">我这才发现我的脑袋上，而不是脑袋两侧，顶着一对耳朵——它们的存在是如此的自然，以至于我根本未曾意识到它们的存在。</p>
                    <p style="margin-left:30px;">围观的人们仍在絮絮。他们嘴中坠落的词句敲击在我空虚的记忆中一片诡异而深邃的黑暗里。黑暗翻涌了起来，似是将要将我包裹。</p>
		            <div class="mdui-typo">
                    <blockquote>
                        <p><strong><em><div class='mdui-typo-headline'>我是谁？</div></em></strong></p>
                    </blockquote>
                    </div>
                    <p style="margin-left:30px;">我询问自己，我询问黑暗；我找不到答案，而黑暗以沉默回应我的问询，同时不断舒展着自己的阴影。</p>
                    <br>
                    <div class="mdui-typo">
                    <blockquote>
                        <p style="color:#FF5722; "><strong><em>姐姐一定是从别的世界飘游来的吧！</em></strong></p>
                    </blockquote>
                    </div>
                    <p style="margin-left:30px;">在黑暗淹没我的五感前的最后一刻，一声清脆而明快的慨叹如朝云中的阳光一般穿透了黑暗。那些光在虚空中散射，最终在我的意识中投下了一个神秘的剪影。</p>
                    <p style="margin-left:30px;">我将头扭向我的阳光，有海蓝色的裙摆在海风中飘动——是一个正兴奋地盯着我的女孩。见我没有回应，她便又重复了一遍刚才说的话。似乎是害怕我不知道她在对我说话，她还向我招了招手，脸上挂满了<strong>灿烂的笑容</strong>。</p>
                    <p style="margin-left:30px;">那是足以穿透一切黑暗的<strong>笑容</strong>。</p>
                    <p style="margin-left:30px;">内心深处的什么东西沸腾起来了，缥缈的记忆浮现在了触手可及的地方：是无数的笑颜。我认不清每副面容，但他们的存在令意识中的黑暗确实又消散了些许。我想，无论这些笑容属于何处的谁人，他们都<strong><em>曾是</em></strong>我的无比重要的宝物。</p>
                    <p style="margin-left:30px;"><strong>——以后也会是的。</strong></p>
                    <h3 style="margin-left:15px;">5/22 记忆·一</h3>
                    <p style="margin-left:30px;">收到大家的笑容了，我也找回了一些回忆，感谢~</p>
                    <p style="margin-left:30px;">我<em>曾经</em>的名字是Ariel，从今往后，叫我Sweetly或Ariel都可以！我还记得我曾经做过直播主来着——不过之后的很长一段时间我都只对水下有着零零散散的记忆了。当时，到底发生什么了呢？</p>
		        </div>
		        
		        
                <HR style='FILTER:alpha(opacity=100,finishopacity=0,style=3)' width='90%' color=#C0C0C0 SIZE=3>
                    
                
		        <div class="mdui-typo">
		            <h1>更多</h1>
		        </div>
                
                <div class="mdui-typo" style="margin-bottom:15px;margin-left:15px;">
		            <h3>直播相关</h3>
		        </div>
		        
                <center>
                <iframe id='schedule' src='/schedule.php' style="width:100%;height: 650px;max-width:1200px;overflow: hidden;border:none;"></iframe>
                </center>
                
                <div class="mdui-typo" style="margin-bottom:15px;margin-left:15px;">
		            <h3>社交媒体</h3>
		        </div>
                
                <center>
                <div id="twitter-container" style="float:left;margin: 10px;"></div>

                <iframe
                    id='twitchVideo' 
                    src=""
                    width="960"
                    height="540"
                    style="display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;float:right;max-height:540px;display:none;"
                    allowfullscreen>
                </iframe>
                </center>

                
                
                
		        <div id="cursor-pendant" style="top:-100px">
                  <img id="pendant-image" src="/img/default.gif" width="80" height="80" alt="挂件">
                </div>
                <script>
                if ('ontouchstart' in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0) document.getElementById('cursor-pendant').style.display = 'none';
                  var pendant = document.getElementById('pendant-image');
                  var pendantbox = document.getElementById('cursor-pendant');
                  var mouseX = 0;
                  var mouseY = 0;
                  var pendantX = 0;
                  var pendantY = 0;
                
                  function updatePendantPosition() {
                    var dx = Math.abs(mouseX - pendantX - 20) < Math.abs(mouseX - pendantX - 60) ? mouseX - pendantX - 20 : mouseX - pendantX - 60;
                    var dy = Math.abs(mouseY - pendantY - 20) < Math.abs(mouseY - pendantY - 60) ? mouseY - pendantY - 20 : mouseY - pendantY - 60;
                    
                    if(Math.abs(dx) >= 20)
                        var vx = dx * 0.05; // 调整追逐速度，可以根据需要进行调整
                    else
                        var vx = 0;
                    if(Math.abs(dy) >= 20)
                        var vy = dy * 0.05;
                    else
                        var vy = 0;
                
                    pendantX += vx;
                    pendantY += vy;
                    
                    pendantbox.style.left = pendantX + 'px';
                    pendantbox.style.top = pendantY + 'px';
                    
                    if (vx > 0) {
                      pendant.style.transform = 'scaleX(1)';
                    } else if (vx < 0) {
                      pendant.style.transform = 'scaleX(-1)';
                    }
                    
                    requestAnimationFrame(updatePendantPosition);
                  }
                
                  document.addEventListener('mousemove', function(event) {
                    mouseX = event.clientX;
                    mouseY = event.clientY;
                  });
                  
                  
                
                  updatePendantPosition();
                </script>
		    </div>
		</div>
		
    	    


		<footer><div id="footer" style=""></div></footer>
		</body>
	<script src="/mdui/js/mdui.min.js"></script>
	<script src="/src/index.js"></script>
	
		<script type="text/javascript">
		function init(type,chart_type) {
		    document.getElementById('name').innerHTML = "加载中";
		    document.getElementById('official_verify').innerHTML = '<i class="mdui-list-item-icon mdui-icon material-icons">file_download</i>&nbsp;正在拉取数据……'
            var myChart;
            var data =[];
            var time = [];
            var fans = [];
            var viewer = [];
            var status = 0;
            var request = new XMLHttpRequest();
            request.open('GET', '/data/data.json?'+Math.random().toString(36).substring(7), true);
            request.responseType = 'json';
            request.onload = function() {
              if (request.readyState === 4 && request.status === 200) {
                data = request.response;
                for (var i = 0; i < data.length; i++) {
                  time.push(data[i].time);
                  fans.push(data[i].fans);
                  viewer.push(data[i].viewer);
                }
                status = data[data.length-1]['status']
                console.log('time:', time);
                console.log('fans:', fans);
                console.log('viewer:', viewer);
                console.log('status:', status);
                
                var baseinfo = {};
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/data/profile.json');
                xhr.responseType = 'json';
                xhr.onload = async function() {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    baseinfo = xhr.response;
                    
                    console.log(baseinfo);
                    var name = JSON.stringify(baseinfo.display_name).replaceAll('\"','');
                    var avatar = JSON.stringify(baseinfo.avatar).replaceAll('\"','');
                    var sign = ((JSON.stringify(baseinfo.description).replaceAll('\"','')).replaceAll(/\\r|\\n/ig,"<br>")).replaceAll(/`/g, '\\`');
                    var offline_bg = JSON.stringify(baseinfo.offline_bg).replaceAll('\"','');
                    document.getElementById('avatar').src = avatar;
                    document.getElementById('name').innerHTML = name;
                    //document.title = 'Pro-Ivan数字库-哔哩哔哩粉丝量观测-' + name;
                    document.getElementById('sign').innerHTML = sign !== '' ? sign : '我们不太了解他们，但我们确定 '+name+' 很不错。';
                    document.getElementById('twitch_link').href = JSON.stringify(baseinfo.live_url).replaceAll('\"','');
                    document.getElementById('official_verify').innerHTML = '<i class="mdui-list-item-icon mdui-icon material-icons">perm_contact_calendar</i> 于'+JSON.stringify(baseinfo.created_at).replaceAll('\"','').split('T')[0]+'加入了Twitch';
                    document.getElementById('baseinfo_box').style = `background-image: linear-gradient(to right, rgba(238, 238, 238, 1) 15%, rgba(238, 238, 238, 0.6) 30%, rgba(238, 238, 238, 0) 40%), url(${offline_bg})`
                    
                    function loadTwitchEmbedScript(size, ratio,layout) {
                        var script = document.createElement('script');
                        script.src = 'https://embed.twitch.tv/embed/v1.js';
                        
                        script.onload = function() {
                            console.log('Twitch脚本加载完成');
                            var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                            screenWidth>size ? screenWidth=size : screenWidth
                          new Twitch.Embed("twitch-embed", {
                              width: screenWidth,
                              height: screenWidth*ratio,
                              channel: baseinfo.live_url.split('/')[3],
                              layout: layout,
                              autoplay: false,
                              parent: ["sweetily.pro-ivan.com","sweetily.club",window.location.hostname]
                            });
                        };
                        script.onerror = function() {
                          // Twitch embed script failed to load
                          // Switch to an alternative script
                          alert('你的网络似乎无法连接到Twitch', 60000)
                        };
                        document.head.appendChild(script);
                      }
                    if(status==1){
                        document.getElementById('level-box').classList.add(`onlive`);
                        document.getElementById('level-text').innerHTML = "Live"
                        if(type){
                            if (document.getElementById('body').offsetWidth >= 850){
                                loadTwitchEmbedScript(1500, 0.45, "video-with-chat");
                            }
                            else {
                                loadTwitchEmbedScript(900, 0.6, "video");
                            }
                        }
                    }
                    else{
                        document.getElementById('level-box').classList.remove(`onlive`);
                        document.getElementById('level-text').innerHTML = "Off"
                        if(type) {
                          document.getElementById('twitch-embed').innerHTML=`
                            <iframe
                                id='twitchChat' 
                                src="https://www.twitch.tv/embed/sweetily/chat?parent=${window.location.hostname}"
                                width="960"
                                height="540"
                                style="display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;max-height:540px;"
                                allowfullscreen>
                            </iframe>
                          `}}
                          
                    function loadTwitterEmbedScript() {
                        var script = document.createElement('script');
                        script.src = 'https://platform.twitter.com/widgets.js';
                        
                        script.onload = function() {
                            console.log('Twitter脚本加载完成');
                            var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                            twttr.widgets.createTimeline(
                              {
                                sourceType: 'profile',
                                screenName: 'SweetilyVT'
                              },
                              document.getElementById('twitter-container'),
                              {
                                width: screenWidth>500?screenWidth=500:screenWidth,
                                height: screenWidth*1.5,
                                related: 'twitterdev,twitterapi'
                              }).then(function (el) {
                                console.log('Embedded a timeline.')
                              });
                              
                        };
                        script.onerror = function() {
                          // Twitch embed script failed to load
                          // Switch to an alternative script
                          alert('你的网络似乎无法连接到Twitter', 60000)
                        };
                        document.head.appendChild(script);
                    }
                    if(type){
                        loadTwitterEmbedScript();
                    }
                    
                    
                    document.getElementById('twitchVideo').src = `https://player.twitch.tv/?video=1799691003&parent=${window.location.hostname}&autoplay=false&muted=true`;
                    document.getElementById('twitchVideo').style = 'display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;float:right;max-height:540px;';
                    if (document.getElementById('body').offsetWidth<1450) {document.getElementById('twitchVideo').style = 'display: flex;max-width: 100%;margin-top: 10px;margin-bottom: 10px;max-height:540px;height: calc(100vw / 16 * 9);';document.getElementById('twitter-container').style = '';}
                
                
                for(var i=0;i<time.length;i++){
                    fans[i]=`["${time[i]}",${fans[i]}]`;
                    viewer[i]=`["${time[i]}",${viewer[i]}]`;
                }
                fans = `[${fans}]`;fans = JSON.parse(fans);
                viewer = `[${viewer}]`;viewer = JSON.parse(viewer);
                    
                setTimeout(function(){
                function formatNumber(num) { //防数字过长
                  if (num == null) {
                      return '-'
                  }
                  if (num >= 100000) {
                    if (num >= 10000000) {
                        return (num / 10000).toFixed(0) + '<small><b>万</b></small>';
                    }
                    else{
                        return (num / 10000).toFixed(1) + '<small><b>万</b></small>';
                    }
                  } else {
                    return num;
                  }
                }
                function single_fans_dif(data, time){
                  let record = data[data.length-1];
                
                  // Find the record from one day ago
                  let dayAgo = null;
                  for (let j = data.length-2; j >= 0; j--) {
                    let timeDiff = Math.abs(new Date(record[0].replace(' ', 'T')) - new Date(data[j][0].replace(' ', 'T'))); //iPadOS似乎不支持Date(x-x-x x:x:x)，但支持(x-x-xTx:x:x)
                    if (timeDiff >= (time-1)*24*60*60*1000 + 23.8*60*60*1000 && timeDiff <= (time-1)*24*60*60*1000 + 24.2*60*60*1000) {
                      dayAgo = data[j];
                      break;
                    }
                  }
                
                  // Calculate the fan difference
                  let fansDiff = null;
                  if (dayAgo !== null) {
                    fansDiff = record[1] - dayAgo[1];
                  }
                 
                 
                  // Add the result to the output array
                  if (time != 1 && fansDiff != null) {fansDiff = fansDiff.toFixed(0);}
                  return formatNumber(fansDiff)
                }
                if (document.getElementById('body').offsetWidth>=600){
                document.getElementById('base_info').innerHTML = `<div class="mdui-row mdui-col-12 mdui-center mdui-valign" style="max-width:1200px;"><div class="mdui-table-fluid mdui-table mdui-col-xs-3" style="height:110px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">同接数</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${status==1?formatNumber(viewer[viewer.length-1][1]):'未开播'}</b></h2></div></div><div class="mdui-table-fluid mdui-table mdui-col-xs-3" style="height:110px;margin-left:10px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">粉丝总数量</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${formatNumber(fans[fans.length-1][1])}</b></h2></div></div><div class="mdui-table-fluid mdui-table mdui-col-xs-3" style="height:110px;margin-left:10px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">1日增长量</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${single_fans_dif(fans, 1)}</b></h2></div></div><div class="mdui-table-fluid mdui-table mdui-col-xs-3" style="height:110px;margin-left:10px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">7日增长量</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${single_fans_dif(fans, 7)}</b></h2></div></div></div>`;
                }
                else {
                document.getElementById('base_info').innerHTML = `<div class="mdui-row mdui-col-12 mdui-center mdui-valign" style="max-width:620px;"><div class="mdui-table-fluid mdui-table mdui-col-xs-6" style="height:110px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">同接数</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${status==1?formatNumber(viewer[viewer.length-1][1]):'未开播'}</b></h2></div></div><div class="mdui-table-fluid mdui-table mdui-col-xs-6" style="height:110px;margin-left:10px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">粉丝总数量</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${formatNumber(fans[fans.length-1][1])}</b></h2></div></div></div><div class="mdui-row mdui-col-12 mdui-center mdui-valign" style="max-width:620px;"><div class="mdui-table-fluid mdui-table mdui-col-xs-6" style="height:110px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">1日增长量</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${single_fans_dif(fans, 1)}</b></h2></div></div><div class="mdui-table-fluid mdui-table mdui-col-xs-6" style="height:110px;margin-left:10px;margin-bottom:15px;"><div style="float:left;margin-left:5px;"><p id="" class="mdui-typo-body-2-opacity">7日增长量</p></div><div class="mdui-typo" style="margin-bottom:15px;float:right;bottom:0px;right:5px;position:absolute;"><h2 id="" style="margin-right:5px;"><b>${single_fans_dif(fans, 7)}</b></h2></div></div></div>`;
                }
            },500)
                    
                    if(chart_type){
        		    document.getElementById('loading_a').className="mdui-dialog mdui-dialog-open";
                    document.getElementById('loading_l').className="mdui-overlay mdui-overlay-show";
                    setTimeout(function(){build(baseinfo, fans, time, viewer, status)},1000);
                    }
                    
                  } else if(!document.getElementById('result_box')) {
                    console.log('Request failed.  Returned status of ' + xhr.status);
                    alert("未记录的uid：" + uid);
                    document.getElementById('name').innerHTML = "未记录该uid：" + uid;
                  }
                };
                xhr.send();
                
              }
            };
            request.send();
            
            
            
            
		}
		init(true,false);
		
        async function build(baseinfo, fans, time, viewer, status){ //建立chart 
            console.log('Building chart')
            const build_startTime = performance.now();
            var name = JSON.stringify(baseinfo.display_name).replaceAll('\"','');
            
            

            
            mintime = `"${JSON.stringify(time[0])}"`.substring(2,13)+"00:00:00";
            maxtime = `"${JSON.stringify(time[time.length-1])}"`.substring(2,13)+"23:59:59";
            
            function fans_dif(data, time) {
              let result = [];
            
              for (let i = 0; i < data.length; i=i+12) {
                const [currentDate, currentFans] = data[i];
                const currentTime = new Date(currentDate.replace(' ', 'T'));
            
                let dayAgo = null;
                for (let j = i -  time*288 + 288; j >= 0; j--) {
                  const [prevDate, prevFans] = data[j];
                  const prevTime = new Date(prevDate.replace(' ', 'T'));
                  let timeDiff = Math.abs(currentTime - prevTime);
            
                  if (
                    timeDiff >= (time - 1) * 24 * 60 * 60 * 1000 + 23.8 * 60 * 60 * 1000 &&
                    timeDiff <= (time - 1) * 24 * 60 * 60 * 1000 + 24.2 * 60 * 60 * 1000
                  ) {
                    dayAgo = data[j];
                    break;
                  }
                }
            
                let fansDiff = dayAgo !== null ? currentFans - dayAgo[1] : null;
                if (time !== 1 && fansDiff !== null) {
                  fansDiff = (fansDiff / time).toFixed(2);
                }
            
                if (result.length === 0 || fansDiff !== null) {
                  result.push([currentDate, fansDiff]);
                }
              }
            
              console.log(result);
              return result;
            }

            
            
            var rate1 = fans_dif(fans, 1);
            var rate7 = fans_dif(fans, 7);
            var rate30 = fans_dif(fans, 30);
            
            
            function fansk(data, time){ // 一段时间内粉丝量均值
                let result = [];
                
                // Loop through each record
                for (let i = 0; i < data.length; i=i+12) {
                  let record = data[i];
                
                  // Find the record from one day ago
                  let dayAgo = [];
                  for (let j = parseInt(i-144*time)<0?0:parseInt(i-144*time); j < data.length; j++) {
                    let timeDiff = Math.abs(new Date(record[0].replace(' ', 'T')) - new Date(data[j][0].replace(' ', 'T'))); //iPadOS似乎不支持Date(x-x-x x:x:x)，但支持(x-x-xTx:x:x)
                    if (timeDiff <= (0.5*(time*24*60*60*1000) + 0.1*60*60*1000)) {
                        if(data[j][1]!==0) {
                            dayAgo.push(data[j][1]);
                        } else if (dayAgo.length===0) {
                            dayAgo.push(0);
                        }
                    }
                    else if(dayAgo.length!==0) {
                        break
                    }
                  }
                  
                
                  // Calculate the fan difference
                  let fansDiff = null;
                  if (JSON.stringify(dayAgo) !== '[]') {
                    var sum = 0;
                    for (var k = 0; k < dayAgo.length; k++) {
                      sum += dayAgo[k];
                    }
                    fansDiff = sum / dayAgo.length;
                  }
                 
                 
                 
                  // Add the result to the output array
                  if (time != 1 && fansDiff != null) {fansDiff = fansDiff.toFixed(2);}
                  if (i < time*2) {fansDiff = null;}
                  if(fansDiff != null) {
                      result.push(
                         [record[0], fansDiff]
                      );
                  }
                }
                

                
                console.log(result);
                return result;
            }

            
            var fanskk = fansk(fans, 1);
            var viewerk = fansk(viewer, 0.041);
            
            
            function fans_node(fans, delta_time) { //获取粉丝里程碑数组
                // 假设 fans 和 time 数组已经定义并填充了相应的值
                // 设置阈值和当前时间
                // fans 粉丝-时间数组 threshold 超过该值的阈值 delta_time 展示的时间差
                var currentDate = new Date(); // 当前时间
                var results = []; // 结果
                let result = []; // 每个节点可能的结果
                var thresholds = [];

                // 0-10000中可被1000整除的数
                for (var i = 1000; i < 10000; i += 1000) {
                  thresholds.push(i);
                }
                
                // 10000-100000中可被10000整除的数
                for (var i = 10000; i < 100000; i += 5000) {
                  thresholds.push(i);
                }
                
                // 100000-1000000中可被100000整除的数
                for (var i = 100000; i < 1000000; i += 10000) {
                  thresholds.push(i);
                }
                
                // 100000-1000000中可被500000整除的数
                for (var i = 1000000; i < 10000000; i += 50000) {
                  thresholds.push(i);
                }
                
                // 10000000以上可被1000000整除的数
                for (var i = 10000000; i <= 100000000; i += 100000) {
                  thresholds.push(i);
                }
                
                function predictiveTimeNode(coordinates, newValue) { //计算粉丝里程碑达成预估时间
                  var time1 = new Date(coordinates[0][0].replace(' ', 'T'));
                  var value1 = coordinates[0][1];
                
                  var time2 = new Date(coordinates[1][0].replace(' ', 'T'));
                  var value2 = coordinates[1][1];
                
                  // 计算时间差和数值差
                  var timeDiff = time2.getTime() - time1.getTime();
                  var valueDiff = value2 - value1;
                
                  // 计算时间比例
                  var valueRatio = (newValue - value1) / valueDiff;
                
                  // 计算新时间
                  var newTime = new Date(time1.getTime() + timeDiff * valueRatio);
                
                  return newTime;
                }
                
                // 遍历 fans 数组
                for (var j = 0; j < fans.length; j++) {
                    result = [];
                    // 遍历thresholds
                    for(var i = 0; i < thresholds.length; i++) {
                      // 解析时间节点字符串为日期对象
                      var arrayNode = new Date(fans[j][0].replace(' ', 'T'));
                    
                      // 检查 fans 值是否超过阈值
                      if (j-1<0) var previous=j;
                      else var previous=j-1;
                      if (fans[j][1] >= thresholds[i] && fans[previous][1] < thresholds[i]) {
                        var timeNode = predictiveTimeNode([fans[previous], fans[j]], thresholds[i]);
                        // 计算时间节点与当前时间的差异（以毫秒为单位）
                        var timeDiff = currentDate - timeNode;
                    
                        // 将时间差转换为天数
                        var daysDiff = timeDiff / (1000 * 60 * 60 * 24);
                    
                        // 判断时间差是否小于7天
                        if (daysDiff < delta_time) { // 符合节点则记录：是否在通报时间内/该通报的粉丝节点/该通报的粉丝与时间信息
                          result = [true, thresholds[i], timeNode.toLocaleString().replace('T', ' ').replaceAll('/','-').split('.')[0]];
                        }
                        else {
                          result = [false, thresholds[i], timeNode.toLocaleString().replace('T', ' ').replaceAll('/','-').split('.')[0]];
                        }
                      }
                    }
                    if (JSON.stringify(result)!='[]') {results.push(result);}
                }
                return results;
            }
            
            var fans_nodes = fans_node(fans, 7);
            if (fans_nodes.length != 0) {
                if (fans_nodes[fans_nodes.length-1][0]==true){
                    document.getElementById('congratulate').innerHTML = `<h3 id="congratulate_text" style="margin-left:10px; margin-right: 10px; display: inline-block;">恭喜 ${name} 于${fans_nodes[fans_nodes.length-1][2].split(" ")[0]}*达成 ${fans_nodes[fans_nodes.length-1][1]} 粉丝成就！</h3>`;
                    document.getElementById('congratulate').style.display = 'block'; 
                }
            }
            var fans_nodes4chart = [];
            for (var i = 0; i < fans_nodes.length; i++) {
                fans_nodes4chart.push([fans_nodes[i][2], fans_nodes[i][1]]);
            }
            
            const build_endTime = performance.now();
            const build_executionTime = build_endTime - build_startTime;
            console.log(`calculating Time: ${build_executionTime.toFixed(0)} ms`);
            
            
            
            document.getElementById('notes').innerHTML = `* 趋势线计算方法为对应时间点两侧一定范围内所有数据的均值<br>** 为估计值，估计方法是参考里程碑节点两端数据点连成的线性方程<br>本表最后更新时间：${time[time.length-1]} <div id="refresh_icon" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons" mdui-tooltip="{content: '更新图表'}" style="color:black" onclick="document.getElementById('refresh_icon').classList.add('rotate');init(false,true);">refresh</i></div>`;
            document.getElementById('notes').style.padding = '12px';
            if(document.getElementById('body').offsetWidth<=700){
                document.getElementById('notes').style.fontSize  = '10px';
            }
            
            
            document.getElementById('loading_a').className="mdui-dialog";
            document.getElementById('loading_l').className="mdui-overlay";
            document.getElementById('chart_box').style = "width: 100%;height: 450px;margin: 0 auto;box-sizing: border-box;";

            
            var chartDom = document.getElementById('chart');
            var option;
            myChart = this.echarts.init(chartDom);
            option = {
              animationDuration: 2000,
              aria: {
                show: true,
                description: `这是一份关于${name}的粉丝量变化的图表，该表以时间为横轴，以粉丝量计数与粉丝变化量为纵轴，涵盖粉丝量、粉丝量趋势、同接量、同接量趋势、1日粉丝变化量、7日内粉丝日均变化量、30日内粉丝日均变化量以及视图内粉丝数同接数最高点、up主粉丝里程碑共计9个计量指标。截止到时间：${time[time.length-1]}，${name}已收获粉丝${fans[fans.length-1][1]}人，近一日粉丝变化量为${(rate1[rate1.length-1][1])}，近七日粉丝变化量为${rate7[rate7.length-1][1] == null ? '-' : (rate7[rate7.length-1][1]*7).toFixed(0)}（折合日均变化量${rate7[rate7.length-1][1] == null ? '-' : (rate7[rate7.length-1][1]*1).toFixed(0)}）。` + (fans_nodes.length===0?`在目前的记录中，还未找到${name}达到过的粉丝数里程碑。`:`此外，${name}还在日期：${(fans_nodes[fans_nodes.length-1][2]).split(" ")[0]}达成了${fans_nodes[fans_nodes.length-1][1]}粉丝的里程碑。}`)
              },
              title: {
                left: 'center',
                text: name+" 粉丝量变动"
              },
              tooltip: {
                trigger: 'axis'
              },
              dataZoom: [
                {
                  show: true,
                  realtime: true,
                  type: 'slider',
                  start: fans.length<=1000?0:(1-(1000/fans.length))*100,
                  end: 100,
                  xAxisIndex: [0, 1]
                }
              ],
              grid: {
                bottom: '15%',
                containLabel: true
              },
              legend: [
              {
                data: ['粉丝数', '粉丝数趋势线*', '同接数', '同接数趋势线*'],
                type: "scroll",
                height: "auto",
                top: 20
              },
              {
                data: ['1日增长', '7日增长(日均)', '30日增长(日均)'],
                type: "scroll",
                height: "auto",
                top: 40,
                itemWidth: 10
              },
              {
                data: ['UP主粉丝量里程碑**', '视图内最高粉丝记录', '视图内最高同接记录'],
                itemHeight: 16,
                itemWidth: 16,
                type: "scroll",
                height: "auto",
                bottom: 40
              }],
              xAxis: {
                type: 'time',
                min:mintime,
                max:maxtime
              },
              yAxis: [
                {
                    name:'粉丝计数',
                    type: 'value',
                    nameLocation: 'middle',
                    alignTicks: true,
                    scale: true,
                    axisLabel: {
                      inside: true
                    }
                },
                {
                    name:'同接计数/粉丝变化量',
                    type: 'value',
                    nameLocation: 'middle',
                    alignTicks: true,
                    scale: true,
                    axisLabel: {
                      inside: true
                    }
                },
                {
                    name:'',
                    type: 'value',
                    nameLocation: 'middle',
                    alignTicks: true,
                    scale: false,
                    axisLabel: {
                      inside: true
                    }
                }
              ],
              series: [
              {
                name: '粉丝数',
                type: 'line',
                zlevel: 9,
                //smooth: true,
                data: fans,
                showSymbol: false,
                yAxisIndex: 0,
                emphasis: {
                    focus: 'series',
                    blurScope: 'coordinateSystem'
                }
              },
              {
                name: '粉丝数趋势线*',
                type: 'line',
                zlevel: 7,
                //smooth: true,
                data: fanskk,
                showSymbol: false,
                yAxisIndex: 0,
                lineStyle: {
                    type: 'dashed',
                },
                emphasis: {
                    focus: 'series',
                    blurScope: 'coordinateSystem'
                }
              },
              {
                name: '同接数',
                type: 'line',
                zlevel: 8,
                //smooth: true,
                data: viewer,
                showSymbol: false,
                yAxisIndex: 1,
                emphasis: {
                    focus: 'series',
                    blurScope: 'coordinateSystem'
                }
              },
              {
                name: '同接数趋势线*',
                type: 'line',
                zlevel: 6,
                //smooth: true,
                data: viewerk,
                showSymbol: false,
                yAxisIndex: 1,
                lineStyle: {
                    type: 'dashed',
                },
                emphasis: {
                    focus: 'series',
                    blurScope: 'coordinateSystem'
                }
              },
              {
                name: '1日增长',
                type: 'line',
                zlevel: 2,
                //smooth: true,
                data: rate1,
                showSymbol: false,
                areaStyle: {
                    opacity: 0.5
                },
                yAxisIndex: 2,//对应右侧的y轴
                emphasis: {
                    focus: 'series',
                    blurScope: 'coordinateSystem'
                }
              },
              {
                name: '7日增长(日均)',
                type: 'line',
                zlevel: 3,
                //smooth: true,
                data: rate7,
                showSymbol: false,
                areaStyle: {
                    opacity: 0.2
                },
                yAxisIndex: 2,//对应右侧的y轴
                emphasis: {
                    focus: 'series',
                    blurScope: 'coordinateSystem'
                }
              },
              {
                name: '30日增长(日均)',
                type: 'line',
                zlevel: 5,
                //smooth: true,
                data: rate30,
                showSymbol: false,
                areaStyle: {
                    opacity: 0.2
                },
                yAxisIndex: 2,//对应右侧的y轴
                emphasis: {
                    focus: 'series',
                    blurScope: 'coordinateSystem'
                }
              },
              {
                name: 'UP主粉丝量里程碑**',
                type: 'scatter',
                zlevel: 10,
                symbol:'image://data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"%3E%3Cpath d="M10,10 L90,90 M10,90 L90,10" stroke="%23EE2222" stroke-width="20" fill="none" /%3E%3C/svg%3E',
                symbolSize: 20,
                itemStyle:{
                    normal:{
                        color:'#ee2222'
                    }
                },
                //smooth: true,
                data: fans_nodes4chart,
                showSymbol: true,
                yAxisIndex: 0
              },
              {
                name: '视图内最高粉丝记录',
                type: 'scatter',
                zlevel: 10,
                symbol:'image://data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"%3E%3Cpath d="M35 100 L50 50 L65 100 Z" stroke="%23000000" stroke-width="3" fill="%23EE2222" /%3E%3C/svg%3E',
                symbolSize: 30,
                itemStyle:{
                    normal:{
                        color:'#ee2222'
                    }
                },
                //smooth: true,
                data: [],
                showSymbol: true,
                yAxisIndex: 0
              },
              {
                name: '视图内最高同接记录',
                type: 'scatter',
                zlevel: 10,
                symbol:'image://data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"%3E%3Cpath d="M35 100 L50 50 L65 100 Z" stroke="%23000000" stroke-width="3" fill="%2322CC22" /%3E%3C/svg%3E',
                symbolSize: 30,
                itemStyle:{
                    normal:{
                        color:'#ee2222'
                    }
                },
                //smooth: true,
                data: [],
                showSymbol: true,
                yAxisIndex: 1
              }
              ]
            };
            option && myChart.setOption(option);
            if(document.getElementById('refresh_icon'))
                document.getElementById('refresh_icon').classList.remove('rotate');
            
            setTimeout(function(){
            myChart.on('datazoom', function() {
              reload_chart();
            });
            },1000);
            function reload_chart() {
                var option = myChart.getOption();
                var chart_end = new Date(fans[fans.length-1][0].replace(' ', 'T')).setHours(24, 0, 0, 0);
                var chart_start = new Date(fans[0][0].replace(' ', 'T')).setHours(0, 0, 0, 0);
                var delta_time1 = (100-option.dataZoom[0].start)*(chart_end-chart_start)/100;
                var delta_time2 = (100-option.dataZoom[0].end)*(chart_end-chart_start)/100;
                function fans_max_min(fans, delta_time, delta_time2) {
                    var currentDate = new Date(fans[fans.length-1][0].replace(' ', 'T'));
                    currentDate.setHours(24, 0, 0, 0);
                    var maxFansCount = ['' ,null];
                    var minFansCount = ['' ,null];
                    
                    for (var i = fans.length-1; i >= 0; i--) {
                      if (currentDate - new Date(fans[i][0].replace(' ', 'T')) <= delta_time2) {
                          continue
                      }
                      if (currentDate - new Date(fans[i][0].replace(' ', 'T')) >= delta_time) {
                          break
                      }
                      if(maxFansCount[1]==null) {
                        maxFansCount = [fans[i][0], fans[i][1]];
                      }
                      if (fans[i][1] > maxFansCount[1]) {
                        maxFansCount = [fans[i][0], fans[i][1]];
                      }
                      if(minFansCount[1]==null) {
                        minFansCount = [fans[i][0], fans[i][1]];
                      }
                      if (fans[i][1] < minFansCount[1]) {
                        minFansCount = [fans[i][0], fans[i][1]];
                      }
                    }
                    return [maxFansCount, minFansCount];
                }
                option.series[8].data = [fans_max_min(fans, delta_time1, delta_time2)[0]];
                option.series[9].data = [fans_max_min(viewer, delta_time1, delta_time2)[0]];
                myChart.setOption(option);
            }
            reload_chart(); //重载以加载视图内最高最低点
        }
		
            
            document.addEventListener('visibilitychange', function() {
                function setFavicon(iconUrl) {
                  var link = document.querySelector("link[rel~='shortcut icon']");
                  if (!link) {
                    link = document.createElement('link');
                    link.rel = 'shortcut icon';
                    document.head.appendChild(link);
                  }
                  link.href = iconUrl;
                }
              if (document.visibilityState === 'visible') {
                // 页面可见时的操作
                document.title = "Sweetily's Fan Club-妮露狐的粉丝站";
                setFavicon('/img/favicon.png');
                console.log('原标题');
              } else {
                // 页面不可见时的操作
                document.title = "别走呀！";
                setFavicon('/img/faviconSad.png');
                console.log('该标题');
              }
            });
            

            
		</script>
</html>
