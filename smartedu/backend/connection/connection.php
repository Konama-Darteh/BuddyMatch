<?php
define('datasource', 'localhost');
define('db', 'alexandria');//databse
define('uName','root');//username
define('pwd','');//password

// Function to establish a database connection
function get_connection() {
    $conn = new mysqli(datasource, uName, pwd, db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Function to close the database connection
function close_connection($conn) {
    $conn->close();
}
?>