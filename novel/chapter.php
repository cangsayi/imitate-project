<?php
	/***********************************************************************
	**		文件名:chapter.php                       
	**		概要: 文章列表控制器类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   

	//包含通用的脚本文件
	require "config.php";
	$Chapter = new Chapter($tpl);
	if(isset($_GET['action']) && $_GET['action']=='del'){
		$Chapter->del();
	}
  	$Chapter->getRowTotal();
  	$tpl->display("users/chapter.tpl");
	
?>