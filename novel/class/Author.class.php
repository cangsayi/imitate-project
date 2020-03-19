<?php
	/***********************************************************************
	**		文件名:Author.class.php                       
	**		概要: 用户类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/        
	class Author {
		private $total=null;
		private $mysqli=false;
		private $tpl=null;
		function __construct($tpl){
			$this->tpl = $tpl;
			$this->mysqli = DB::connect();
			
		}
		public function add(){
			if(isset($_POST['submit'])){
				$nickname = $_POST['nickname'];
				$userId = $_POST['userId'];
				var_dump($userId);
				$hasBook ='0';
				$query = "insert into ".TAB_PREFIX."author values(null,'$nickname','$userId','$hasBook')";
				
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
			public function getRowTotal(){
				$this->total = $this->getTotals();
				if(!$this->total){
			$this->tpl->assign('message','无作者');	
			return;
				}
				$num =1;
				$cur = isset($_GET['page'])? $_GET['page']:1;
				$Page = new Page($this->total,$cur,$num);
				$offset = $Page->getPageInfo()['row_offset'];
				$query = "SELECT * FROM ".TAB_PREFIX."author limit $offset,$num";
				//file_put_contents('test.txt', $query);
				$result =$this->mysqli->query($query);
				if($result){
					while ($row = $result->fetch_assoc()) {
					
						if($row['hasBook']=='0'){
							$row['book']=false;
						}else{
							$aid = $row['id'];
							$query = "SELECT * FROM ".TAB_PREFIX."books where authorId='$aid'";
							$result = $result =$this->mysqli->query($query);
							while ( $data = $result->fetch_assoc()) {
								$datas[]=$data;
							}
							$row['book'] = $datas;
						}
						
						$rows[]=$row;
						
						
					}
					$query = "SELECT * FROM ".TAB_PREFIX."author";
					$result =$this->mysqli->query($query);
					while($row=$result->fetch_assoc()){
						$uids[]=$row['userId'];
					}
						$pageinfo = $Page->getPageInfo();
						$this->tpl->assign('prev_page',$pageinfo['prev_page']?$pageinfo['prev_page']:'false');
						$this->tpl->assign('next_page',$pageinfo['next_page']?$pageinfo['next_page']:'false');
						$this->tpl->assign('end_page',$pageinfo['page_num']);
						$this->tpl->assign('cur',$pageinfo['current_page']);
						//var_dump($rows);
						$this->tpl->assign('rows',$rows);
					//var_dump($result);
				}else{
					$this->tpl->assign('message','查询失败！');
				}
				$userIds=[];
				$query ="SELECT * FROM ".TAB_PREFIX."users";		//添加作者区域
				$result = $this->mysqli->query($query);
				if($result){
					while ($row=$result->fetch_assoc()) {
						$i=0;
						foreach ($uids as $key) {
							if($row['id'] == $key){
								break;							//排除已有的作者选项
							}
							$i++;
						}
			if($i==count($uids))$userIds[]=$row;
					
					}
				}else{
					$this->tpl->assign('message','查询用户数据失败');
				}
				if(empty($userIds))$this->tpl->assign('disabled','disabled');
			$this->tpl->assign('userIds',$userIds);
	
		}
			public function  edit(){
			if(!empty($_POST['submit'])){
				$id = $_POST['id'];
				$nickname = $_POST['nickname'];
				$query ="update ".TAB_PREFIX."author set nickname='$nickname' where id ='$id'";
				file_put_contents('test.txt', $query);
				 $result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','修改成功');
				
				}else{
					$this->tpl->assign('message','修改失败');
				}
			}
				$id = $_GET["id"];
				$query = "select * FROM ".TAB_PREFIX."author where id='$id'";
				$result = $this->mysqli->query($query);
				while ($row = $result->fetch_assoc()) {
					$this->tpl->assign('id',$row['id']);
					$this->tpl->assign('nickname',$row['nickname']);
					$this->tpl->assign('hasBook',$row['hasBook']);
					
				}
		
		
		}

		public function del(){
			 file_put_contents('test.txt','进入del');
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			 $query = "delete from ".TAB_PREFIX."author where id='$id'";
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
		public function getTotals(){
			$query = "select * from ".TAB_PREFIX."author";
			$result = $this->mysqli->query($query);
			if($result){
				$total = $result->num_rows;
				return $total;

			}else{
			return false;
			 }
		
		}
	}
?>
