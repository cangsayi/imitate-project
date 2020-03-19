<{include file="common/header.tpl" title="章节列表"}>
</head>
<body>

<div class="padding border-bottom">  
  <a class="button border-yellow" href="chapteradd.php?bookId=<{$smarty.get.bookId}>&action=add"><span class="icon-plus-square-o"></span>添加章节</a>
   
</div>
<table class="table table-hover text-center">
      <tr>
        <th>标题</th>       
        <th>内容</th>
        <th>操作</th>       
      </tr>   
       <{section name=data loop=$rows }>   
        <tr> 
          <td><{$rows[data].title}></a></td>
          <td><a href="chapterdetail.php?id=<{$rows[data].id}>&bookId=<{$smarty.get.bookId}>" title="章节正文"><{$rows[data].content|truncate:33}></a></td>
          <td><div class="button-group">  <a class="button border-red" href="chapter.php?action=del&id=<{$rows[data].id}>&bookId=<{$smarty.get.bookId}>" onclick="return confirm('您确定要删除吗?');"><span class="icon-trash-o"></span> 删除</a> </div></td>
       
        </tr>
    <{sectionelse}>
   <tr><td colspan="8"><{$message}></td></tr>
  <{/section}> 

</table>
    <div>当前页：<{$cur}>，共<{$end_page}>页</div>
     <div class="pagelist"> <a href="chapter.php?page=1&bookId=<{$smarty.get.bookId}>">首页 </a><a href="chapter.php?page=<{$prev_page}>&bookId=<{$smarty.get.bookId}>"onclick="return <{$prev_page}>; ">上一页</a><a href="chapter.php?page=<{$next_page}>&bookId=<{$smarty.get.bookId}>" onclick="return <{$next_page}>;">下一页</a><a href="chapter.php?page=<{$end_page}>&bookId=<{$smarty.get.bookId}>">尾页</a> </div>
</body>
</html>