<?php 
include 'wp-config.php';
/*Site Base url */
define("SITEURL","http://localhost/employee/");

class dbmanager{
	/*Database Details*/
	private $host 	= "localhost";
	private $user 	= DB_USER;
	private $pass 	= DB_PASSWORD;
	private $db 	= DB_NAME;
	/*Variables*/
	private $conn;
	private $result;
	private $query;

	function __construct(){
		$this->conn = $this->dbconn();
	}

	// Database Connection 
	function dbconn(){
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
		if ($this->conn->connect_error){
			die('Connection Problem : ' .$this->conn->connect_error);
		}
		else{
			return $this->conn;
		}
	}


	function run_query($query){
		$this->query = $this->conn->query($query);
		if(!$this->query){
			echo "Invalid Query : ".$this->conn->error;
		}
		else{
			return $this->query;
		}
	}
	// Fetch Query Last Auto Generated Inserted ID 
	function last_id(){
		return $this->conn->insert_id;
	}

	// Fetching Single Record
	function fetch_single($query){
		$this->result = $this->conn->query($query);
		if ($this->conn->error) {
			die('Invalid Query :'. $this->conn->error);
		}
		else{
			if ($this->result->num_rows > 0) {
				return $this->result->fetch_array();
			}

		}
	}

	// Fetching Multiple Records 
	function fetch_all( $query){
		$this->result = $this->conn->query($query);
		if ($this->conn->error) {
			die ('Invalid Query: '. $this->conn->error);		
		}
		else{
			if ($this->result->num_rows > 0 ) {
				while($row = $this->result->fetch_assoc()){
					$data[] = $row; 
				}
				return $data; 
			}
			else{
				return $this->conn->error;	
			}
		}
	}

	// count number rows
	function num_rows($result){
		return $this->result->num_rows;
	}

	function escape_string($str){
		return $this->conn->escape_string($str);
	}

	// Quries
	public function insert($table, $inserts) {
		$values = 	array_values($inserts);
		$keys = 	array_keys($inserts);
		return $this->run_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
	}

	public function delete($table, $where , $id) {
		return $this->run_query('DELETE FROM `'.$table.'` WHERE `'.$where.'` = "'.$id.'" ');
	}

	public function select_all($table)
	{
		return $this->run_query('SELECT * FROM `'.$table.'`');
	}

	public function select_where_single($table , $key , $id)
	{
		return $this->fetch_single('SELECT * FROM `'.$table.'` WHERE `'.$key.'` = "'.$id.'" ');
	}
	// select all where key ==
	public function select_where_all($table , $key , $id)
	{
		return $this->run_query('SELECT * FROM `'.$table.'` WHERE `'.$key.'` = "'.$id.'" ');
	}	
	// single update query
	public function update_single_where_key($table , $key , $value , $where , $id)
	{	

		return $this->run_query('UPDATE `'.$table.'` SET `'.$key.'` = "'.$value.'" WHERE `'.$where.'` = '.$id.' ');
	}	



} // End DB Manger Class



function employee_authentic(){
	if (!isset($_SESSION['employee'])) {
		echo '<script type="text/javascript">document.location = "login.php";</script>';
	}
}


function employer_authentic(){
	if (!isset($_SESSION['employer'])) {
		echo '<script type="text/javascript">document.location = "login.php";</script>';
	}
}

function admin_authentication(){
	session_start();
	if (!isset($_SESSION['admin'])) {
		echo '<script type="text/javascript">document.location = "login.php";</script>';
	}
}




function sendmail($to, $name, $subject, $body){

	require 'PHPMailer/class.phpmailer.php';
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->SMTPAuth  = true;
	    $mail->Host      = "mail.it-brainshare.com"; // SMTP server    
	    $mail->Port      = 26;
	    $mail->IsHTML(true);
	    $mail->Username  = "info@it-brainshare.com";
	    $mail->Password  = "Click@123";
	    $mail->From      = "info@it-brainshare.com"; 
	    $mail->FromName  = "testingserver";
	    $mail->AddAddress($to);
	    $mail->Subject   = $subject;    
	    $mail->Body      = $body;   
	    $mail->AddAddress($to, $name);
	    $status = $mail->send();
	    if(!$status) {
	    	echo '<script>alert("Mail Could not sent.");</script>';
	    	echo 'Mailer Error: ';
	    }
	    else{
	    	return true;
	    }
	}

function post($value)
{
	return $_POST[''.$value.''];
}
