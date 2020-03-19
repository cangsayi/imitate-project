<?php
		/***********************************************************************
	**		文件名:config.inc.php                       
	**		概要: 定义的全局常量            	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   

	//数据库部分参数设置
	@define("DB_HOST", "localhost");           			//数据库主机名
	@define("DB_USER", "root");		       		//数据库用户名
	@define("DB_PWD", "123456");			       			//数据库密码
	@define("DB_NAME", "novel");	         				//数据库名称
	@define("TAB_PREFIX", "xs_");					//前缀
	//应用程序相关设置
	@define("APP_NAME", "轻量级小说");            	//应用程序名称
    @define("NUM","5");							//每页显示的行数
    @define("APP_LOGO", "LOGO");  
	@define("APP_DOMAIN", "novel.cn");  
	//框架路径设置
	@define("CMS_ROOT", "D:/wamp64/www/novel/");					//系统根目录
	@define("CMS_CLASS_PATH", CMS_ROOT."class/");			//系统核心CLASS路径
	@define("CMS_UPLOAD_PATH", CMS_ROOT."uploadFiles/");	        //系统上传文件路径
	@define("CMS_TEMP", CMS_ROOT."temp/");			        //系统临时文件路径

	//和Smarty模板相关的设置
	@define("TEMPLATE_PATH", CMS_ROOT."templates/");	        //系统模板路径
	@define("TEMPLATE_COMPILE_PATH", CMS_ROOT."templates_c/");	//系统模板编译后的路径
	@define("TEMPLATE_CACHE_START", 0);                     	//缓存是否开启
	@define("TEMPLATE_CACHE_LIFETIME", 60*60*24);	                //系统模板被缓存的时间
	@define("TEMPLATE_CACHE_PATH", CMS_ROOT."cache/");	        //系统模板缓存文件存放的路径

		
	@define("APP_CLASS_PATH", CMS_ROOT."/class/");                   //类文件存放的目录
	@define("APP_PATH", "/novel/");   					 //安装路径
	@define("GALLERY_PATH", APP_PATH."gallery/");           	 //图片相册物理路径
	@define("GALLERY_REAL_PATH", CMS_ROOT."gallery/");               //图片相册存放目录
 
?>