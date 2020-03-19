<{include file="admin/header.tpl" title="编辑信息"}> 
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="upload.php" enctype="multipart/form-data">
      <div class="form-group">
        <div class="label">
          <label>网站标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="APP_NAME" value="<{$smarty.const.APP_NAME}>" required />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>网站LOGO：</label>
        </div>
        <div class="field">
          <input type="text" id="url1" name="APP_LOGO" class="input tips" style="width:25%; float:left;" value="<{$smarty.const.APP_LOGO}>" required  />
          <input type="file" accept="image/x-icon" class="button margin-left" name="image" id="image1" required  /><span> 支持ico格式</span>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>网站域名：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="APP_DOMAIN" value="<{$smarty.const.APP_DOMAIN}>" required  />
        </div>
      </div>
 
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
        <button class="button bg-main icon-check-square-o" type="submit" name="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>