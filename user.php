<?php
class user extends connection{
	private $con;
	private $errorArray;

	public function __construct(){
		$this->con = $this->connect();
		$this->errorArray = array();
	}

	public function login($usermail,$userpassword){

		  if(empty(trim($usermail))){
             array_push($this->errorArray,"Please enter a valid mail.");
		  } 
          else if(empty(trim($userpassword))){
            array_push($this->errorArray,"Please enter your password.");
          }
          else{
		$userpassword = md5($userpassword);
		$sql ="SELECT usermail,userpassword FROM users where usermail=? and userpassword=?";

		$stmt = $this->con->prepare($sql);
		$stmt->execute([$usermail,$userpassword]);
		$user = $stmt->fetch();

		

		if($user == null){
			array_push($this->errorArray,"Email or Password is invalid");
		 }
		 return $user;
         }
		

	}



	public function register($username,$usermail,$userpassword){

	  	  if(empty(trim($username))){
            array_push($this->errorArray,"Please enter a username.");
          }
	  	  else if(empty(trim($usermail))){
             array_push($this->errorArray,"Please enter a  mail.");
		  } 
          else if(empty(trim($userpassword))){
            array_push($this->errorArray,"Please enter a password.");
          }
          else if(strlen($userpassword)<8){
            array_push($this->errorArray,"Password should contain at least 8 character.");
          }

          else{
		$this->$username;
		$this->$usermail;
		$this->$userpassword;

		return $this->insertUserDetails($username,$usermail,$userpassword);
	     }
	}

	public function insertUserDetails($username,$usermail,$userpassword){
		$userpassword= md5($userpassword);

		$sql ="INSERT INTO users (username,usermail,userpassword) VALUES(?,?,?)";
		$stmt = $this->con->prepare($sql);

		try{
          $stmt->execute([$username,$usermail,$userpassword]);
          $last_id =$this->con->lastInsertId();
          $user = new stdClass();
          $user->id = $last_id;
          $user->name= $username;
          $user->mail = $usermail;

          return $user;
		}
		catch(Exception $ex){

		}

	}


	public function getError(){
		if(!empty($this->errorArray)){
			$error =$this->errorArray[0];
			return "<div class='alert alert-danger' role='alert'>$error</div>";
		}
	}
}
?>