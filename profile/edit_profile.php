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

include '..\\registration\\partials\\_dbconnect.php'; // Adjust the path as needed
include 'D:\PBL Website\uploads\_dbconnect2.php';

if ($_SESSION['loggedin']) {
    $username = $_SESSION['username'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['changeUsername'])) {
            $newUsername = $_POST['newUsername'];
            // Update username in the users table
            $sqlUser = "UPDATE users SET username='$newUsername' WHERE username='$username'";
            $resultUser = mysqli_query($conn, $sqlUser);
            // Update username in the uploads table
            $sqlUploads = "UPDATE uploads SET uploadedby='$newUsername' WHERE uploadedby='$username'";
            $resultUploads = mysqli_query($conn2, $sqlUploads);

            if ($resultUser && $resultUploads) {
                $_SESSION['username'] = $newUsername; // Update session username
                $username = $newUsername; // Update username variable
                echo '<div class="alert alert-success alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
        <strong>Username updated successfully!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
        <strong>An Error Occured!</strong> ' . mysqli_error($conn) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            }
        }
    }
        if (isset($_POST['changeEmail'])) {
            $newEmail = $_POST['newEmail'];
            // Update email in the database
            $sql = "UPDATE users SET email='$newEmail' WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
        <strong>Email updated successfully!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
        <strong>An Error Occured!</strong> ' . mysqli_error($conn) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

            }
        }
        if (isset($_POST['changePassword'])) {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            // Validate current password
            $sql = "SELECT password FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if (password_verify($currentPassword, $row['password'])) {
                // Update password in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password='$hashedPassword' WHERE username='$username'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<div class="alert alert-success alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
        <strong>Password updated successfully!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
        <strong>An Error Occured!</strong> ' . mysqli_error($conn) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
        <strong>Current password is incorrect!</strong> ' . mysqli_error($conn) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

            }
        }
        if (isset($_POST['changeBio'])) {
            $newBio = $_POST['newBio'];
            // Update bio in the database
            $sql = "UPDATE users SET bio='$newBio' WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
                <strong>Bio updated successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert" style="z-index: 1050;">
                <strong>An Error Occured!</strong> ' . mysqli_error($conn) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Art - Edit Profile</title>
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
            <a class="navbar-brand me-auto" href="#"><img src="/Used images/logo.png" alt="logo" width="50px"
                    height="50px"> Pixel Art</a>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="/Used images/logo.png"
                            alt="logo" width="50px" height="50px">Pixel Art</h5>

                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 " aria-current="page"
                                href="../homepage/homepage.php">Home</a>
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
                echo '<a href="http://localhost/registration/login-page.php" id="profile-button"
                    class="profile-button"><img src="/Used images/userprofile.png" alt="userprofile" width="25px"
                        height="25px"></a>';
            }
            ?>
        </div>
    </nav>

    <div class="container" style="margin-top:80px;">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="text-center"> <!-- Center the "Edit Profile" heading -->
                <h2>Edit Profile</h2>
            </div>
            <div style="margin-left:50px;">
                <!-- Change Username -->
                <button class="btn btn-primary mt-3" onclick="showInput('username')">Change Username</button>
                <div id="usernameInput" style="display: none;">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="text" class="form-control mt-2" name="newUsername"
                            placeholder="New Username">
                        <button type="submit" class="btn btn-success mt-2" name="changeUsername">Save</button>
                    </form>
                </div>

                <!-- Change Email -->
                <button class="btn btn-primary mt-3" onclick="showInput('email')">Change Email</button>
                <div id="emailInput" style="display: none;">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="email" class="form-control mt-2" name="newEmail"
                            placeholder="New Email">
                        <button type="submit" class="btn btn-success mt-2" name="changeEmail">Save</button>
                    </form>
                </div>

                <!-- Change Password -->
                <button class="btn btn-primary mt-3" onclick="showInput('password')">Change Password</button>
                <div id="passwordInput" style="display: none;">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="password" class="form-control mt-2" name="currentPassword"
                            placeholder="Current Password">
                        <input type="password" class="form-control mt-2" name="newPassword"
                            placeholder="New Password">
                        <button type="submit" class="btn btn-success mt-2" name="changePassword">Save</button>
                    </form>
                </div>

                <!-- Change Bio -->
                <button class="btn btn-primary mt-3" onclick="showInput('bio')">Change Bio</button>
                <div id="bioInput" style="display: none;">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <textarea class="form-control mt-2" name="newBio"
                            placeholder="New Bio"></textarea>
                        <button type="submit" class="btn btn-success mt-2" name="changeBio">Save</button>
                    </form>
                </div>
            </div>
                

            </div>
        </div>
    </div>

    <script>
        function showInput(inputName) {
            var inputDiv = document.getElementById(inputName + 'Input');
            inputDiv.style.display = inputDiv.style.display === 'none' ? 'block' : 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
