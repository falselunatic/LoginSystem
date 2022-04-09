<?php
$showAlert = FALSE;
$showError = FALSE;
if($_SERVER["REQUEST_METHOD"]=='POST'){

include 'partials/_dbconnect.php';
$username = $_POST['username'];
$email = $_POST['email'];
$age = $_POST['age'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
// $exists=FALSE;
// to check whether account already exists or not 
$existSql= "select * from `myusers` where username='$username'";
$result = mysqli_query($conn, $existSql);
$numExistRows = mysqli_num_rows($result);
if($numExistRows > 0)
{
  // $exists= TRUE;
  $showError= "username already exists";
}
else {
// $exists= FALSE;
if($password==$cpassword){
  $hash=password_hash($password, PASSWORD_DEFAULT);
$sql="INSERT INTO `myusers` (`username`, `email`, `age`, `password`) VALUES ('$username', '$email', '$age', '$hash');";
$result = mysqli_query($conn, $sql);
if ($result){
$showAlert = TRUE;
}
}
else{
  $showError= "passwords do not match";
}
}

}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sign-up</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
     <?php
    if($showAlert)
    {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Success!</strong> you have successfully signed up to our website
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div> '; }
    ?>
    <?php
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error!</strong> '. $showError .'
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div> '; }
    ?>
    <div class="container">
      <h1 class="text-center">Sign-up to our website</h1>
      <form action="signup.php" method="POST" >
  <div class="mb-3 col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" maxlength="20" class="form-control" id="username" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 col-md-6">
    <label for="email" class="form-label">E-mail</label>
    <input type="text" maxlength="50" class="form-control" id="email" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 col-md-6">
    <label for="age" class="form-label">Age</label>
    <input type="text" maxlength="2" class="form-control" id="age" name="age" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" maxlength="20" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3 col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" maxlength="20" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">make sure you've written the same password!</div>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">remember me</label>
  </div>
  <button type="submit" class="btn btn-primary">Sign-up</button>
</form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>