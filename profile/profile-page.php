<?php
error_reporting(E_ERROR | E_PARSE);//To hide the warnings

      // Include the login-page.php file
        // Check if the user is logged in
        session_start();
        if($_SESSION['loggedin']) {
          $started = true;
            // If logged in, redirect to profile page
        } else {
          $started = false;
        }
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pixel Art - Profile-page</title>
  <link rel="icon" type="image/x-icon" href="/Used images/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="\homepage\homepage.css">
</head>

<body>
  <nav class="navbar navbar-expand-md fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand me-auto" href="#"><img src="/Used images/logo.png" alt="logo" width="50px" height="50px"> Pixel Art</a>
      
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="/Used images/logo.png" alt="logo"
              width="50px" height="50px">Pixel Art</h5>
          
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-2 " aria-current="page" href="../homepage/homepage.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="../homepage/images.php">Images</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="../homepage/videos.php">Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="../homepage/3dmodels.php">3d Models</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="../homepage/datasets.php">Datasets</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="../homepage/pdfs.php">Pdfs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="../homepage/codes.php">Codes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="../homepage/sounds.php">Sounds</a>
            </li>
          </ul>
        </div>
      </div>
      <?php
      // Include the login-page.php file
        // Check if the user is logged in
        if($started) {
          echo $_SESSION['username'];
            // If logged in, redirect to profile page
          echo '<a href="http://localhost/profile/profile-page.php" id="profile-button" class="profile-button"><img src="/Used images/userprofile.png" alt="userprofile" width="25px" height="25px"></a>';
        } else {
            // If not logged in, redirect to login page
            echo '<a href="http://localhost/registration/login-page.php" id="profile-button" class="profile-button"><img src="/Used images/userprofile.png" alt="userprofile" width="25px" height="25px"></a>';
        }
        ?>
    </div>
  </nav>
  <?php
include 'D:\PBL Website\registration\partials\_dbconnect.php';
if ($conn) {
    if ($started) {
        // Check user type from the database
            // If user type is 'creator', display the upload button
            echo '<a href="http://localhost/uploads/upload-page.php" class="fixed-button" id="uploadbtn">+</a>';
        } 
    }
else {
    echo "Error establishing database connection";
}
?>
<?php
    session_start();
    include '..\\registration\\partials\\_dbconnect.php'; // Change the path as needed
    include 'D:\PBL Website\uploads\_dbconnect2.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $username = $_SESSION['username'];

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['delete_account'])) {
                // Delete account
                $sql = "DELETE FROM users WHERE username='$username'";
                $sql2 = "DELETE FROM uploads WHERE uploadedby='$username'";
                $result = mysqli_query($conn, $sql);
                $result2 = mysqli_query($conn2, $sql2);
                if($result && $result2) {
                    session_destroy();
                    header("location:http://localhost/homepage/homepage.php"); // Redirect to home page after deleting account
                    exit();
                } else {
                    echo "Error deleting account: " . mysqli_error($conn);
                }
            }
            if(isset($_POST['logout'])) {
                session_destroy();
                header("location:http://localhost/homepage/homepage.php"); // Redirect to home page after deleting account
                exit();
            }
        }
    } else {
        header("location:http://localhost/homepage/homepage.php"); // Redirect to home page if not logged in
        exit();
    }
    ?>

<div class="container-fluid" style="margin-top:85px;">
        <div class="center-content">
            <div>
                <!-- User details section -->
                <div class="user-details">
                    <h2>Your Profile</h2>
                    <p style="font-size:30px;">Username: <?php echo $username; ?></p>
                    <!-- Fetch and display user email -->
                    <?php
                    $email_sql = "SELECT email FROM users WHERE username='$username'";
                    $email_result = mysqli_query($conn, $email_sql);
                    $row = mysqli_fetch_assoc($email_result);
                    $email = $row['email'];
                    ?>
                    <p style="font-size:30px;">Email: <?php echo $email; ?></p>
                    <?php
                    $bio_sql = "SELECT bio FROM users WHERE username='$username'";
                    $bio_result = mysqli_query($conn, $bio_sql);
                    $row = mysqli_fetch_assoc($bio_result);
                    $bio = $row['bio'];
                    ?>
                    <p style="font-size:25px;">Bio: <?php echo $bio; ?></p>
                </div>

                <!-- Edit profile and view personal feed section -->
                <div class="edit-options">
                    <div>
                    <a href="personal_feed.php" class="btn btn-primary">View Personal Feed</a>
                    </div>
                    <div>
                        <a href="edit_profile.php" class="btn btn-secondary">Edit Profile</a>
                    </div>
                    <div>
                    <form method="post">
                            <button type="submit" class="btn btn-warning" name="logout">Logout</button>
                        </form>
                    </div>
                    <div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <button type="submit" class="btn btn-danger" name="delete_account">Delete Account</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<style>
  /* Add this CSS to your existing styles */
  .container{
    display:flex;
    justify-content:center;
    align-items:center;
  }
.edit-options{
    display:flex;
    justify-content: center;
    gap: 10px;
}
h2{
    display:flex;
    justify-content: center;
}
p{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
}
</style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
