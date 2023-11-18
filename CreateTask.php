<?php
$warningScript = '';

if (isset($_POST['submit'])) {
    require_once 'includes/config.php';

    // Sanitize user input to prevent SQL injection
    $Title = mysqli_real_escape_string($connection, $_POST['title']);
    $Price = mysqli_real_escape_string($connection, $_POST['price']);
    $Category = mysqli_real_escape_string($connection, $_POST['category']);
    $Description = mysqli_real_escape_string($connection, $_POST['description']);

    // File upload handling
    $targetDir = "photoimport/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Use prepared statement to prevent SQL injection
            $Insert_sql = "INSERT INTO annonce (title, price, category, description, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $Insert_sql);

            if (!$stmt) {
                die("Error in preparing statement: " . mysqli_error($connection));
            }

            mysqli_stmt_bind_param($stmt, "sisss", $Title, $Price, $Category, $Description, $targetFilePath);

            // Execute the statement
            $result = mysqli_stmt_execute($stmt);

            // Check if the query was successful
            if ($result) {
                // Close the statement
                mysqli_stmt_close($stmt);

                // Close the connection
                mysqli_close($connection);

                // Redirect to a confirmation page
                header("Location: index.php?status=Publiction added");
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
        // Set the JavaScript code to the variable

        $warningScript = '<script>
            swal({
                title: "ATTENTION!",
                text: "You need to import a picture!",
                icon: "warning"
            });
        </script>';
    }

    // Close the connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Créer votre annonce</title>
</head>

<body style="background-image: url(pictures/bg.jpg); display: flex;justify-content: center;">

    <div class="flex my-32 justify-center backdrop-blur-2xl border-4 rounded-3xl" style="height: 125vh;width: 30vw; ">
        <div class="">
            <div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img class="mx-32 w-32" src="pictures/logo.png" alt="">
                    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Créer votre
                        annonce</h2>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                        enctype="multipart/form-data">
                        <div class="flex flex-col">
                            <div class="w-96 h-28 border-4 rounded-2xl flex flex-col justify-center">
                                <div class="flex flex-col justify-center items-center">
                                    <img src="pictures/add.png" alt="add image" width="70" height="70"
                                        class="cursor-pointer" id="add">
                                    <img src="pictures/done.png" alt="image added" width="70" height="70"
                                        class="cursor-pointer hidden" id="done">
                                    <input type="file" name="image" id="image"
                                        class="border-4 bg-black absolute w-32 mx-12 opacity-0">
                                    <p class="font-bold text-white">Cliquer pour importer une image</p>
                                </div>
                            </div>
                            <input type="text" name="title" placeholder="Title" required
                                class="p-5 placeholder-white font-bold bg-transparent border-4 border-white my-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <input type="number" min=0 name="price" placeholder="Price" required
                                class="p-5 bg-transparent placeholder-white font-bold border-4 border-white my-3 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <input type="text" name="category" placeholder="Category" required
                                class="p-5 bg-transparent placeholder-white font-bold border-4 border-white my-3 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <input type="text" name="description" placeholder="Description" required
                                class="p-5 bg-transparent placeholder-white font-bold border-4 border-white my-3 block w-full h-28 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div>
                            <button type="submit" name="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                                annonce</button>
                        </div>
                        <div class="flex justify-center text-blue-700 font-bold underline">
                            <a href="index.php">Go back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php echo $warningScript; ?>

</body>

</html>