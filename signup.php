<?php

include 'partial/_dbconnection.php';

$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];

  $exitSqlquery="SELECT * FROM websitetable WHERE username='$username'";
  $result=mysqli_query($conn,$exitSqlquery);
  $numExistrow=mysqli_num_rows($result);
  if($numExistrow>0){
    $showError="Username Already Exists.Try other username";
  }
  else{
  if($password==$cpassword){
    $hashpassword=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `websitetable` (`username`, `password`, `dateofcreation`) VALUES ( '$username', '$hashpassword', current_timestamp())";
    $result=mysqli_query($conn,$sql);

    if($result){
      $showAlert=true;
    }
  }
  else{
    $showError="Password Don't Match";
  }

}  
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
      <?php
    require 'partial/_nav.php'
    ?>
    <?php
    if($showAlert){
    echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>   Account created Successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showError){
      echo'  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong>'. $showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    
    ?>
        <h3 class="text-center">Signup Here</h3>
    <div class="container">
    <form action="/loginSystem/signup.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">UserName</label>
            <input type="text" maxlength="20" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
           
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
            
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword"> 
        </div>
       
        <button type="submit" class="btn btn-primary">Signup</button>
    </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>