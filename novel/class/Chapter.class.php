<?php
	/***********************************************************************
	**		文件名:Chapter.class.php                       
	**		概要: 用户类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/        
	class Chapter {
		private $total=null;
		private $mysqli=false;
		private $tpl=null;
		function __construct($tpl){
			$this->tpl = $tpl;
			$this->mysqli = DB::connect();
			
		}
		public function add(){
			if(!empty($_POST['title']) && !empty($_POST['content'])){
				$title = $_POST['title'];
				$content = $_POST['content'];
				$bookId = $_GET['bookId'];
				$query = "insert into book".$bookId."chapter (title,content) values ('$title','$content')";
				$result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','添加成功');
					header("Location:chapter.php?bookId=$bookId");
				}else{
				$this->tpl->assign('color',true);
				$this->tpl->assign('message','添加失败');
					return;	
				}
		   }
		   $this->tpl->assign('message','添加失败');
		}
		function content($id){
			$bookId = $_GET['bookId'];
			$query = "SELECT * FROM book".$bookId."chapter where id='$id'";
			$result =$this->mysqli->query($query);
			if($result){
					while ($row = $result->fetch_assoc()) {
				$content = str_replace("\r\n","<br/>", $row['content']);
				$this->tpl->assign('title',$row['title']);
				$this->tpl->assign('content',$content);
				$this->tpl->assign('next',$row['id']+1);
				    }
			$query = "SELECT * FROM book".$bookId."chapter";
			$result =$this->mysqli->query($query);
			if($result && $result->num_rows > 0){
				file_put_contents('test.txt', '为真');
				while ($row=$result->fetch_assoc()) {
					$chapter[] = $row;
				}
				$this->tpl->assign('chapter',$chapter);
			}else{
				$this->tpl->assign('error','无章节');
			}
			}
		}

			public function getRowTotal(){
				$bookId = $_GET['bookId'];
				$this->total = $this->getTotals();
				if(!$this->total){
			$this->tpl->assign('message','无章节');	
			return;
				}
				$num = NUM;
				$cur = isset($_GET['page'])? $_GET['page']:1;
				$Page = new Page($this->total,$cur,$num);
				$offset = $Page->getPageInfo()['row_offset'];
				$query = "SELECT * FROM book".$bookId."chapter limit $offset,$num";
				$result =$this->mysqli->query($query);
				if($result){
					while ($row = $result->fetch_assoc()) {

						$rows[]=$row;
					  }
					  $pageinfo = $Page->getPageInfo();
						$this->tpl->assign('prev_page',$pageinfo['prev_page']?$pageinfo['prev_page']:'false');
						$this->tpl->assign('next_page',$pageinfo['next_page']?$pageinfo['next_page']:'false');
						$this->tpl->assign('end_page',$pageinfo['page_num']);
						$this->tpl->assign('cur',$pageinfo['current_page']);
						//var_dump($rows);
						$this->tpl->assign('rows',$rows);
					}
					
				}

			

		public function del(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$bookId = $_GET['bookId'];
			 $query = "delete from book".$bookId."chapter where id='$id'";
			 $result = $this->mysqli->query($query);
			 if($result && $this->mysqli->affected_rows > 0){
			 	return true;
			 }else{
				$this->tpl->assign('message','删除失败');
					return false;	
			 }
			}
		}
		public function getTotals(){
			$bookId = $_GET['bookId'];
			$query = "select * from book".$bookId."chapter";
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
