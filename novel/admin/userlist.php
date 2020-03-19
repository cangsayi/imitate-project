<?php
	/***********************************************************************
	**		文件名:Userlist.php                       
	**		概要: 后台用户管理.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/  
	//包含通用的脚本文件
	require_once "../config.php";
	
	$Userlist = new Userlist($tpl);
	if(!empty($_POST['submit']) && $_GET['action']){
		$Userlist->add();
	}elseif(isset($_GET['action']) && $_GET['action']=='del'){
		$Userlist->del();
	}

$Userlist-> getRowTotal();
$tpl->display("admin/userlist.tpl");
	
?>
