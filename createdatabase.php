<?php
include_once("database.php");
class duplicatetables{
	function create_db($targetDB){
		mysql_query("create database $targetDB");
	}
	function duplicate_tables($sourceDB=NULL, $targetDB=NULL) {
		$a = new database();
		$a->set_dbname($sourceDB);
	    $link = $a->db_connect(); // connect to database
	    $result = mysql_query('SHOW TABLES FROM ' . $sourceDB) or die(mysql_error());
	    while($row = mysql_fetch_row($result)) {
	        mysql_query('DROP TABLE IF EXISTS `' . $targetDB . '`.`' . $row[0] . '`') or die(mysql_error());
	        mysql_query('CREATE TABLE `' . $targetDB . '`.`' . $row[0] . '` LIKE `' . $sourceDB . '`.`' . $row[0] . '`') or die(mysql_error());
	        mysql_query('OPTIMIZE TABLE `' . $targetDB . '`.`' . $row[0] . '`') or die(mysql_error());
	    }
	} // end duplicateTables()
}

?>