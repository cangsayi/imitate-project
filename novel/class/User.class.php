	
<?php
	/***********************************************************************
	**		文件名:User.class.php                       
	**		概要: 用户类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/        
	class User  {
		private $total=null;
		private $mysqli=false;
		private $tpl=null;
		function __construct($tpl){
			$this->tpl = $tpl;
			$this->mysqli = DB::connect();
			
		}
	public function add(){
			if($_POST['submit']){
				$nickname = $_POST['nickname'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$repassword = $_POST['repassword'];
				$sex = $_POST['sex'];
				$email =$_POST['email'];
				$address = $_POST['address'];
				if($password ==$repassword){
					$query = "insert into ".TAB_PREFIX."users values(null,'$nickname','$username',sha1($password),'$sex','$email','$address')";
				}else{
					$this->tpl->assign('message','前后密码不一致');
					return true;
				}
				
				
				$result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$id=$this->mysqli->insert_id;
					$query =  "SELECT * FROM ".TAB_PREFIX."users";
					$result = $this->mysqli->query($query);
					if($result){
						while ($row=$result->fetch_assoc()) {
							$_SESSION['name'] = $row['nickname'];
							$_SESSION['id'] = $row['id'];
							header("Location:index.php");
						}
					}
					
				}else{
				$this->tpl->assign('message','添加失败');
					return false;	
				}

			}
		
		}

		public function logout(){
			if(isset($_SESSION["name"])) {
			$_SESSION = array();
			session_destroy();

			}
			header("Location:index.php");	
		}
		public function login(){
			$name = $_POST["username"];
			$password = sha1($_POST['password']);
			$query ="SELECT * from ".TAB_PREFIX."users where username='$name' and password='$password'";
			
			$result = $this->mysqli->query($query);
			if($result && $this->mysqli->affected_rows > 0){
				
				while($row=$result->fetch_assoc()) {
					$_SESSION['name'] = $row['nickname'];
					$_SESSION['id'] = $row['id'];
					header("Location:index.php");
				}
				
			}else{
				$this->tpl->assign('message','用户名或者密码错误');
				$this->mysqli->close();
				return false;
			}
		}
		public function  edit(){
			if(!empty($_POST['submit'])){
				$id = $_POST['id'];
				$nickname = $_POST['nickname'];
				$username = $_POST['username'];
				$sex = $_POST['sex'];
				$email = $_POST['email'];
				$address = $_POST['address'];
				$query ="update ".TAB_PREFIX."users set nickname='$nickname',username='$username',sex='$sex',email='$email',address='$address' where id ='$id'";
				file_put_contents('test.txt', $query);
				 $result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','修改成功');
				
				}else{
					$this->tpl->assign('message','修改失败');
				}
			}


				$id = $_SESSION['id'];
				$query = "select * FROM ".TAB_PREFIX."users where id='$id'";
				$result = $this->mysqli->query($query);
				while ($row = $result->fetch_assoc()) {
					$this->tpl->assign('id',$row['id']);
					$this->tpl->assign('nickname',$row['nickname']);
					$this->tpl->assign('username',$row['username']);
					$this->tpl->assign('sex',$row['sex']);
					$this->tpl->assign('email',$row['email']);
					$this->tpl->assign('address',$row['address']);
				}
		
		}
		public function  editpass(){
			if(!empty($_POST['submit'])){
				$id = $_POST['id'];
				$username = $_POST['username'];
				$pass = $_POST['pass'];
				$newpass = $_POST['newpass'];
				$renewpass = $_POST['renewpass'];
				if($pass==$newpass){
					$this->tpl->assign('message','原密码不能与新密码一致');
					return;
				}elseif ($newpass!=$renewpass) {
					$this->tpl->assign('message','两次输入的密码不一致');
					return;
				}
				$query ="update ".TAB_PREFIX."users set password=sha1($renewpass) where password=sha1($pass) and id='$id'";
				file_put_contents('test.txt', $query);
				 $result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','修改成功');
				
				}else{
					$this->tpl->assign('message','原密码错误，修改失败');
				}
			}


				$id = $_SESSION['id'];
				$query = "select * FROM ".TAB_PREFIX."users where id='$id'";
				$result = $this->mysqli->query($query);
				while ($row = $result->fetch_assoc()) {
					$this->tpl->assign('id',$row['id']);
					$this->tpl->assign('username',$row['username']);
				}
		
		}
	}

?>