<?php 
	$realpath=realpath(dirname(__FILE__));

	include_once $realpath."/../config/config.php";
	class Database
	{
		
		public $host    =DB_HOST;
		public $user    =DB_USER;
		public $password=DB_PASS;
		public $db_name =DB_NAME;

		public $link;
		public $error;

		function __construct()
		{
			$this->dbConnect();
			
		}

		private function dbConnect()
		{
			$this->link=new mysqli($this->host,$this->user,$this->password,$this->db_name);

			if (!$this->link) {
				$this->error ="Connection fail".$this->link->connect_error;
		        return false;
			}

		}

		///===select query ====
		public function select($query){

			$result=$this->link->query($query) or die ($this->link->error.__LINE__);
			if ($result->num_rows >0) {
				return $result;
			}else{
				return false;
			}
		}



		//========insert data==========
		public function insert($query){
			$result=$this->link->query($query) or die ($this->link->error.__LINE__);
			if ($result) {
				return $result;
			}else{
				return false;
			}

		}



//======update data======
		public function update($query){
			$result=$this->link->query($query) or die ($this->link->error.__LINE__);
			if ($result) {
				return $result;
			}else{
				return false;
			}

		}
		///=====delete=====
		public function delete($query){
			$result=$this->link->query($query) or die ($this->link->error.__LINE__);
			if ($result) {
				return $result;
			}else{
				return false;
			}

		}



	}

	


 ?>
