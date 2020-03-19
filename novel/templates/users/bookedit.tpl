<{include file="common/header.tpl" title="书籍编辑"}>
</head>
<body>
 <div style="margin-top:10px;margin-left:30px;text-align:center;">
      <{if $color}>
      <p class="bg-red"style="border-radius: 8px;margin:0;width:300px;padding: 0;"><{$message}></p>
      <{else}>
      <p class="bg-green" style="border-radius: 8px;width:300px;margin:0;padding: 0;"><{$message}></p>
      <{/if}>
    </div>
 <div class="body-content">
    <form method="post" class="form-x" action="bookedit.php?action=edit&id=<{$smarty.get.id}>"> 
      <div class="form-group">
        <div class="label">
          <label>ID：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="id" readonly value="<{$id}>" data-validate="required:请输入书籍名" />         
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>书籍名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="name" value="<{$name}>" data-validate="required:请输入书籍名" />         
          <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>封面：</label>
        </div>
        <div class="field">
         <img src=".<{$cover}>" alt="书籍的封面" width="72" height="96"/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>选择作者：</label>
        </div>
        <div class="field">
         <select name="authorId" class="input w50">
            <{section name=index loop=$rowas}>
            <{if $authorId==$rowas[index].id}>
            <option value="<{$rowas[index].id}>" selected  ><{$rowas[index].nickname}></option>
            <{else}>
            <{/if}>
             <{sectionelse}>
            <option>没有可选择的作者</option>
          <{/section}>
          </select>
        </div> 
      </div>
      <div class="form-group">
        <div class="label">
          <label>选择分类：</label>
        </div>
        <div class="field">
         <select name="categoryId" class="input w50">
            <{section name=index loop=$rowcs}>
            <{if $categoryId==$rowcs[index].id}>
            <option value="<{$rowcs[index].id}>" selected ><{$rowcs[index].name}></option>
            <{else}>
            <option value="<{$rowcs[index].id}>"><{$rowcs[index].name}></option>
            <{/if}>
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