<{include file="common/header.tpl" title="用户主页"}>
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1><{$smarty.session.name}></h1>
  </div>
  <div class="head-l"><a class="button button-little bg-green" href="index.php" target="_blank"><span class="icon-home"></span> 前台首页</a>&nbsp;&nbsp;<a class="button button-little bg-red" href="logout.php"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  <h2><span class="icon-user"></span>基本设置</h2>
  <ul style="display:block">
    <li><a href="info.php" target="right">基本信息</a></li>
    <li><a href="editpass.php" target="right">修改密码</a></li>  
    <li><a href="book.php?uid=<{$smarty.session.id}>" target="right">作品管理</a></li>     
  </ul>   
</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
	  $(this).next().slideToggle(200);	
	  $(this).toggleClass("on"); 
  });

 $(".leftnav ul li.cate > a").click(function(){
    $("div.cateinfo ul").slideToggle(200);
  });
 
  $(".leftnav > ul > li > a").click(function(){
	    $("#a_leader_txt").text($(this).text());
  		$(".leftnav ul li a").removeClass("on");
		$(this).addClass("on");
  });

});
</script>
<ul class="bread">
  <li><a href="index.php"  class="icon-home"> 首页</a></li>
  <li><a href="" id="a_leader_txt">网站信息</a></li>
  
</ul>
<div class="admin">
  <iframe scrolling="auto" rameborder="0" src="info.php" name="right" width="100%" height="100%"></iframe>
</div>
<div style="text-align:center;">
<p>来源:<a href="https://cangsayi.github.io/" target="_blank">cangsayi</a></p>
年后
</div>
</body>
</html>