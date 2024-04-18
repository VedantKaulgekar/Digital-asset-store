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
  <title>Pixel Art</title>
  <link rel="icon" type="image/x-icon" href="/Used images/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="homepage.css">
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
              <a class="nav-link mx-lg-2" href="cart.php">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="likedfeed.php">Liked Feed</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="notifications.php">Notifications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off-head nav2-off mx-lg-2" href="#">Categories ➤</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="images.php">Images</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="videos.php">Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="sounds.php">Sounds</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="3dmodels.php">3D Models</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="datasets.php">Datasets</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="pdfs.php">Pdfs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="codes.php">Codes</a>
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
  <nav class="navbar2">
    <div>
      <ul class="navbar2-items">
        <li id="nav2head">Categories ➤</li>
        <li class="navbar2-link"><a href="images.php">Images</a></li>
        <li class="navbar2-link"><a href="videos.php">Videos</a></li>
        <li class="navbar2-link"><a href="sounds.php">Sounds</a></li>
        <li class="navbar2-link"><a href="3dmodels.php">3D Models</a></li>
        <li class="navbar2-link"><a href="datasets.php">Datasets</a></li>
        <li class="navbar2-link"><a href="pdfs.php">Pdfs</a></li>
        <li class="navbar2-link"><a href="codes.php">Codes</a></li>
    </ul>
    </div>
  </nav>
  <?php
include 'D:\PBL Website\registration\partials\_dbconnect.php';
if ($conn) {
    if ($started) {
        // Check user type from the database
        $username = $_SESSION['username']; // Assuming username is stored in the session
        $sql = "SELECT usertype FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $userType = $row['usertype'];

            // If user type is 'creator', display the upload button
            if ($userType === 'creator') {
                echo '<a href="http://localhost/uploads/upload-page.php" class="fixed-button" id="uploadbtn">+</a>';
            }
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
    }
} else {
    echo "Error establishing database connection";
}
?>
<?php
include 'D:\PBL Website\uploads\_dbconnect2.php';

