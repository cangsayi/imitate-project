<?php

	/***********************************************************************
	**		文件名:User.class.php                       
	**		概要: 用户管理类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   
 require_once "../config.php";
//用户是否登录
if(!isset($_SESSION["isLogin"])) 
 {
	if (isset($_POST['submit'])) //已经提交表单
	{
		
		$Admin = new Admin(DB::connect());

		if ($Admin->login()){ //登录成功
			header("Location:index.php");				
		} else { //登录失败
			$message = "用户名或密码错误, 请重试.";
			$tpl->assign("message", $message);
		}

	}
	
}else{
	header("Location:index.php");	
}

$tpl->display("admin/login.tpl");

?>

