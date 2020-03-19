<?php
	/***********************************************************************
	**		文件名:categorydetail.php                       
	**		概要: 分类详情                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   

	//包含通用的脚本文件
	require "config.php";
	$Index =new Index($tpl);
	if(!empty($_POST['search'])){
		$Index->getSearch();
	}

$cid=isset($_GET['id']) ? $_GET['id'] : false;
$Index->getCategoryList($cid);
$tpl->display("common/categorydetail.tpl");

?>
