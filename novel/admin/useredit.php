<?php
	/***********************************************************************
	**		文件名:Userlistedit.php                       
	**		概要: 后台用户编辑页面                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/  
	//包含通用的脚本文件
	require_once "../config.php";
	
	$Userlist = new Userlist($tpl);
	if(isset($_GET['action']) && $_GET['action']=='edit'){
		$Userlist->edit();
		$tpl->display("admin/Useredit.tpl");
	}

?>
