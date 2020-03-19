<{include file="common/header.tpl" title="注册"}>
</head>
<body>
  <div class="body-content">
    <form method="post" class="form-x" action="logup.php?">   
       <div style="margin-top:10px;margin-left:137px;margin-bottom:10px;width:250px;text-align:center;">
      <p class="bg-red"style="border-radius: 4px;margin:0;padding: 0;"><{$message}></p>
      </div>
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
          <label>重复密码：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="repassword" value="" data-validate="required:请再一次输入密码" />         
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
</body></html>