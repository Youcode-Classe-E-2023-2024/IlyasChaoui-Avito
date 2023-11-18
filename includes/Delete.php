<?php

require_once 'config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM annonce WHERE id = ?";
    $stmt = $connection->prepare($sql);

    $stmt->bind_param("i", $id);

    $res = $stmt->execute();

    if ($res) {
        // Redirect to index.php with a query parameter for SweetAlert
        header("location:../index.php?task_status=deleted");
        exit();
    } 
} else {
    echo "Error in deleting task.";
}

?>


