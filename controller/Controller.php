<?php
    require 'model/user.php';
    require 'model/userModel.php';
    require 'model/itemModel.php';
    require 'model/orderModel.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class Controller 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->user =  new userModel($this->objconfig);
			$this->item =  new itemModel($this->objconfig);
			$this->order =  new orderModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{
            $act = isset($_GET['act']) ? $_GET['act'] : NULL; 
			switch ($act) 
			{
                case 'feed' :                    
					$this->feed();
					break;					
				case 'login' :					
					$this -> login();
					break;								
				case 'logout' :					
					$this -> logout();
					break;								
				case 'register' :					
					$this -> register();
                    break;	
                case 'getItems':
                    $this->getItems();
                    break;								
                case 'saveOrder':
                    $this->saveOrder();
                    break;								
				default:
                    $this->landing();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}
        
        public function logout(){
            session_start();
            $_SESSION["userDetails"] = "";
            session_destroy();
            $this->pageRedirect('index.php?act=landing');                                   
        }
        public function login(){
            if (isset($_POST['login'])){
                try{
                    $obj=new user();
                    $obj->username=$_POST["username"];
                    $obj->password=md5($_POST["password"]);
                    $result=$this->user->find($obj);
                    $res=$result->fetch_assoc()['username'];
                    if($res){
                        $_SESSION["userDetails"]=$res;
                        $this->feed();
                    }else{
                        $_SESSION["errorMessage"]="credentials do not match";
                        $this->pageRedirect('view/login.php');
                    }
                    
                }
                catch(Exception $e){
                    throw $e;
                }
            }else{
                $this->pageRedirect('view/login.php'); 
            }                                    
        }
        public function feed()
        {
            $this->pageRedirect('view/feed.php');
        }
        public function landing()
        {
            $this->pageRedirect('view/landing.php');
        }
        public function register()
        {
            if (isset($_POST['username'])){
                try{
                    
                    $obj=new user();
                    $obj->username=$_POST["username"];
                    $obj->email=$_POST["email"];
                    $obj->address=$_POST["address"];
                    $obj->age=$_POST["age"];
                    $obj->password=md5($_POST["password"]);
                    $res=$this->user->insert($obj);
                    if($res){
                        //$this->login();
                        echo json_encode(1);
                    }else{
                        echo json_encode("username already exists");
                        //$_SESSION["errorMessage"]="username already exists";
                        //$this->pageRedirect('view/register.php');
                    }
                    
                }
                catch(Exception $e){
                    throw $e;
                }
            }else{
                $this->pageRedirect('view/register.php'); 
            }  
        }
        public function getItems()
        {
            try{
            $res=$this->item->select(0);
            $rows = array();
            while($r = mysqli_fetch_assoc($res)) {
                $rows[] = $r;
            }
            echo json_encode($rows);
            }catch(Exception $e){
                echo $e;
            }
        }
        public function saveOrder()
        {
            try{
                $this->order->insert($_SESSION["userDetails"],$_GET["amt"],$_GET["address"]);
            }catch(Exception $e){
                echo $e;
            }
        }
    }
		
	
?>