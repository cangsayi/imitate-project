<{include file="common/header.tpl" title="小飒之家"}>
<link rel="stylesheet" href="admin/css/columns-12.css?ver=<{$smarty.now}>">
<link rel="stylesheet" href="admin/css/index.css?ver=<{$smarty.now}>">
</head>
<body style="background-color:#f2f9fd;">
	<div class="header bg-main">
  	  <div class="head-l"><a class="button button-little bg-green" href="index.php" target="_blank"><span class="icon-home"></span>首页</a> &nbsp;&nbsp;
  	  <{if $smarty.session.name}>
	 <a class="button button-little bg-red" href="details.php" title="进入个人中心">您好,<{$smarty.session.name}></a>&nbsp;&nbsp;
		<a class="button button-little bg-red" href="logout.php">退出登录</a>
  	 <{else}>
  	 <a class="button button-little bg-green" href="logup.php" target="_blank">注册</a> &nbsp;&nbsp; <a class="button button-little bg-red" href="login.php" target="_blank">登录</a>
  	  <{/if}>
  	  </div>
	</div>

	<div class="container">
		<ul class="nav-wrap">
			<li class="m act"><a href="#male">男生</a></li>
			<li class="f"><a href="#famale">女生</a></li>
		</ul>
		<div class="row male">
			<{section name=row loop=$rows_1}>
			<div class="col_3">
				<div class="content">
			<a href="categorydetail.php?id=<{$rows_1[row].id}>"><img src="./<{$rows_1[row].image}>" alt="分类图片" /></a>
				<p class="title"><{$rows_1[row].name}></p>
				<p><{$rows_1[row].count}>部</p>
				</div>
			</div>
			<{sectionelse}>
			错误
			<{/section}>
		</div>
		<div class="row female">
			<{section name=row loop=$rows_2}>
			<div class="col_3">
				<div class="content">
				<a href="categorydetail.php?id=<{$rows_2[row].id}>"><img src="./<{$rows_2[row].image}>" alt="分类图片" /></a>
				<p class="title"><{$rows_2[row].name}></p>
				<p><{$rows_2[row].count}>部</p>
				</div>
			</div>
			<{sectionelse}>
			错误
			<{/section}>
		</div>

	</div>

<script type="text/javascript">
$(function(){
	$("div.container .nav-wrap li").click(function(){
		$("div.container .nav-wrap li").removeClass("act");
		$(this).addClass("act");
	});
	$("div.container .f").click(function(){
		$("div.container .row").css('display','none');
		$("div.container .row.female").css('display','block');
	});
	$("div.container .m").click(function(){
		$("div.container .row").css('display','none');
		$("div.container .row.male").css('display','block');
	});
});
</script>
</body>
</html>

