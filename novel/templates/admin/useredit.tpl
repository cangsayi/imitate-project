<{include file="admin/header.tpl" title="用户编辑"}>   
</head>
<body>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="edit"><strong><span class="icon-pencil-square-o"></span> 
    用户编辑
    </strong></div>
    <div style="margin-top:10px;margin-left:30px;width:80px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
  <div class="body-content">
    <form method="post" class="form-x" action="useredit.php?action=edit&id=<{$smarty.get.id}>"> 
    <div class="form-group">
        <div class="label">
          <label>ID：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" readonly name="id" value="<{$id}>" data-validate="required:请输入昵称" />         
          <div class="tips"></div>
        </div>
      </div>  
       <div class="form-group">
        <div class="label">
          <label>用户昵称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="nickname" value="<{$nickname}>" data-validate="required:请输入昵称" />         
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>用户名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="username" readonly value="<{$username}>" data-validate="required:请输入用户名" />         
          
        </div>
      </div> 

      
      <div class="form-group">
        <div class="label">
          <label>密码：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="password" value="<{$password}>" data-validate="required:请输入密码" />         
          <div class="tips"></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>性别：</label>
        </div>
        <div class="field">
          <select name="sex" class="input w50" data-validate="required:请选择性别" >
            <{ if $sex==1}>
            <option value="0">匿名</option>
            <option value="1" selected>男</option>
            <option value="2">女</option>
            <{else}>
            <{if $sex==2}>
            <option value="0">匿名</option>
            <option value="1" >男</option>
            <option value="2" selected>女</option>
            <{else}>
            <option value="0">匿名</option>
            <option value="1" >男</option>
            <option value="2">女</option>
            <{/if}>
            <{/if}>
          </select>       
          <div class="tips"></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>邮箱：</label>
        </div>
        <div class="field">
          <input type="email" class="input w50" name="email" value="<{$email}>" data-validate="required:请输入邮箱" />         
          <div class="tips"></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="label">
          <label>用户地址：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="address" value="<{$address}>" data-validate="required:请输入用户地址" />         
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