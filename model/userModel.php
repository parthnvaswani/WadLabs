<?php
	
	class userModel
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
		public function find($obj) {
            try
			{	
				$this->open_db();
				$query=$this->condb->prepare("SELECT * FROM registered WHERE username = ? AND password = ?");
				$query->bind_param("ss",$obj->username,$obj->password);
				$query->execute();
                $res= $query->get_result();
                if(!empty($res)) {
                    $query->close();
				    $this->close_db();
                    return $res;
                }
			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
		}
		public function insert($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("INSERT INTO registered (username,password,email,address,age) VALUES (?, ?, ?, ?, ?)");
				$query->bind_param("ssssi",$obj->username,$obj->password,$obj->email,$obj->address,$obj->age);
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