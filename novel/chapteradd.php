<?php
	/***********************************************************************
	**		文件名:chapteradd.php                       
	**		概要: 文章列表控制器类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   

	//包含通用的脚本文件
	require "config.php";
	$Chapter = new Chapter($tpl);
	if(isset($_POST['submit']) && isset($_GET['bookId'])){
		$Chapter->add();
	}
   
	$tpl->display("users/chapteradd.tpl");
	
?>