<?php
	/***********************************************************************
	**		文件名:Admin.class.php                       
	**		概要: 用户管理类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/   
	class Admin {
		public $mysqli;
		public $message;
		public $values;
	function __construct($db){
			$this->mysqli=$db;
	}
		public function login(){
			$name = $_POST["name"];
			$password = sha1($_POST['password']);
			$query ="SELECT username,password from ".TAB_PREFIX."admin where username='$name' and password='$password'";
			
			$result = $this->mysqli->query($query);
			if($result && $this->mysqli->affected_rows > 0){
				file_put_contents("test.txt",$this->mysqli->affected_rows);
				$_SESSION["isLogin"] =true;
				$this->mysqli->close();
				return true;
			}else{
				$this->mysqli->close();
				return false;
			}
		}

		public function logout(){
			if(isset($_SESSION["isLogin"])) {
			$_SESSION = array();
			session_destroy();

			}
			header("Location:index.php");	
		}
		public function editpass(){
			if($_POST["mpass"]== $_POST["newpass"]){
				$this->message = "新密码不能与旧密码一致";
				file_put_contents("test.txt", $this->message);
				return false;

			}else{
				$password = sha1($_POST["mpass"]);
				$query ="SELECT username,password from ".TAB_PREFIX."admin where password='$password'";
				file_put_contents("test.txt",$query);

			 	$result = $this->mysqli->query($query);

				if($result && $this->mysqli->affected_rows > 0){
					$data = sha1($_POST["newpass"]);
					$query = "UPDATE ".TAB_PREFIX."admin SET password = '$data' WHERE username='admin'";
					file_put_contents("test.txt",$query);
					$result = $this->mysqli->query($query);
					if($result && $this->mysqli->affected_rows > 0){
						$this->values =true;
				$this->message = "修改成功";
						return true;
					}else{
						$this->values =false;
						$this->message = "修改失败";
						return false;
					}
				
				}else{
						$this->values =false;
						$this->message = "原密码错误";
						
						return false;
				}
					
				
			}
				
		}
			
		

   }


?>
