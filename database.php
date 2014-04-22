<?php
	class database{
		private  $db_name;
		private  $db_password = "";
		private  $host_name = "localhost";
		private  $db_user = "root"	;
		function db_connect(){
			if(!mysql_connect($this->host_name,$this->db_user,$this->db_password)){
				echo "ERROR : ".mysql_error();
			}
			else{
				//echo "success";
			}
		}
		function db_select(){
			if(!mysql_select_db($this->db_name)){
				echo "ERROR : ".mysql_error();
			}
			else{
				//echo "success";
			}
		}
		function set_dbname($dbname){
			$this->db_name = $dbname;
		}
		function db_disconnect(){
			mysql_close();
		}
		function execute_query($query){
			if(mysql_query($query)){
				return 1;
			}
			else{
				return mysql_error();
			}
		}
	}
?>