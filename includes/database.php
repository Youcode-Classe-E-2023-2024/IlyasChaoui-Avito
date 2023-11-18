<?php

include("./config.php");

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS Avito";
if (mysqli_query($connection, $sql)) {
  echo "Database created successfully <br> ";
} else {
  echo "Error creating database: <br> ";
}

// Select database
mysqli_select_db($connection, 'Avito');


// Create table of annonce
$sql_table_annoce = "CREATE TABLE IF NOT EXISTS Annonce (
    Id INT(6) AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(100) NOT NULL,
    Price INT(50) NOT NULL,
    Category VARCHAR(50) NOT NULL,
    Description VARCHAR(200) NOT NULL,
    Image VARCHAR(200) NOT NULL
    )";

if (mysqli_query($connection, $sql_table_annoce)) {
    echo "Table Annonce created successfully";
} else {
    echo "Error creating table: ";
}


?>