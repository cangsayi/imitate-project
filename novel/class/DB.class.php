<?php
	/*==================================================================*/
	/*		文件名:MyDb.class.php                               */
	/*		概要: 数据访问层数据库处理的公共父类.          	    */
	/*		作者: 高洛峰                                        */
	/*		创建时间: 2009-05-25                                */
	/*		最后修改时间:2009-05-25                             */
	/*		copyright (c)2009 lampteacher@gmail.com             */
	/*==================================================================*/
	class DB{
	public static $mysqli=null;
		//protected $showError;

		public function __construct() {
			
		}

		public static function connect(){
			
			if(!self::$mysqli){
				self::$mysqli = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
				
				
			}

			return self::$mysqli;
		}

	   

		public function getVersion() {
			return $this->mysqli->server_info;
		}

		public function getDBSize($dbName, $tblPrefix=null) {
			$sql = "SHOW TABLE STATUS FROM " . $dbName;
			if($tblPrefix != null) {
				$sql .= " LIKE '$tblPrefix%'";
			}
			$result=$this->mysqli->query($sql);
			$size = 0;
			while($row=$result->fetch_assoc())
				$size += $row["Data_length"] + $row["Index_length"];
			return $size;
		}

		public function close() {
			if(self::$mysqli)
				self::$mysqli->close();
			self::$mysqli=null;
		}

		public function __destruct() {
			$this->close();
		}
	}
?>
