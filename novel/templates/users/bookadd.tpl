<{include file="common/header.tpl" title="书籍添加"}>
<body>
 <div style="margin-top:10px;margin-left:30px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;width:300px;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;width:300px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
 <div class="body-content">
    <form method="post" class="form-x" action="bookadd.php?action=add" enctype="multipart/form-data"> 
       <input type="text" hidden name="authorId" value="<{$smarty.session.aid}>" readonly />
      <div class="form-group">
        <div class="label">
          <label>书籍名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="name" value="" data-validate="required:请输入书籍名" />         
          <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>封面</label>
        </div>
        <div class="field">
          <input type="file" name="image"class="input w50" title="支持jpg格式,少于60KB" data-validate="required:请上传书的封面" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>选择分类：</label>
        </div>
        <div class="field">
         <select name="categoryId" class="input w50">
            <{section name=index loop=$rowcs}>
            <option value="<{$rowcs[index].id}>"><{$rowcs[index].name}></option>
             <{sectionelse}>
            <option>没有可选择的分类</option>
          <{/section}>
          </select>
        </div> 
      </div>
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <input name="submit" value="提交" class="button bg-main icon-check-square-o" type="submit" />
        </div>
      </div>
    </form>
  </div>
</body></html>