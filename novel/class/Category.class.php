<?php
	/***********************************************************************
	**		文件名:User.class.php                       
	**		概要: 用户管理类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/        
	class Category {
		private $total=null;
		private $mysqli=false;
		private $tpl=null;
		function __construct($tpl,$action=null){
			$this->tpl = $tpl;
			$this->mysqli = DB::connect();
			$this->getTotals();
			switch ($action) {
				case 'add':
					$this->add();
					break;
				case 'del':
					$this->del();
					break;
				case 'mod':
					$this->mod();
					break;	
				case 'select':
					$this->getRowTotal($_SESSION['pId']);
					break;
				default:
					$this->info();
				
			}
		}
		
		public function add(){
			$pId = $_POST["pId"];
			$name = $_POST["name"];
			$sort = $_POST["sort"];

			if($_POST["submit"]){
				$query = "insert into ".TAB_PREFIX."category(pId,name,sort)
				 values('$pId','$name','$sort')";
				 file_put_contents('test.txt', $query);
				 $result = $this->mysqli->query($query);
				 if($result && $this->mysqli->affected_rows > 0){
				 	$this->tpl->assign('message','添加成功');
				 }else{
				 	$this->tpl->assign('message','添加失败');
				 	$this->tpl->assign('color','bg-red');
				 }
		
				 }
		
		}
		public function del(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$query = "delete from ".TAB_PREFIX."category where id ='$id'";
				$result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('disabled','disabled');
					return true;
				}else{
					return false;
				}
			}

			
		}
		public function  mod(){
			if(isset($_GET["id"])){
				$id = $_GET["id"];
				$query = "select * FROM ".TAB_PREFIX."category where id='$id'";
				$result = $this->mysqli->query($query);
				while ($row = $result->fetch_assoc()) {
					$this->tpl->assign('id',$row['id']);
					$this->tpl->assign('name',$row['name']);
					$this->tpl->assign('sort',$row['sort']);
				}
			}elseif(isset($_POST['submit'])){
				$id = $_POST['id'];
				$name = $_POST['name'];
				$sort = $_POST['sort'];
				$query ="update ".TAB_PREFIX."category set name='$name',sort='$sort' where id ='$id'";
				$result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','修改成功');
					$this->tpl->assign('disabled','disabled');
					
				}else{
					$this->tpl->assign('message','修改失败');
				}
			}
		
		}

		public function getRowTotal($pId){
				
				$num = NUM;
				$this->total = $this->getTotals();
				if(!$this->total){
			$this->tpl->assign('message','无类型');	
			return;
				}
				$cur= isset($_GET['page'])? $_GET['page']:1;
				$Page = new Page($this->total,$cur,NUM);
				$offset = $Page->getPageInfo()['row_offset'];
				$query = "SELECT * FROM ".TAB_PREFIX."category where pId='$pId' limit $offset,$num";
				file_put_contents('test.txt', $query);
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

		public function getTotals(){
			$pId = $_SESSION['pId'];
			$query = "select * from ".TAB_PREFIX."category where pId = '$pId'";
			$result = $this->mysqli->query($query);
			if($result){
				$total = $result->num_rows;
				return $total;
			}else{
				return false;
			}
			
		}
		public function info(){

		}
		
	}
?>
