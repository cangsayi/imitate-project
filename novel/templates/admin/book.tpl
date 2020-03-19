<{include file="admin/header.tpl" title="书籍管理"}> 
</head>
<body>
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder">作品管理</strong></div>
    <div class="padding border-bottom">
      <form class="search"  action="book.php?action=search" method="POST">
          <input type="text" name="search" style="border-radius: 7px;" class="" id="search" placeholder="请输入书籍名" />
         <button type="submit" name="submit" style="border-radius:7px;background-color:white;text-align:center;width:25px;height: 25px;" value="submit" ><span class="icon-search" style="margin:0;padding: 0;"></span></button>
      </form>
     <div class="padding border-bottom">  
  <a class="button border-yellow" href="bookadd.php?action=add"><span class="icon-plus-square-o"></span> 添加书籍</a>
   <div style="margin-top:10px;margin-left:30px;width:80px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
  </div>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>书籍名</th>       
        <th>封面</th>
        <th>作者</th>
        <th>类型</th>
         <th>创建时间</th>
        <th>操作</th>       
      </tr>   
       <{section name=data loop=$rows }>   
        <tr>
          <td><input type="checkbox" name="id[]" value="<{$rows[data].id}>" />
            <{$rows[data].id}></td>
          <td><{$rows[data].name}></td>
          <td><img src="..<{$rows[data].cover}>" alt="书籍的封面" width="72" height="96"/></td>
          
          <{section name=index loop=$rows[data].authorName}>   
          <td><{$rows[data].authorName[index].nickname}></td>  
           <{sectionelse}>
           出错
           <{/section}> 

            <{section name=index1 loop=$rows[data].categoryName}>   
          <td><{$rows[data].categoryName[index1].name}></td>  
           <{sectionelse}>
           出错
           <{/section}> 
          <td><{$rows[data].createTime}></td>
          <td><div class="button-group"> <a class="button border-green" href="bookedit.php?action=edit&id=<{$rows[data].id}>" ><span class="icon-pencil-square-o"></span>编辑</a> <a class="button border-red" href="book.php?action=del&id=<{$rows[data].id}>" onclick="return confirm('您确定要删除吗?');"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
    <{sectionelse}>
   <tr><td colspan="8"><{$message}></td></tr>
  <{/section}> 

    </table>
    <div>当前页：<{$cur}>，共<{$end_page}>页</div>
     <div class="pagelist"> <a href="book.php?page=1">首页 </a><a href="book.php?page=<{$prev_page}>"onclick="return <{$prev_page}>; ">上一页</a><a href="book.php?page=<{$next_page}>" onclick="return <{$next_page}>;">下一页</a><a href="book.php?page=<{$end_page}>">尾页</a> </div>
  </div>
</body></html>