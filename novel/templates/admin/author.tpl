<{include file="admin/header.tpl" title="作者管理"}> 
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a class="button border-yellow" href="author.php?action=add#add"><span class="icon-plus-square-o"></span> 添加作者</a>
  </div>

  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>    
      <th>作者昵称</th> 
      <th>有无作品</th>  
      <th>作品列表</th>  
      <th width="250">操作</th>
    </tr>
   <{section name=data loop=$rows }>
    <tr>
      <td><{$rows[data].id}></td>      
      <td><{$rows[data].nickname}></td>  
      <td><{if $rows[data].hasBook=='0'}>无<{else}>有<{/if}></td> 
      <td>
     
      <select name="books" >
         <{section name=index loop=$rows[data].book }>
       <option ><{$rows[data].book[index].name}></option>
        <{sectionelse}>
        <option disabled>空</option>
      <{/section}>
      </select>
        </td> 
      
      <td>
      <div class="button-group">
        <a class="button border-green" href="authoredit.php?action=edit&id=<{$rows[data].id}>" ><span class="icon-pencil-square-o"></span>编辑</a>
        <{if $rows[data].hasBook=='0'}>
        <a class="button border-red" href="author.php?action=del&id=<{$rows[data].id}>"  onclick="return confirm('确认删除吗');"><span class="icon-trash-o"></span> 删除</a>
        <{else}>
        <a class="button border-grey" disabled href=""><span class="icon-trash-o"></span> 删除</a>
        <{/if}>
      </div>
      </td>
    </tr> 
   <{sectionelse}>
   <tr><td colspan="8"><{$message}></td></tr>
  <{/section}>
  </table>
   <div>当前页：<{$cur}>，共<{$end_page}>页</div>
  <div class="pagelist"> <a href="author.php?page=1">首页</a><a href="author.php?page=<{$prev_page}>"onclick="return <{$prev_page}>; ">上一页</a><a href="author.php?page=<{$next_page}>" onclick="return <{$next_page}>;">下一页</a><a href="author.php?page=<{$end_page}>">尾页</a> </div>
</div>

<div class="panel admin-panel margin-top">
  <div class="panel-head" id="<{$smarty.get.action}>"><strong><span class="icon-pencil-square-o"></span> 
    添加作者
    </strong></div>
    <div style="margin-top:10px;margin-left:30px;width:80px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
  <div class="body-content">
    <form method="post" class="form-x" action="author.php?action=add"> 
    <div class="form-group">
        <div class="label">
          <label>选择用户：</label>
        </div>
        <div class="field">
          <select name="userId" class="input w50">
            <{section name=index loop=$userIds}>
            <option value="<{$userIds[index].id}>"><{$userIds[index].nickname}></option>
             <{sectionelse}>
            <option>没有可选择的用户</option>
          <{/section}>
          </select> 
        </div>
      </div>  
       <div class="form-group">
        <div class="label">
          <label>作者昵称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="nickname" value="" data-validate="required:请输入昵称" />         
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>有无书籍：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" readonly name="hasBook" value="无" data-validate="required:请输入用户名" />         
          
        </div>
      </div> 
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <input name="submit" value="提交" <{$disabled}> class="button bg-main icon-check-square-o" type="submit" />
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>