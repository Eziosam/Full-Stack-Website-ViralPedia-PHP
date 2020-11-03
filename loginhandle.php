<?php
  if(isset($_POST['Register'])){

    $username = $_POST['username'];
  	$usermail = $_POST['email'];
  	$userpassword = $_POST['password'];

  	$result = $user->register($username,$usermail,$userpassword);

  	if($result != null){
  		 $_SESSION['userLoggedIn'] = $result;
       $_SESSION['usermail'] = $usermail;
  
      header("Location: index.php");
  	}
  	else{
  		echo "<script>console.log('fail')</script>";
  	}
  }

    if(isset($_POST['Login'])){
    $usermail = $_POST['email'];
    $userpassword = $_POST['password'];

    $result = $user->login($usermail,$userpassword);

    if($result != null){
      $_SESSION['userLoggedIn'] = $result;
      $_SESSION['usermail'] = $usermail;
      header("Location: index.php");
    }
    else{
      echo "<script>console.log('fail')</script>";
    }
  }
?>
