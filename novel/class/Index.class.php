	
<?php
	/***********************************************************************
	**		文件名:Index.class.php                       
	**		概要: 主页类.                	     
	**		作者: 小飒                       
	**		创建时间: 2020-02-22                 
	**		最后修改时间:2020-02-22    
	***********************************************************************/        
	class Index  {
		private $total=null;
		private $mysqli=false;
		private $tpl=null;
		function __construct($tpl){
			$this->tpl = $tpl;
			$this->mysqli = DB::connect();
			
		}
		function show($id=1){
			$query = "SELECT * from ".TAB_PREFIX."category where pId='$id' order by id asc";
			$result =$this->mysqli->query($query);
			$rows=[];
			if($result){
				while ($row =$result->fetch_assoc()) {
					$cid=$row['id'];
					$query="SELECT * from ".TAB_PREFIX."books where categoryId='$cid'";
					$result1 =$this->mysqli->query($query);
					if($result1 && $this->mysqli->affected_rows > 0){
						$row['count'] = $result1->num_rows;
					}else{
						$row['count'] = 0;
					}
					$rows[]=$row;
				}
			}
			return $rows;

		}
		function getCategoryList($categoryId){
			$cid = $categoryId;

			$query = "SELECT * from ".TAB_PREFIX."category where pId=1 or pId=2 order by id asc";
			$result =$this->mysqli->query($query);
			if($result){
				while ($row =$result->fetch_assoc()) {
					$rows[]=$row;

				}
				$this->tpl->assign('links',$rows);
				$rows=[];
			}
			if(!$cid)return;
			$query = "SELECT * from ".TAB_PREFIX."books where categoryId='$cid'";
			$result =$this->mysqli->query($query);

			if($result){

				while ($row =$result->fetch_assoc()) {
					$aid=$row['authorId'];
					$bid = $row['id'];
					$query = "SELECT * from ".TAB_PREFIX."author where id='$aid'";
					$result1 =$this->mysqli->query($query);
					$row['author'] =$result1->fetch_assoc()['nickname'];
					$query = "SELECT * from book".$bid."chapter where id=1";
					$result1 =$this->mysqli->query($query);
					$substr=mb_substr($result1->fetch_assoc()['content'],0,50);
					$row['content'] =$substr;
					if(!$substr){
						$row['content'] ="无章节";
					}
					
					$rows[]=$row;

				}
				//var_dump($rows);
				$this->tpl->assign('contents',$rows);
				$this->tpl->assign('error','无书籍');
			}


		}

		function getSearch(){
			$name = $_POST['search'];
			$query = "SELECT * from ".TAB_PREFIX."books where name like '%$name%'";
			$result =$this->mysqli->query($query);
			if($result){
				$rows=[];
				while ($row =$result->fetch_assoc()) {
					$aid=$row['authorId'];
					$bid = $row['id'];
					$query = "SELECT * from ".TAB_PREFIX."author where id='$aid'";
					$result1 =$this->mysqli->query($query);
					$row['author'] =$result1->fetch_assoc()['nickname'];
					$query = "SELECT * from book".$bid."chapter where id=1";
					$result1 =$this->mysqli->query($query);
					$substr=mb_substr($result1->fetch_assoc()['content'],0,50);
					$row['content'] =$substr;
					if(!$substr){
						$row['content'] ="无章节";
					}
					
					$rows[]=$row;

				}
				$this->tpl->assign('contents',$rows);
				$this->tpl->assign('error','无此书籍');
			}
		}
	
	}

?>