<?php
$showAlert = false;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect2.php';
    $name = $_POST["name"];
    $type = $_POST["type"];
    $content = $_POST["content"];
    $description = $_POST["description"];
    $coverImage = "";
    $likes = 0;

    // Check if upload type is not image
    if ($type !== "image") {
        // If upload type is not image, get the cover image from the form
        $coverImage = $_POST["thumbnail"];
    } else {
        // If upload type is image, set the cover image to the uploaded image itself
        $coverImage = $content;
    }

    // Get the username of the logged-in user from the session
    $uploadedBy = $_SESSION['username'];

    $sql = "INSERT INTO `uploads` (`name`, `type`, `content`, `description`, `cover image`, `likes`, `uploadedby`) 
            VALUES ('$name', '$type', '$content', '$description', '$coverImage', $likes, '$uploadedBy')";
    $result = mysqli_query($conn2, $sql);
    if ($result) {
        $showAlert = true;
        // Redirect user to the homepage after successful upload
        header("Location: http://localhost/homepage/homepage.php");
        exit();
    } elseif (!$showAlert) {
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
    <title>Pixel Art - Upload</title>
    <link rel="icon" type="image/x-icon" href="/Used images/logo.png">
    <link rel="stylesheet" href="upload-page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    if($showAlert){
        header("http://localhost/homepage/homepage.php");
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Uploaded successfully!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
     
    }
    ?>
    <div class="container-fluid">
    <a href="http://localhost/homepage/homepage.php" type="button" class="btn-close my-2" aria-label="Close"></a>
        <form action="/uploads/upload-page.php" method="post" class="mx-auto my-0">
            <h4 class="text-center">Upload your Content</h4>
            <div class="mb-3 mt-5">
                <label for="exampleInputname1" class="form-label">Name</label>
                <input type="name" name="name" class="form-control" id="exampleInputname1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label">Content type</label>
                
                <select id="contenttype" name="type" class="form-control" onchange="showThumbnailInput()" aria-describedby="emailHelp">
                    <option value="--">--</option>
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>
                    <option value="3d model">3d Model</option>
                    <option value="dataset">Dataset</option>
                    <option value="pdf">Pdf</option>
                    <option value="code">Code</option>
                </select>
            </div>
            <div class = "mb-3" id="thumbnailInput" style = "display: none;">
                <label for="file">Cover image</label>
                <input type="file" class="form-control" id="exampleInputcontent1" accept = " .jpg, .jpeg" id="thumbnail" name="thumbnail">
            </div>
            <div class="mb-3">
                <label for="exampleInputcontent1" class="form-label" id="content" name="content">Content</label>
                <input type="file" name="content" class="form-control" id="exampleInputcontent1" accept = " .jpg, .jpeg, .png, .txt, .pdf, .csv, .docx, .obj, .stl, .mp4, .mp3, .pptx, .xlsx, .py, .cpp, .html, .php, .css, .js">
            </div>
            <div class="mb-3">
                <label for="exampleDescription1" class="form-label" id="description" name="Description">Description</label>
                <input type="description" name="description" class="form-control" id="exampleInputDescription1">
            </div>
              
            <button type="submit" class="btn btn-primary mt-5">Upload</button>
        </form>
    </div>


    <script>
        function showThumbnailInput() {
            var uploadType = document.getElementById("contenttype").value;
            var thumbnailInput = document.getElementById("thumbnailInput");

            // Show thumbnail input if upload type is not image
            if (uploadType !== "image") {
                thumbnailInput.style.display = "block";
            } else {
                thumbnailInput.style.display = "none";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>