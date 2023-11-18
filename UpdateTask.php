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



    <?php
    include_once "./includes/config.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql  = "SELECT * FROM annonce WHERE Id = $id ;";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>

        <div class="flex my-32 justify-center backdrop-blur-2xl border-4 rounded-3xl" style="height: 125vh;width: 30vw; ">
            <div class="">
                <div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
                    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                        <img class="mx-32 w-32" src="pictures/logo.png" alt="">
                        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Modifier l'annonce</h2>
                    </div>

                    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                        <form class="space-y-6" action="includes/Update.php/<?php echo $row['Id'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="flex flex-col">
                                <div class="w-96 h-28 border-4 rounded-2xl flex flex-col justify-center">
                                    <div class="flex flex-col justify-center items-center">
                                        <img src="pictures/add.png" alt="add image" width="70" height="70" class="cursor-pointer">
                                        <input type="file" name="image" id="image" class="border-4 bg-black absolute w-32 mx-12 opacity-0">
                                        <p class="font-bold text-white">Cliquer pour importer une image</p>
                                    </div>
                                </div>
                                <input value="<?php echo $row['Title']; ?>" type="text" name="title" placeholder="Title" class="p-5 placeholder-white font-bold bg-transparent border-4 border-white my-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <input value="<?php echo $row['Price']; ?>" type="number" min=0 name="price" placeholder="Price" class="p-5 bg-transparent placeholder-white font-bold border-4 border-white my-3 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <input value="<?php echo $row['Category']; ?>" type="text" name="category" placeholder="Category" class="p-5 bg-transparent placeholder-white font-bold border-4 border-white my-3 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <input value="<?php echo $row['Description']; ?>" type="text" name="description" placeholder="Description" class="p-5 bg-transparent placeholder-white font-bold border-4 border-white my-3 block w-full h-28 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <input type="hidden" value="<?php echo $row['Id'] ?>" name="id">
                            </div>

                            <div>
                                <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Modifier l'annonce</button>
                            </div>
                            <div class="flex justify-center text-blue-700 font-bold underline">
                                <a href="index.php">Go back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        echo "noting change";
    } ?>

    <script>
        <?php
        if ($task_status === 'uploaded') {
        ?>
            swal({
                title: "Update!",
                text: "Your annonce file has been uploaded!",
                icon: "success",
            });
        <?php
        }

        ?>
    </script>


</body>

</html>