<?php
	/***********************************************************************
	**		文件名:common.php                       
	**		概要: 公共的初始化操作             	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   
	
	//判断系统是否已经安装，如果没有安装则任何一个页面都不可以访问
	if(!file_exists("install_lock.txt")){
		echo "对不起！本系统没有安装不能使用. &nbsp;&nbsp;&nbsp;&nbsp; 请点击 <a href='install/index.php'>安装</a>";

		exit();		
	}
	//加载公用的初使化文件
	require "config.php";
	//将网站的标题分配给模板，在文章页面的标题栏中显示
	$tpl->assign("appName", APP_NAME);
	//将网站的应用路径分配到模板中
	$tpl->assign("appPath",APP_PATH);
	//获取用户访问页面的URL
	$url ="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	//将当前页面的URL分配到模板中
	$tpl->assign("url", $url);
?>
