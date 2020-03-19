<?php
	/***********************************************************************
	**		文件名:Book.class.php                       
	**		概要: 书籍类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/        
	class Book {
		private $total=null;
		private $mysqli=false;
		private $tpl=null;
		function __construct($tpl){
			$this->tpl = $tpl;
			$this->mysqli = DB::connect();
			
		}
		public function init(){
			$id=$_SESSION['id'];
			$query="SELECT * FROM ".TAB_PREFIX."author where userId='$id'";
			$result=$this->mysqli->query($query);
			if($result && $this->mysqli->affected_rows > 0){
			$_SESSION['aid']=$result->fetch_assoc()['id'];

			$this->getUserRow();
			}else{
				if(isset($_POST['submit'])){
				$nickname = $_POST['nickname'];
				$userId = $_POST['userId'];
				$hasBook ='0';
				$query = "insert into ".TAB_PREFIX."author values(null,'$nickname','$userId','$hasBook')";
				
				$result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					 $_SESSION['aid']=$this->mysqli->insert_id;
					$this->getUserRow();
					return;
				}else{
				$this->tpl->assign('color',true);
				$this->tpl->assign('message','添加失败');
					return;	
				}

			}

			}
		}
		public function add(){
			if(isset($_POST['submit']) && $_GET['action']=='add'){
				$name = $_POST['name'];
				$authorId = $_POST['authorId'];
				$categoryId = $_POST['categoryId'];
				$type = $_FILES["image"]["type"];
			    $filename="../images/cover/default.jpg";       //默认封面图片
			if($_FILES["image"]["error"] > 0) {
   			 $this->tpl->assign("message","上传失败");
    		}
 		 elseif($type=="image/jpeg" || $type=="image/png" && $_FILES["image"]["size"] <= 500*1024){
 		 	
  	 		$filename=CMS_ROOT."images/cover/".sha1(time()).".jpg";
  	 	move_uploaded_file($_FILES["image"]["tmp_name"],$filename);
}else{
	return;
}			
				$image = '/'.explode(CMS_ROOT,$filename)[1];
		
				$query = "insert into ".TAB_PREFIX."books values(null,'$name','$image','$authorId','$categoryId',CURRENT_TIMESTAMP)";
								
				$result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$id=$this->mysqli->insert_id;
					$query="SELECT * FROM ".TAB_PREFIX."books where id='$id'";
					$result = $this->mysqli->query($query);
					if($result){
						while ($row=$result->fetch_assoc()) {
							$aid = $row['authorId'];
						}
						$query=$query = "update ".TAB_PREFIX."author set hasBook='1' where id='$aid'";
							
						$this->mysqli->query($query);	
					}
			$query="CREATE TABLE book".$id."chapter (
  id INT(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(40) NOT NULL,
  content text NOT NULL,
  bookId INT(7) NOT NULL DEFAULT '$id',
  authorId INT(7) NOT NULL DEFAULT '$aid',
  PRIMARY KEY (id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8";	
				//创建书籍章节表;
$result = $this->mysqli->query($query);

if($result)		{
	$this->tpl->assign('message','添加书籍成功，创建书籍章节表成功');
	}

					
				}else{

				$this->tpl->assign('color',true);
				$this->tpl->assign('message','添加失败');
					
				}

			}
			
			$query="SELECT * FROM ".TAB_PREFIX."author";
					$result =$this->mysqli->query($query);
					if($result){
						while ($rowa = $result->fetch_assoc()) {
							$rowas[]=$rowa;
						}
					}
				//	var_dump($rowas);
		$query="SELECT * FROM ".TAB_PREFIX."category";
					$result =$this->mysqli->query($query);
					if($result){
						while ($rowc = $result->fetch_assoc()) {
							$rowcs[]=$rowc;
						}
					}

		$this->tpl->assign('rowas',$rowas);
		$this->tpl->assign('rowcs',$rowcs);
		}
			public function getRowTotal(){
				$this->total = $this->getTotals();
				if(!$this->total){
			$this->tpl->assign('message','无书籍');	
			return;
				}
				$num =NUM;
				$cur = isset($_GET['page'])? $_GET['page']:1;
				$Page = new Page($this->total,$cur,$num);
				$offset = $Page->getPageInfo()['row_offset'];
				$query = "SELECT * FROM ".TAB_PREFIX."books limit $offset,$num";

				if(isset($_POST['submit'])){
					$search=$_POST['search'];
					if(!empty($search)){
						$query="SELECT * FROM ".TAB_PREFIX."books where name like '%$search%' limit $offset,$num";
					}
				}
			
				$result =$this->mysqli->query($query);

				if($result){
					while ($row = $result->fetch_assoc()) {	
						$aid = $row['authorId'];
						$query="SELECT * FROM ".TAB_PREFIX."author where id='$aid'";
						
						$result1 =$this->mysqli->query($query);
						if($result1){
							while ($rowa = $result1->fetch_assoc()){
								$a[]=$rowa;
								$row['authorName']=$a;
								$a=[];

							}
						}
						$cid = $row['categoryId'];
						$query="SELECT * FROM ".TAB_PREFIX."category where id='$cid'";
						$result2 =$this->mysqli->query($query);
						if($result2){
							while ($rowc = $result2->fetch_assoc()){
								$a1[]=$rowc;
								$row['categoryName']=$a1;
								$a1=[];

							}
						}
				$row['createTime']=date('Y-m-d',strtotime($row['createTime']));
								$rows[]=$row;	
								
						}						
						//var_dump($rows);
						$pageinfo = $Page->getPageInfo();
						$this->tpl->assign('prev_page',$pageinfo['prev_page']?$pageinfo['prev_page']:'false');
						$this->tpl->assign('next_page',$pageinfo['next_page']?$pageinfo['next_page']:'false');
						$this->tpl->assign('end_page',$pageinfo['page_num']);
						$this->tpl->assign('cur',$pageinfo['current_page']);
						//var_dump($rows);
						$this->tpl->assign('rows',$rows);
				}else{
					$this->tpl->assign('message','查询失败！');
				}
				
		}
			public function  edit(){
			if(!empty($_POST['submit'])){
				$id = $_POST['id'];
				$name = $_POST['name'];
				$authorId = $_POST['authorId'];
				$categoryId = $_POST['categoryId'];
				$query ="update ".TAB_PREFIX."books set name='$name',categoryId='$categoryId' where id ='$id'";
				file_put_contents('test.txt', $query);
				 $result = $this->mysqli->query($query);
				if($result && $this->mysqli->affected_rows > 0){
					$this->tpl->assign('message','修改成功');
				
				}else{
					$this->tpl->assign('message','修改失败');
				}
			}
				$id = $_GET["id"];
				$query = "select * FROM ".TAB_PREFIX."books where id='$id'";
				$result = $this->mysqli->query($query);
				while ($row = $result->fetch_assoc()) {
					$this->tpl->assign('id',$row['id']);
					$this->tpl->assign('name',$row['name']);
					$this->tpl->assign('cover',$row['cover']);
					$this->tpl->assign('authorId',$row['authorId']);
					$this->tpl->assign('categoryId',$row['categoryId']);
					
				}
				$query="SELECT * FROM ".TAB_PREFIX."author";
					$result =$this->mysqli->query($query);
					if($result){
						while ($rowa = $result->fetch_assoc()) {
							$rowas[]=$rowa;
						}
					}
				//	var_dump($rowas);
				$query="SELECT * FROM ".TAB_PREFIX."category";
					$result =$this->mysqli->query($query);
					if($result){
						while ($rowc = $result->fetch_assoc()) {
							$rowcs[]=$rowc;
						}
					}

				$this->tpl->assign('rowas',$rowas);
				$this->tpl->assign('rowcs',$rowcs);
		
		
		}

		public function del(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			 $query = "delete from ".TAB_PREFIX."books where id='$id'";
			 $result = $this->mysqli->query($query);
			 if($result && $this->mysqli->affected_rows > 0){
			 	$query ="DROP TABLE book".$id."chapter";
			 	 $result = $this->mysqli->query($query);
			 	 if($result){
			 	 $this->tpl->assign('message','删除成功');

			 	 }
			 	return true;
			 }else{
				$this->tpl->assign('color',true);
				$this->tpl->assign('message','删除失败');
					return false;	
			 }
			}
		}
		public function getTotals(){

			$query = "select * from ".TAB_PREFIX."books";
			if(isset($_POST['submit']) &&$_GET['action']=='search'){
		$search=$_POST['search'];
		//var_dump($search);
		if(!empty($search)){
		$query= "select * from ".TAB_PREFIX."books where name like '%$search%'";

				}
			}
			
			$result = $this->mysqli->query($query);
			if($result){
				$total = $result->num_rows;
				return $total;
			}else{
		    return false;
			}
			
		}
		public function getUserTotals(){
			$aid=$_SESSION['aid'];
			$query = "select * from ".TAB_PREFIX."books where authorId='$aid'";
			$result = $this->mysqli->query($query);
			if($result && $this->mysqli->affected_rows > 0){
				$total = $result->num_rows;
				
				return $total;
			}else {
				$this->tpl->assign('hasbook','没有书籍');

			}
		
		}
			public function getUserRow(){
				$this->total = $this->getUserTotals();
				if(!$this->total)return;
				$num =NUM;
				$cur = isset($_GET['page'])? $_GET['page']:1;
				$Page = new Page($this->total,$cur,$num);
				$offset = $Page->getPageInfo()['row_offset'];
				$aid=$_SESSION['aid'];
				$query = "SELECT * FROM ".TAB_PREFIX."books where authorId='$aid' limit $offset,$num";
				$result =$this->mysqli->query($query);

				if($result){
					while ($row = $result->fetch_assoc()) {	
						$query="SELECT * FROM ".TAB_PREFIX."author where id='$aid'";
						
						$result1 =$this->mysqli->query($query);
						if($result1){
							while ($rowa = $result1->fetch_assoc()){
								$a[]=$rowa;
								$row['authorName']=$a;
								$a=[];

							}
						}
						$cid = $row['categoryId'];
						$query="SELECT * FROM ".TAB_PREFIX."category where id='$cid'";
						$result2 =$this->mysqli->query($query);
						if($result2){
							while ($rowc = $result2->fetch_assoc()){
								$a1[]=$rowc;
								$row['categoryName']=$a1;
								$a1=[];

							}
						}
				$row['createTime']=date('Y-m-d',strtotime($row['createTime']));
								$rows[]=$row;	
								
						}						
						//var_dump($rows);
						$pageinfo = $Page->getPageInfo();
						$this->tpl->assign('prev_page',$pageinfo['prev_page']?$pageinfo['prev_page']:'false');
						$this->tpl->assign('next_page',$pageinfo['next_page']?$pageinfo['next_page']:'false');
						$this->tpl->assign('end_page',$pageinfo['page_num']);
						$this->tpl->assign('cur',$pageinfo['current_page']);
						//var_dump($rows);
						$this->tpl->assign('rows',$rows);
				}else{
					$this->tpl->assign('message','查询失败！');
				}
				
		}

	}
?>
