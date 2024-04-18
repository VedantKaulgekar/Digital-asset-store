<?php
$showAlert = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $usertype = $_POST["usertype"];
    $existsSQL = "SELECT * From `users` WHERE username = '$username' ";
    $result = mysqli_query($conn,$existsSQL);
    $num_exist_rows = mysqli_num_rows($result);
    if($num_exist_rows>0){
        $exists = TRUE;
    }
    else{
        $exists = FALSE;
    }
    
    if(($password==$cpassword) && $exists==FALSE){
        $sql ="INSERT INTO `users` (`email`, `username`, `password`, `usertype`) VALUES ('$email', '$username', '$password', '$usertype')";

        $result = mysqli_query($conn,$sql);
        if($result){
            $showAlert = true;
        }
    }
    elseif(!$showAlert){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>An Error Occured!</strong>Please Try Again!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Art - SignUp</title>
    <link rel="icon" type="image/x-icon" href="/Used images/logo.png">
    <link rel="stylesheet" href="login-page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Account created successfully!</strong> You can login now
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      header("location:http://localhost/registration/login-page.php");
    }
    ?>
    <div class="container-fluid">
    <a href="http://localhost/homepage/homepage.php" type="button" class="btn-close my-2" aria-label="Close"></a>
        <form action="/registration/sign-up.php" method="post" class="mx-auto my-0">
            <h4 class="text-center">SignUp</h4>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label">Username</label>
                <input type="username" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" id="password" name="Password">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputConfirmPassword1" class="form-label" id="cpassword" name="CPassword">Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" id="exampleInputConfirmPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputConfirmPassword1" class="form-label" id="usertype" name="Usertype">Join As</label>
                <input type="radio" name="usertype" value="creator" id="exampleInputUsertype"> Creator
                <input type="radio" name="usertype"  value="explorer" id="exampleInputUsertype"> Explorer
            </div>
            <div class="mt-3">
                    <p id="acc">
                        Already have an account?
                    </p>
                    <a href="http://localhost/registration/login-page.php" >Login</a>

                </div>
              
            <button type="submit" class="btn btn-primary mt-5">SignUp</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>