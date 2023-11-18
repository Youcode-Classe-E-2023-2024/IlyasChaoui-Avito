<?php
    if (isset($_POST['submit'])) {
        require_once 'includes/config.php';

        // File upload handling
        $targetDir = "photoimport/"; // Create a directory named "uploads" in your project
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Insert image file path into the database
                $insertQuery = "INSERT INTO annonce (image) VALUES ('$targetFilePath')";
                $result = mysqli_query($connection, $insertQuery);

                if ($result) {
                    echo "Image uploaded successfully.";
                } else {
                    echo "Error uploading image to the database.";
                }
            } else {
                echo "Error uploading image to the server.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }

        // Close the connection
        mysqli_close($connection);
    }
    ?>
