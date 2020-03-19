<{include file="admin/header.tpl" title="分类管理"}>  
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a class="button border-yellow" href="column.php?action=add#add"><span class="icon-plus-square-o"></span> 添加分类</a>
  </div>

  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>     
      <th>二级分类名称</th>  
      <th>排序</th>     
      <th width="250">操作</th>
    </tr>
   <{section name=data loop=$rows }>
    <tr>
      <td><{$rows[data].id}></td>      
      <td><{$rows[data].name}></td>  
      <td><{$rows[data].sort}></td>      
      <td>
      <div class="button-group">
      <a type="button" class="button border-main" href="column.php?action=mod&id=<{$rows[data].id}>#mod"><span class="icon-edit"></span>修改</a>
       <a class="button border-red" href="column.php?action=del&id=<{$rows[data].id}>" onclick="return confirm('确认删除吗');"><span class="icon-trash-o"></span> 删除</a>
      </div>
      </td>
    </tr> 
   <{sectionelse}>
   <tr><td colspan="8"><{$message}></td></tr>
  <{/section}>
  </table>
   <div>当前页：<{$cur}>，共<{$end_page}>页</div>
  <div class="pagelist"> <a href="column.php?page=1">首页</a><a href="column.php?page=<{$prev_page}>"onclick="return <{$prev_page}>; ">上一页</a><a href="column.php?page=<{$next_page}>" onclick="return <{$next_page}>;">下一页</a><a href="column.php?page=<{$end_page}>">尾页</a> </div>
</div>

<div class="panel admin-panel margin-top">
  <div class="panel-head" id="<{$smarty.get.action}>"><strong><span class="icon-pencil-square-o"></span> 
    <{if $smarty.get.action=='mod'}>
    修改分类
    <{else}>
    <{if $smarty.get.action=='add'}>
    增加分类
    <{else}>
      分类
    <{/if}>
    <{/if}>
    </strong></div>
    <div style="margin-top:10px;margin-left:30px;width:80px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
  <div class="body-content">
    <form method="post" class="form-x" action="column.php?action=<{$smarty.get.action}>#<{$smarty.get.action}>">   
     
     
      <div class="form-group">
        <div class="label">
          <label>一级分类名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" readonly name="title" value="<{$smarty.session.cate}>"  />         
          
        </div>
      </div> 

      <{if $smarty.get.action=='add'}>

      <input type="hidden" name="pId"  value="<{$smarty.session.pId}>" />
      <{else}>
     <div class="form-group">
        <div class="label">
          <label>ID：</label>
        </div>
        <div class="field">
         <input type="text" class="input w50" name="id" readonly value="<{$id}>" />   
          
        </div>
      </div> 
      <{/if}>
      <div class="form-group">
        <div class="label">
          <label>二级分类名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="name" value="<{$name}>" data-validate="required:请输入标题" />         
          <div class="tips"></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="<{$sort}>"  data-validate="required:,number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <input name="submit" <{$disabled}> value="提交"  class="button bg-main icon-check-square-o" type="submit" />
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>