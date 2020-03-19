<?php
	/***********************************************************************
	**		文件名:User.class.php                       
	**		概要: 用户类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/        
	class Userlist  {
		private $total=null;
		private $mysqli=false;
		private $tpl=null;
		function __construct($tpl){
			$this->tpl = $tpl;
			$this->mysqli = DB::connect();
			
		}
			public function getRowTotal(){
				$this->total = $this->getTotals();
				if(!$this->total){
			$this->tpl->assign('message','无用户');	
			return;
				}
				$num =1;
				$cur = isset($_GET['page'])? $_GET['page']:1;
				$Page = new Page($this->total,$cur,$num);
				$offset = $Page->getPageInfo()['row_offset'];
				$query = "SELECT * FROM ".TAB_PREFIX."users limit $offset,$num";
				//file_put_contents('test.txt', $query);
				$result =$this->mysqli->query($query);
				if($result){
					while ($row = $result->fetch_assoc()) {
						$rows[]=$row;
						$pageinfo = $Page->getPageInfo();
                       
						$this->tpl->assign('prev_page',$pageinfo['prev_page']?$pageinfo['prev_page']:'false');
						$this->tpl->assign('next_page',$pageinfo['next_page']?$pageinfo['next_page']:'false');
						$this->tpl->assign('end_page',$pageinfo['page_num']);
						$this->tpl->assign('cur',$pageinfo['current_page']);
						$this->tpl->assign('rows',$rows);
					
					}
					//var_dump($result);
				}else{
					$this->tpl->assign('message','查询失败！');
				}		
		$this->mysqli->close();
		}
			public function  edit(){
			if(!empty($_POST['submit'])){
				$id = $_POST['id'];
				$nickname = $_POST['nickname'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$sex = $_POST['sex'];
				$email = $_POST['email'];
				$address = $_POST['address'];
				$query ="update ".TAB_PREFIX."users set nickname='$nickname',username='$username',password=sha1($password),sex='$sex',email='$email',address='$address' where id ='$id'";
				file_put_contents('test.txt', $query);
				 $result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','修改成功');
				
				}else{
					$this->tpl->assign('message','修改失败');
				}
			}
			if(isset($_GET["id"])){
				$id=$_GET["id"];
			}else{
				$id = $_SESSION['id'];
			}
				
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

		public function del(){
			 file_put_contents('test.txt','进入del');
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			 $query = "delete from ".TAB_PREFIX."users where id='$id'";
			 $result = $this->mysqli->query($query);
			 file_put_contents('test.txt',$query);
			 if($result && $this->mysqli->affected_rows > 0){
			 	$this->tpl->assign('message','删除成功');
			 	return true;
			 }else{
				$this->tpl->assign('color',true);
				$this->tpl->assign('message','删除失败');
					return false;	
			 }
			}
		}
		public function add(){
			if($_POST['submit']){
				$nickname = $_POST['nickname'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$sex = $_POST['sex'];
				$email =$_POST['email'];
				$address = $_POST['address'];
				$query = "insert into ".TAB_PREFIX."users values(null,'$nickname','$username',sha1($password),'$sex','$email','$address')";
				
				$result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','添加成功');
					
					return true;
				}else{
				$this->tpl->assign('color',true);
				$this->tpl->assign('message','添加失败');
					return false;	
				}

			}
		
		}
		public function getTotals(){
			$query = "select * from ".TAB_PREFIX."users";
			$result = $this->mysqli->query($query);
			if($result){
				$total = $result->num_rows;
				file_put_contents('rows.txt', $this->total);
				return $total;
			}else{
				return false;
			}
		}
		

	}
?>
