<?php
 class Post extends connection{

    private $con;
	private $errorArray;

	public function __construct(){
		$this->con = $this->connect();
		$this->errorArray = array();
	}


	public function InsertPost($title,$author,$category,$body,$date,$image){


		$sql = "INSERT INTO blog(title,author,category,body,date,image) VALUES(?,?,?,?,?,?)";
		$stmt = $this->con->prepare($sql);

		try{
			$stmt->execute([$title,$author,$category,$body,$date,$image]);
			return true;
		}
		catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
 }

?>
