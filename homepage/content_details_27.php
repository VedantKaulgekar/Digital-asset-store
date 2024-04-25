
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
                <link rel="icon" type="image/x-icon" href="/Used images/logo.png">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="homepage.css">
                <title> Pixel Art-Nissan gtr</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        text-align: center;
                    }
                    .product-container {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        padding: 20px;
                        margin-top: 70px; /* Adjust margin-top to create space for navbar */
                        padding: 20px;
                        text-align: center;
                    }
                    .product-image {
                        width: 300px;
                        height: auto;
                        margin-bottom: 20px;
                    }
                    .product-title {
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 10px;
                    }
                    .product-info {
                        margin-bottom: 20px;
                    }
                    .product-info p {
                        margin: 5px 0;
                    }
                    .product-actions {
                        display: flex;
                        justify-content: center;
                    }
                    .product-actions button {
                        padding: 10px 20px;
                        margin: 0 10px;
                        font-size: 16px;
                        border: none;
                        cursor: pointer;
                        background-color: #007bff;
                        color: #fff;
                        border-radius: 5px;
                    }
                    #downloadButton a{
                      text-decoration:none;
                      color:white;
                    }

                </style>
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
              <a class="nav-link mx-lg-2 active" aria-current="page" href="homepage.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="images.php">Images</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="videos.php">Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="3dmodels.php">3d Models</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="datasets.php">Datasets</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="pdfs.php">Pdfs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="codes.php">Codes</a>
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
                <div class="product-container">
                    <img src="/Used images/nissangtr.png" alt="Nissan gtr" class="product-image">
                    <h2 class="product-title">Nissan gtr</h2>
                    <div class="product-info">
                        <p>Uploaded by: Vedant</p>
                        <p>Description: A 3d model of Nissan gtr</p>
                    </div>
                    <div class="product-actions">
                        <?php
      // Include the login-page.php file
        // Check if the user is logged in
        if($started) {
            // If logged in, redirect to profile page
          echo '<button id="downloadButton"> <a href="/Used images/nissan_skyline_gtr_r35.glb" download> Download Now </a></button>';
        } else {
            // If not logged in, redirect to login page
            echo '<button id="downloadButton"> <a href="http://localhost/registration/login-page.php"> Download Now </a></button>';
        }
        ?>
                        
                    </div>
                </div>
            </body>
            </html>
            