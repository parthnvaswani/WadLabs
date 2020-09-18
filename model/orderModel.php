<?php
	
	class orderModel
	{
		// set database config for mysql
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;            					
        }
        // open mysql data base
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->condb->connect_error) 
			{
    			die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		// close database
		public function close_db()
		{
			$this->condb->close();
		}
		
		public function insert($user,$amt,$address)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("INSERT INTO ordertable (username,amount,address) VALUES (?, ?,?)");
				$query->bind_param("sds",$user,$amt,$address);
				if(!$query->execute()){
					return false;
				}
				$res= $query->get_result();
				$query->close();
				$this->close_db();
				return true;
			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
		}

	}

?>