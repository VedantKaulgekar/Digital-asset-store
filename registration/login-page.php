<?php
$login = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
        
    $sql ="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location:http://localhost/homepage/homepage.php");
        exit;
    }
    elseif(!$login){
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
    <title>Pixel Art - Login</title>
    <link rel="icon" type="image/x-icon" href="/Used images/logo.png">
    <link rel="stylesheet" href="login-page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Login Successful</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container-fluid">
    <a href="http://localhost/homepage/homepage.php" type="button" class="btn-close my-2" aria-label="Close"></a>
        <form action="/registration/login-page.php" method="post" class="mx-auto my-5">
            <h4 class="text-center">Login</h4>
            <div class="mb-3 mt-5">
                <label for="exampleInputUsername1" class="form-label">Username</label>
                <input type="username" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" id="password">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                
            </div>
            <div class="mt-3">
                    <p id="noacc">
                        Don't have an account?
                    </p>
                    <a href="http://localhost/registration/sign-up.php" >SignUp</a>

            </div>
              
            <button type="submit" class="btn btn-primary mt-5">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>