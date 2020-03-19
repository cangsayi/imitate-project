<{include file="common/header.tpl" title="用户信息"}>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span>用户资料</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="info.php">
          
      <input type="text" hidden name="id" value="<{$id}>" />
      <div class="form-group">
        <div class="label">
          <label>用户名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="username" value="<{$username}>" data-validate="required:请输入用户名"/>
          <div class="tips"></div>
        </div>
      </div>
   
      <div class="form-group">
        <div class="label">
          <label>昵称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="nickname" value="<{$nickname}>" data-validate="required:请输入昵称"/>
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
        <button class="button bg-main icon-check-square-o" type="submit" name="submit" value="mod"> 修改</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>