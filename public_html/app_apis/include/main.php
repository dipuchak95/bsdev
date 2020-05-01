<?php
include'connection.php';
class Maincls extends Dbh{
	public function sendQueryAndGetResult( $sql){    
       
       	$result = $this->connect()->query($sql);	
		return $result;
	}
    
}
?>