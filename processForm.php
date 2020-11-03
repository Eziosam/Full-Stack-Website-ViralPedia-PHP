<?php
  $msg = "";
  $msg_class = "";
  $conn = mysqli_connect("localhost", "root", "", "170204047");

  if (isset($_POST['save_profile'])) {
    // for the database
    $mail = stripslashes($_POST['mail']);
    $name = stripslashes($_POST['username']);
    $address = stripslashes($_POST['address']);
    $phone = stripslashes($_POST['phone']);
    $bio  =  stripslashes($_POST['bio']);
    $profileImageName =  $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "upload/profile/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
        $sql = "UPDATE users SET username='$name',useraddress='$address',userphone= '$phone',image='$profileImageName', bio='$bio' where usermail ='$mail' ";
        if(mysqli_query($conn, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
        } else {
          $msg = "There was an error in the database";
          $msg_class = "alert-danger";
        }
      } else {
        $error = "There was an erro uploading the file";
        $msg = "alert-danger";
      }
    }
  }




    if (isset($_POST['send'])) {
    // for the database
    $mail = stripslashes($_POST['mail']);
    $name = stripslashes($_POST['name']);
    $subject = stripslashes($_POST['subject']);
    $body = stripslashes($_POST['body']);
    
    // Upload image only if no errors
    if (empty($error)) {
 
        $sql = "INSERT INTO contact(name,mail,subject,body) VALUES('$name','$mail','$subject','$body')";
        if(mysqli_query($conn, $sql)){
          $msg = "Your message has been reached. Thank you!";
          $msg_class = "alert-success";
        } else {
          $msg = "Failed to contact.Try again";
          $msg_class = "alert-danger";
        }
   
    }
  }


    if (isset($_POST['save_virus'])) {
    // for the database
    $cat = stripslashes($_POST['category']);
    $name = stripslashes($_POST['name']);
    $vaccine = stripslashes($_POST['vaccine']);
    $family = stripslashes($_POST['family']);
    $body = stripslashes($_POST['bio']);


    $virusImageName = time() . '-' . $_FILES["VirusImage"]["name"];
    // For image upload
    $target_dir = "upload/virus/";
    $target_file = $target_dir . basename($virusImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['VirusImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    
    // Upload image only if no errors
    if (empty($error)) {
            if(move_uploaded_file($_FILES["VirusImage"]["tmp_name"], $target_file)) {
 
        $sql = "INSERT INTO virus(name,category,family,vaccine,body,image) VALUES('$name','$cat','$family','$vaccine','$body','$virusImageName')";
        if(mysqli_query($conn, $sql)){
          $msg = "New Virus Added successfullly!";
          $msg_class = "alert-success";
        } else {
          $msg = "Failed to add virus";
          $msg_class = "alert-danger";
        }
         } else {
        $error = "There was an erro uploading the file";
        $msg = "alert-danger";
      }
   
    }
  }
?>