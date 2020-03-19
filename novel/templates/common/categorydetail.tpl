<{include file="common/header.tpl" title="分类列表"}>
<link rel="stylesheet" href="admin/css/columns-12.css?ver=<{$smarty.now}>">
<link rel="stylesheet" href="admin/css/index.css?ver=<{$smarty.now}>">
</head>
<body>
	<div class="category_header">
	<h1 class="header_title"><a href="index.php">小说之家</a></h1>
	<form class="header_search" action="categorydetail.php?name=search " method="POST"> <input name="search" id="search"  placeholder="搜索"  required  /><button class="icon-search" type="submit" name="submit" value="submit"></button>
	</form>
  	  <{if $smarty.session.name}>
  	  <div class="header-info">
	 <a class="button button-little " href="details.php" title="进入个人中心"><{$smarty.session.name}></a>&nbsp;&nbsp;
		<a class="button button-little " href="logout.php">退出</a></div>
  	 <{else}>
  	 <div class="header-info">
  	 <a class="button button-little " href="logup.php" target="_blank">注册</a> &nbsp;&nbsp; <a class="button button-little " href="login.php" target="_blank">登录</a></div>
  	  <{/if}>
  	  </div>
	</div>
	<div id="category_content">
		<div class="ranking_sidebar_container">
			<ul class="ranking_linkList">
				<{section name=index loop=$links}>
				<li class="ranking_linkList_item">
					<a href="categorydetail.php?id=<{$links[index].id}>" class="ranking_linkList_item_link"><{$links[index].name}></a>
				</li>
				<{sectionelse}>
				<{/section}>

			</ul>
		 
		</div>
		<div class="ranking_page_content">
			<ul class="ranking_bookList">
				<{section name=index loop=$contents}>
				<li class="bookList_item">
					<a href="bookchapter.php?bookId=<{$contents[index].id}>"></a>
					<div class="bookList_item_container">
						<img src=".<{$contents[index].cover}>"  alt="小说的封面" />
						<div class="bookList_item_info">
							<p class="bookList_item_title"><{$contents[index].name}></p>
							<p class="bookList_item_author"><{$contents[index].author}></p>
							<p class="bookList_item_desc"><{$contents[index].content}></p>
						</div>
					</div>
				</li>
				<{sectionelse}>
				<div class="error"><{$error}></div>
				<{/section}>

			</ul>
		</div>
	</div>

<script type="text/javascript">
$(function(){
	var url =window.location.href.substr(42);
	$('#category_content .ranking_linkList_item a').filter(function(index){
		return $(this).attr('href').indexOf(url) > 0;
	}).parent().addClass('ranking_list_current');


$('#search').keyup(function(){
	var val = $('#search').val();

	if(!$('#search').val()){
		$('.ranking_page_content .bookList_item').show();
	}else{

	$('.ranking_page_content .bookList_item').hide();
	$('.bookList_item_title:contains('+val+')').parents('.bookList_item').show();
	}
	
});

});
</script>
</body>
</html>