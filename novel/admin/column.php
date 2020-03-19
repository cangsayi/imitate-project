<?php
	/***********************************************************************
	**		文件名:column.php                       
	**		概要: 后台主页.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/  
	//包含通用的脚本文件
	require_once "../config.php";
	if(!empty($_POST["submit"]) && $_GET["action"]){
		new Category($tpl,$_GET['action']);

	}
	elseif(isset($_GET["action"]) && $_GET["action"]!='add'&& isset($_GET["id"])){
	new Category($tpl,$_GET['action']);

	}

$_SESSION['cate'] = isset($_GET['cate'])?$_GET['cate']:$_SESSION['cate'];	
$_SESSION['pId'] = isset($_GET['pId'])?$_GET['pId']:$_SESSION['pId'];
if(!isset($_GET['action'])){
$tpl->assign('disabled','disabled');
}
new Category($tpl,'select');		
$tpl->display("admin/column.tpl");
	
?>
