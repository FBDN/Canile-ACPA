<?php
class DBController {
	private $host = null;
	private $user = null;
	private $password = null;
	private $database = null;
	private $conn = null;
	
	function __construct() {
	    
	    $this->isLocal(true);
		
	}
	
	function isLocal($local = false){
	    if ($local == false){
	        $this->host = "hostingmysql280.register.it";
	        $this->user = "FB9013_foto";
	        $this->password = "fb24111975";
	        $this->database = "fotocastagnoli_net_foto";
	        try {
	            $this->conn = $this->connectDB();
	            $this->selectDB($this->conn);
	        } catch (mysqli_sql_exception $e) {
	            $e->getMessage();
	        }
	        
	    }else{
	        $this->host = "localhost";
	        $this->user = "root";
	        $this->password = "mysql";
	        $this->database = "castagnoli";
	        try {
	            $this->conn = $this->connectDB();
	            if (mysqli_connect_errno())
	            {
	                echo "Failed to connect to MySQL: " . mysqli_connect_error();
	            }
	            $this->selectDB($this->conn,$this->database);
	        } catch (mysqli_sql_exception $e) {
	            $e->getMessage();
	        }
	    }
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function selectDB($conn) {
		mysqli_select_db($conn,$this->database);
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return json_encode($resultset);
		mysqli_close($this->conn);
	}
	
	function numRows($query) {
		$result  = mysqli_query($conn,$query);
		$rowcount = mysqli_num_rows($conn,$result);
		return $rowcount;	
	}
}
?>