$sql = "SELECT contentid, content, name, description, `cover image`, likes, downloads, uploadedby FROM uploads WHERE type='pdf'";
$result = mysqli_query($conn2, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="content-container">';
    foreach ($result as $row) {
        $contentId = $row['contentid'];
        $name = $row['name'];
        $description = $row['description'];
        $thumbnail = $row['cover image'];
        $likes = $row['likes'];
        $downloads = $row['downloads'];
        $uploadedBy = $row['uploadedby'];
        $content = $row['content'];

        // Check if product display page exists
        $productPagePath = 'content_details_' . $contentId . '.php'; // Valid file name
        if (!file_exists($productPagePath)) {
            // If product display page does not exist, create it
            $productPageContent = '
            <?php
            error_reporting(E_ERROR | E_PARSE);//To hide the warnings

      // Include the login-page.php file
        // Check if the user is logged in
        session_start();
        if($_SESSION[\'loggedin\']) {
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
                <title> Pixel Art-' . $name . '</title>
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
              <a class="nav-link mx-lg-2" aria-current="page" href="homepage.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="cart.php">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="likedfeed.php">Liked Feed</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="notifications.php">Notifications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off-head nav2-off mx-lg-2" href="#">Categories ➤</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="images.php">Images</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="videos.php">Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="sounds.php">Sounds</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="3dmodels.php">3D Models</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="datasets.php">Datasets</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="pdfs.php">Pdfs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav2-off mx-lg-2" href="codes.php">Codes</a>
            </li>
          </ul>
        </div>
      </div>
      <?php
      // Include the login-page.php file
        // Check if the user is logged in
        if($started) {
          echo $_SESSION[\'username\'];
            // If logged in, redirect to profile page
          echo \'<a href="http://localhost/profile/profile-page.php" id="profile-button" class="profile-button"><img src="/Used images/userprofile.png" alt="userprofile" width="25px" height="25px"></a>\';
        } else {
            // If not logged in, redirect to login page
            echo \'<a href="http://localhost/registration/login-page.php" id="profile-button" class="profile-button"><img src="/Used images/userprofile.png" alt="userprofile" width="25px" height="25px"></a>\';
        }
        ?>
    </div>
  </nav>
  <nav class="navbar2">
    <div>
      <ul class="navbar2-items">
        <li id="nav2head">Categories ➤</li>
        <li class="navbar2-link"><a href="images.php">Images</a></li>
        <li class="navbar2-link"><a href="videos.php">Videos</a></li>
        <li class="navbar2-link"><a href="sounds.php">Sounds</a></li>
        <li class="navbar2-link"><a href="3dmodels.php">3D Models</a></li>
        <li class="navbar2-link"><a href="datasets.php">Datasets</a></li>
        <li class="navbar2-link"><a href="pdfs.php">Pdfs</a></li>
        <li class="navbar2-link"><a href="codes.php">Codes</a></li>
    </ul>
    </div>
  </nav>
  <?php
include \'D:\PBL Website\registration\partials\_dbconnect.php\';
if ($conn) {
    if ($started) {
        // Check user type from the database
        $username = $_SESSION[\'username\']; // Assuming username is stored in the session
        $sql = "SELECT usertype FROM users WHERE username=\'$username\'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $userType = $row[\'usertype\'];

            // If user type is \'creator\', display the upload button
            if ($userType === \'creator\') {
                echo \'<a href="http://localhost/uploads/upload-page.php" class="fixed-button" id="uploadbtn">+</a>\';
            }
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
    }
} else {
    echo "Error establishing database connection";
}
?>
                <div class="product-container">
                    <img src="/Used images/' . $thumbnail . '" alt="' . $name . '" class="product-image">
                    <h2 class="product-title">' . $name . '</h2>
                    <div class="product-info">
                        <p>Uploaded by: ' . $uploadedBy . '</p>
                        <p>Description: ' . $description . '</p>
                    </div>
                    <div class="product-actions">
                        <button id="likeButton">Like</button>
                        <button id="downloadButton"> <a href="/Used images/'.$content.'" download> Download Now </a></button>
                    </div>
                </div>
            </body>
            </html>
            ';




            // Write content to product display page
            if (file_put_contents($productPagePath, $productPageContent) === false) {
                // If file creation fails, display an error message
                echo "Failed to create product display page for content ID $contentId.<br>";
                continue; // Skip to the next product
            }
        }

        ?>
        <div class="content-item">
            <a href='<?php echo $productPagePath; ?>' class="content-link">
                <img src='/Used images/<?php echo $thumbnail; ?>' alt='<?php echo $name; ?>' class="content-image">
                <div class="content-overlay">
                    <h3><?php echo $name; ?></h3>
                    <p class="description"><?php echo $description; ?></p>
                    <p class="uploaded-by">Uploaded by: <?php echo $uploadedBy; ?></p>
                    <div class="content-details">
                        <p class="likes">Likes: <?php echo $likes ?></p>
                        <p class="downloads">Downloads: <?php echo $downloads ?></p>
                    </div>
                </div>
            </a>
        </div>
        <?php
    }
    echo '</div>'; // Close content-container
} else {
    echo "No content available.";
}
?>



<style>
  /* Add this CSS to your existing styles */
.content-container{
  display: flex;
  flex-wrap: wrap;
  margin-top:100px;
  gap:10px;
  justify-content:center;
}
.content-overlay h3 {
    font-size: 18px; /* Decrease font size for name */
}

.content-overlay .description {
    font-size: 14px; /* Decrease font size for description */
}

.content-overlay .uploaded-by {
    font-size: 12px; /* Decrease font size for uploaded by */
    margin-top: 5px; /* Add margin */
}

.content-item {
    position: relative;
    max-width: 20%; /* Adjust as needed */
    min-width: 20%;
}

.content-link {
    display: block;
    position: relative;
}

.content-image {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
}

.content-item:hover .content-overlay {
    opacity: 1;
}

.content-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 10px;
}

.content-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
}


</style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>