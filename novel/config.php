<?php
 	/***********************************************************************
	**		文件名:config.php                       
	**		概要: 初始化操作             	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   
	
	//开启Session
	session_start();
	//设置页面以utf-8的中文编号显示
	header("Content-type: text/html;charset=utf-8");
	//包含通用的全局配置文件
	require("config.inc.php");
	//包含Smarty类库所在的文件
	require CMS_ROOT."libs/Smarty.class.php"; 
	//设置中国所在的东八时区	
	date_default_timezone_set('PRC'); 
	//设置自动加载所需要的类文件
	function __autoload($className){
		//包含类路径下面的对应类名的类文件
		include(APP_CLASS_PATH.$className.".class.php");
	}
	//创建一个Smarty类的对象$tpl
		$tpl = new Smarty();   
		$tpl->template_dir = TEMPLATE_PATH;  		//设置所有模板文件存放的目录
		$tpl->compile_dir = TEMPLATE_COMPILE_PATH;  	//设置所有编译过的模板文件存放的目录
		$tpl->cache_dir = TEMPLATE_CACHE_PATH;         //设置存放Smarty缓存文件的目录
		$tpl->caching=TEMPLATE_CACHE_START;            //设置关闭Smarty缓存模板功能
		$tpl->cache_lifetime=TEMPLATE_CACHE_LIFETIME;  //设置模板缓存有效时间段的长度为1小时
		$tpl->left_delimiter = '<{';                   //设置模板语言中的左结束符
		$tpl->right_delimiter = '}>';       		//设置模板语言中的右结束符                        
?>
