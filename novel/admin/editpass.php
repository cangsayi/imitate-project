<?php
	/***********************************************************************
	**		文件名:editpass.php                       
	**		概要: 修改密码类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/  
	//包含通用的脚本文件
	require_once "../config.php";

if(isset($_POST["submit"])){
	$Admin = new Admin(DB::connect());
	if($Admin->editpass()){
	$tpl->assign("values",true);	
	}
$Admin->mysqli->close();
$tpl->assign("message",$Admin->message);


}else{
	$tpl->assign("message",'');
	$tpl->assign("values",'false');	
	
}

$tpl->display("admin/editpass.tpl");
	
?>
