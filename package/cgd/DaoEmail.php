<?php
	@include_once('config/config.php');
	@include_once('../config/config.php');
	require_once(__PATH__.'/package/util/class/Database.php');
	
	class DaoEmail {
		private $conn;
		
		public function __construct(){
			$this->conn = new Database();
		}
		
		
		public function __destruct(){
			$this->conn->close();
		}
		
		
		public function save($email){
			// EMAIL
			$data = array();
			$data[] = $this->conn->cleanData($email->getEmail());
			$data[] = $this->conn->cleanData($email->getCount());
			$data[] = $this->conn->cleanData($email->getStatus());
			$query = <<<SQL
				INSERT INTO
					mi_email(email,
								count,
								status)
				VALUES("$data[0]",
						$data[1],
						$data[2])
SQL;
			$query = $this->conn->removeBreakLine($query);
			//$this->conn->fileQuery($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function update($email){
			// EMAIL
			$data = array();
			$data[] = $this->conn->cleanData($email->getEmail());
			$data[] = $this->conn->cleanData($email->getStatus());
			$query = <<<SQL
				UPDATE
					mi_email
					SET
						status = $data[1]
					WHERE
						email = "$data[0]"
					LIMIT 1
SQL;
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function updateCount($email){
			// EMAIL
			$data = array();
			$data[] = $this->conn->cleanData($email->getEmail());
			$query = <<<SQL
				UPDATE
					mi_email
					SET
						count = (count + 1)
					WHERE
						email = "$data[0]"
					LIMIT 1
SQL;
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function get(){
			$query = <<<SQL
				SELECT
					email
					FROM
						mi_email
					WHERE
						status = 1
					ORDER BY
						count ASC
					LIMIT 1
SQL;
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $result->fetch_object();
			$this->conn->free($result);
			$email = new Email($data->email);
			return($email);
		}
	}
?>