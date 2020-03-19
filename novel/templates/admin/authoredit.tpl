<{include file="admin/header.tpl" title="作者编辑"}> 
</head>
<body>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="edit"><strong><span class="icon-pencil-square-o"></span> 
    作者编辑
    </strong></div>
    <div style="margin-top:10px;margin-left:30px;width:80px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
  <div class="body-content">
    <form method="post" class="form-x" action="authoredit.php?action=edit&id=<{$smarty.get.id}>"> 
    
     <div class="form-group">
        <div class="label">
          <label>ID：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="id" readonly value="<{$id}>" data-validate="required:请输入昵称" />         
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
          <label>有无书籍：</label>
        </div>
        <div class="field">
          <{if $hasBook=='0'}>
          <input type="text" class="input w50" readonly name="hasBook" value="无" />
          <{else}>
           <input type="text" class="input w50" readonly name="hasBook" value="有" />
           <{/if}>
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