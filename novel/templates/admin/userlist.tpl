<{include file="admin/header.tpl" title="用户列表"}>  
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a class="button border-yellow" href="userlist.php?action=add#add"><span class="icon-plus-square-o"></span> 添加用户</a>
  </div>

  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>    
      <th>用户昵称</th> 
      <th>用户名</th>  
      <th>密码</th>  
      <th>性别</th>
      <th>邮箱</th>
      <th>地址</th>
      <th width="250">操作</th>
    </tr>
   <{section name=data loop=$rows }>
    <tr>
      <td><{$rows[data].id}></td>      
      <td><{$rows[data].nickname}></td>  
      <td><{$rows[data].username}></td>  
      <td><{$rows[data].password}></td> 
      <td><{if $rows[data].sex=='1'}>男<{else}><{if $rows[data].sex=='2'}>女<{else}>匿名<{/if}><{/if}></td>
      <td><{$rows[data].email}></td>  
      <td><{$rows[data].address}></td>
      <td>
      <div class="button-group">
        <a class="button border-green" href="useredit.php?action=edit&id=<{$rows[data].id}>" ><span class="icon-pencil-square-o"></span>编辑</a>
       <a class="button border-red" href="userlist.php?action=del&id=<{$rows[data].id}>" onclick="return confirm('确认删除吗');"><span class="icon-trash-o"></span> 删除</a>
      </div>
      </td>
    </tr> 
   <{sectionelse}>
   <tr><td colspan="8"><{$message}></td></tr>
  <{/section}>
  </table>
   <div>当前页：<{$cur}>，共<{$end_page}>页</div>
  <div class="pagelist"> <a href="userlist.php?page=1">首页</a><a href="userlist.php?page=<{$prev_page}>"onclick="return <{$prev_page}>; ">上一页</a><a href="userlist.php?page=<{$next_page}>" onclick="return <{$next_page}>;">下一页</a><a href="userlist.php?page=<{$end_page}>">尾页</a> </div>
</div>

<div class="panel admin-panel margin-top">
  <div class="panel-head" id="<{$smarty.get.action}>"><strong><span class="icon-pencil-square-o"></span> 
    添加用户
    </strong></div>
    <div style="margin-top:10px;margin-left:30px;width:80px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
  <div class="body-content">
    <form method="post" class="form-x" action="userlist.php?action=add">   
       <div class="form-group">
        <div class="label">
          <label>用户昵称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="nickname" value="" data-validate="required:请输入昵称" />         
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>用户名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="username" value="" data-validate="required:请输入用户名" />         
          
        </div>
      </div> 

      
      <div class="form-group">
        <div class="label">
          <label>密码：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="password" value="" data-validate="required:请输入密码" />         
          <div class="tips"></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>性别：</label>
        </div>
        <div class="field">
          <select name="sex" class="input w50" data-validate="required:请选择性别" >
            <option value="0">匿名</option>
            <option value="1">男</option>
            <option value="2">女</option>
          </select>       
          <div class="tips"></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>邮箱：</label>
        </div>
        <div class="field">
          <input type="email" class="input w50" name="email" value="" data-validate="required:请输入邮箱" />         
          <div class="tips"></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>用户地址：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="address" value="" data-validate="required:请输入用户地址" />         
          <div class="tips"></div>
        </div>
      </div> 
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <input name="submit" value="提交"  class="button bg-main icon-check-square-o" type="submit" />
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>