<?php
	/***********************************************************************
	**		文件名:upload.php                       
	**		概要: 上传图片处理类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/  
	//包含通用的脚本文件
	require_once "../config.php";
	$type = $_FILES["image"]["type"];
	if($_FILES["image"]["error"] > 0) {
    $tpl->assign("message","上传失败");
    }
  elseif($type=="image/x-icon"){
    
  	 $name = $_FILES["image"]["name"];
  	 $filename="../logo.ico";
  
  	 if(move_uploaded_file($_FILES["image"]["tmp_name"],$filename)){
 		$tpl->assign("message","上传成功");
  		
  	
  	 }
  	
  }

function configSYS($configArray,$file='../config.inc.php') {
			$configText = file_get_contents($file);
			foreach($configArray as $key => $val) {
				$pattern[]='/define\(\"'.$key.'\",\s*.+\);/';
				$repContent[]='define("'.$key.'", "'.$val.'");';
			}
			$configText = preg_replace($pattern, $repContent, $configText);

			return file_put_contents($file, $configText);
		}
  configSYS($_POST);
$tpl->display("admin/upload.tpl");
	
?>
