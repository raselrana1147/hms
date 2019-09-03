<?php 

	
	class Format
	{
		
		public function validation($data){
			$data  =trim($data);
			$data  = stripslashes($data);
			$data  = htmlspecialchars($data);
			return $data;
		}
		
		public function shortenContent($data, $start,$end){

			$result=substr($data, $start,$end);
			return $result;
		}

		public function dateformat($date){
			return date('F j,Y,g:i a',strtotime($date));
		}

		public function tittlename(){
			$path=$_SERVER["SCRIPT_FILENAME"];
			$tittle=basename($path,'.php');
			return ucwords($tittle);
		}

	}


 ?>