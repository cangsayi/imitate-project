<?php
	/***********************************************************************
	**		文件名:info.php                       
	**		概要: 用户基本信息.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/  
	//包含通用的脚本文件
	require "config.php";
	$user = new user($tpl);
	$user->edit();
	$tpl->display("users/info.tpl");
?>