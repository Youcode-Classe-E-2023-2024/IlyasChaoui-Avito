<?php
if (isset($_POST['submit'])) {
    require_once 'config.php';

    // Sanitize user input to prevent SQL injection
    $Title = mysqli_real_escape_string($connection, $_POST['title']);
    $Price = mysqli_real_escape_string($connection, $_POST['price']);
    $Category = mysqli_real_escape_string($connection, $_POST['category']);
    $Description = mysqli_real_escape_string($connection, $_POST['description']);
    $id = $_POST['id'];

    // File upload handling
    $targetDir = "../photoimport/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Use prepared statement to prevent SQL injection
            $Update_sql = "UPDATE annonce SET  Title=?, Price=?, Category=?, Description=?, Image=? WHERE Id=?";
            $stmt = mysqli_prepare($connection, $Update_sql);

            if (!$stmt) {
                die("Error in preparing statement: " . mysqli_error($connection));
            }

            mysqli_stmt_bind_param($stmt, "sisssi", $Title, $Price, $Category, $Description, $targetFilePath,$id);

            // Execute the statement
            $result = mysqli_stmt_execute($stmt);

            // Check if the query was successful
            if ($result) {
                // Close the statement
                mysqli_stmt_close($stmt);

                // Close the connection
                mysqli_close($connection);

                // Redirect to a confirmation page
                header("Location: http://localhost/IlyasChaoui-Avito/index.php");
                exit();
            } else {
                echo "Error in inserting data: " . mysqli_stmt_error($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error uploading image to the server.";
        }


    } else {
        $Update_sql = "UPDATE annonce SET Title=?, Price=?, Category=?, Description=? WHERE Id=?";
        $stmt = mysqli_prepare($connection, $Update_sql);
    
        if (!$stmt) {
            die("Error in preparing statement: " . mysqli_error($connection));
        }
    
        mysqli_stmt_bind_param($stmt, "sissi", $Title, $Price, $Category, $Description, $id);
    
        // Execute the statement
        $result = mysqli_stmt_execute($stmt);
    
        // Check if the query was successful
        if ($result) {
            // Close the statement
            mysqli_stmt_close($stmt);
    
            // Close the connection
            mysqli_close($connection);
    
            // Redirect to a confirmation page
            header("Location:http://localhost/IlyasChaoui-Avito/index.php?status=Publiction modified");
            exit();
        } else {
            echo "Error in updating data: " . mysqli_stmt_error($stmt);
        }
    
        // Close the statement
        mysqli_stmt_close($stmt);
    }
     

    // Close the connection
    mysqli_close($connection);
}
?>
