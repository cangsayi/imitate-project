<?php
	/***********************************************************************
	**		文件名:logup.php                       
	**		概要: 用户注册类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   
	
	//包含通用的初使化脚本文件
	require "config.php";
	$User = new User($tpl);
	if(isset($_POST['submit'])){
		$User->add();
	}
	$tpl->display("common/logup.tpl");

?>
