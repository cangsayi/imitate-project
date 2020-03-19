<html>
	<head>
		<title>轻量级小说项目,可用于个人学习使用 </title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<style>
			body {
				margin:10% 10%;
				font-size:12px;
				font-family:verdana, sans-serif;
				background:#F5F5F5;
			}
			#main-box {
				background:#FFF;
				border:1px solid #A5A5A5;
				margin-right:5px;
				margin-bottom:5px;
				color:#5A5A8F;
			}

			.head-dark-box {
				margin:2px;
				background:url(images/menu.gif);
				color:#555;
				padding-top:5px;
				padding-bottom:5px;
			}
			.head-dark-box strong{
				padding-left:30px;
				background:url(images/ins.gif) no-repeat 10px center;
			}
			.body-box {
				margin:2px;
				padding:1em;
				line-height:150%;
				background:#F1F1F1;
			}
			.tip-msg {
				background:#EAEAEA url(images/tip.gif) no-repeat 25px center;
				padding-left:6em;
				color:#5A5A8F;
			}
			.error {
				background:#EAEAEA url(images/tipe.gif) no-repeat 25px center;
				padding-left:6em;
				color:red;
			}
			.white-box {
				margin:2px;
				background:#FFF;
			}
			.center {
				text-align:center;
			}
			.red-font {
				color:#F00;
			}
			.license {
				border:2px solid #FFF;
				padding:20px;
				padding-bottom:0px;
			}
			form {
				margin:0px;
				padding:0px;
				width:auto !important;
				width:100%;
			}
			ul {
				padding:0px;
				margin:0px;
				list-style:none;
			}
			ul li {
				padding-left:45px;
				padding-top:5px;
				padding-bottom:5px;
				background:url(images/tp.gif) no-repeat 25px center;
			}
			.liimg {
				background:url(images/tpa.gif) no-repeat 25px center;
			}	
			.col_width {
				float:left;
				width:25%;
				line-height:20px;
			}
			.text-box {
				font-size:12px;
				font-family:verdana, sans-serif;
				color:#696969;
				border:1px solid #A5A5A5;
				margin-right:10px;
			}
			.dark-row {
				background-color:#EAEAEA;
			}

			.light-row {
				background-color:#f8f8f8;
			}

			.button {
				margin-right:10px;
				border:1px solid #B6B3AF;
				padding:1px 4px 0;
				background:url(images/buttonface.gif) repeat-x; 
				height:21px;
			}
		</style>
	</head>
	
	<body>
		<?php
			require "../config.inc.php";
			if(file_exists("../install_lock.txt")){
				echo '<div class="error">你已经安装过本系统<br>如果需要重新安装请删除文件'.CMS_ROOT.'install_lock.txt</div>';
				exit;	
			}
		?>
		<div id="main-box">
			<div class="head-dark-box">
				<strong>novel项目安装向导</strong>
			</div>	
			<?php	
				require "Process_class.php";
				require "InstallFrom_class.php";
				require "Install_class.php";
				$step = empty($_POST['step']) ? 1 : $_POST['step']; 	//安装的第几步骤
				$install=new Install();
				$install->exeStep($step);	
			?>
		</div>
	</body>
</html>
