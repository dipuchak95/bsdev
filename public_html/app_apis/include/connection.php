<?php
/*ini_set("display_errors",1);
$db = new Dbh();
$conn = $db-> connect();
if($conn){
	echo "done";
}else{
	echo "failled";
}*/
class Dbh
{
	private $dbServername;
	private $dbUsername;
	private $dbPassword;
	private $dbName;

	protected function connect(){
		$this->dbServername ="localhost";
		$this->dbUsername ="u180216366_admin";
		$this->dbPassword ="admin1234";
		$this->dbName ="u180216366_ibox";


		$con=new mysqli($this->dbServername,$this->dbUsername,$this->dbPassword,$this->dbName);
		return $con;
	}


}
?>