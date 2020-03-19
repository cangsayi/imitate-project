<{include file="common/header.tpl" title="小说内容
"}>
<link rel="stylesheet" href="admin/css/columns-12.css?ver=<{$smarty.now}>">
<link rel="stylesheet" href="admin/css/index.css?ver=<{$smarty.now}>">
</head>
<body>
<div id="chapter">
<div id="bookchapter_content" >
<{if $title}>
<p><{$title}></p>
<div><{$content}></div>
<p class="nextchapter"><a title="下一章" href="bookchapter.php?bookId=<{$smarty.get.bookId}>&id=<{$next}>" onclick="return 1;">下一章</a></p>
<{else}>
<p style="text-align: center;"><{$error}></p>
<{/if}>
</div>
<div class="list_icon" title="目录"><img src="images/category.png"></div>
</div>

<div id="list_container" style="display: none;">
	<div class="list_box">
		<ul>
			<{section name=index loop=$chapter}>
			<li>
				<a href="bookchapter.php?bookId=<{$smarty.get.bookId}>&id=<{$chapter[index].id}>"><{$chapter[index].title}></a>
			</li>
			<{sectionelse}>
			<p style="text-align: center;"><{$error}></p>
			<{/section}>

		</ul>
	</div>
</div>
<script type="text/javascript">
$(function(){

	$(document).click(function(){
		$('#list_container').hide();
	});
	$('div.list_icon').click(function(e){
		$('#list_container').show();
		e.stopPropagation();
	});

	var url =window.location.href.substr(49);
	if(!url)url='id=1';
	$('#list_container .list_box a').filter(function(index){
		return $(this).attr('href').indexOf(url) > 0;
	}).addClass('current');


});
</script>
</body></html>