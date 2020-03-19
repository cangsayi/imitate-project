<{include file="common/header.tpl" title="章节列表"}>
<link rel="stylesheet" href="admin/css/columns-12.css?ver=<{$smarty.now}>">
<link rel="stylesheet" href="admin/css/index.css?ver=<{$smarty.now}>">
</head>
<body>
	 <{if $message}>
	<div style="margin-top:10px;margin-left:30px;text-align:center;">
      <p class="bg-red"style="border-radius: 8px;margin:0;width:300px;padding: 0;"><{$message}></p>
      </div>
      <{else}>
      <{/if}>
    
<form id=container action="chapteradd.php?bookId=<{$smarty.get.bookId}>&action=add" method="POST">
<div id="sectionEdit" class="zwText">
<input class="title" name="title" type="text" placeholder="请输入章节号与章节名。示例：“第十章 天降奇缘”" />
<textarea class="content" name="content" placeholder="请输入正文。" ></textarea>
<button class="button bg-main icon-check-square-o" name="submit" type="submit" value="submit" >发布</button>
</div>
</form>
</body></html>