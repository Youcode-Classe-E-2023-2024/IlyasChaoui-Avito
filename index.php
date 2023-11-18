<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Your Website</title>
</head>
<style>
    h1 {
      color: transparent;
      background-image: linear-gradient(90deg, rgb(255, 0, 0) 50%, rgb(44, 42, 174) 50%);
      background-position: 100%;
      background-size: 200% 100%;
      background-clip: text;
      -webkit-background-clip: text;
      animation: slide 5s infinite linear; /* Added animation for continuous sliding effect */
    }

    @keyframes slide {
      0% {
        background-position: 100%;
      }
      100% {
        background-position: -100%;
      }
    }
  </style>

<body style="background-image: url(pictures/bg-image.jpg);background-repeat: no-repeat;background-size: cover; width: 100%;height: 100%;background-size: cover;">

    <!-- Navbar -->
    <nav class=" backdrop-blur-3xl fixed z-10 w-full h-20 top-0  p-4 "  style="backdrop-filter: blur(10px);">
        <div class="container mx-auto">
            <div class="flex items-center my-2 justify-between">
                <img class="z-1" src="pictures/logo-index.png" alt="" width="100" height="100">
                <div class="space-x-4 font-black text-2xl ">
                <h1>WELCOME TO MY WEBSITE OF ADDING ANNONCES OF AVITO</h1>  
                </div>
                <a href="CreateTask.php"> <button type="submit" name="submit" class="flex w- justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                        annonce</button>
                </a>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_GET['status'])) {

    ?>

        </div>

    <?php } ?>
    <!-- Main Content -->
    <div class="container mx-auto mt-32">

        <!-- File Upload Form -->


        <!-- Announcements -->
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 flex flex-col justify-center">
            <?php
            require_once 'includes/config.php';

            $query = "SELECT * FROM annonce";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="flex flex-col justify-between items-center w-96 bg-white p-4 shadow-md rounded-md" style="height: 550px;margin-left: 50px;">

                        <img src="<?php echo str_replace('../', '', $row['Image']); ?>" alt="Announcement Image" class="w-full h-80 bg-cover  object-cover mb-2">

                        <h2 class="text-lg font-semibold">
                            <?php echo $row['Title']; ?>

                        </h2>
                        <p class="my-2 text-red-500 font-mono font-bold">
                            <?php echo $row['Price']; ?>
                        </p>
                        <p class="text-gray-600">
                            <?php echo $row['Category']; ?>
                        </p>
                        <p class="text-gray-600">
                            <?php echo $row['Description']; ?>
                        </p>
                        <div class="flex flex-row justify-between" style="margin-left: -120px;">

                            <a class="mx-32 my-10" href="http://localhost/IlyasChaoui-Avito/UpdateTask.php?id=<?php echo $row['Id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <style>
                                        svg {
                                            fill: #000000
                                        }
                                    </style>
                                    <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                </svg></a>
                            <a class="my-10" href="http://localhost/IlyasChaoui-Avito/includes/delete.php?id=<?php echo $row['Id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <style>
                                        svg {
                                            fill: #000000
                                        }
                                    </style>
                                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg></a>
                        </div>
                    </div>
                    <script>
                        <?php
                        if (isset($_GET['status'])) {
                        ?>
                            document.addEventListener('DOMContentLoaded', function() {
                                swal("Good job!", "Annonce added successfully", "success");
                            });
                        <?php
                        }
                        ?>
                    </script>
            <?php
                }
            }

            // Close the connection
            mysqli_close($connection);
            ?>
        </div>

    </div>

    <!-- JavaScript for SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    <?php
    if (isset($_GET['task_status'])) {
        $task_status = trim(strtolower($_GET['task_status']));
        if ($task_status === 'deleted') {
    ?>
            swal({
                title: "Deleted!",
                text: "Your annonce file has been deleted!",
                icon: "success",
            });
    <?php }} ?>
</script>


</body>

</html>


</body>

</html>