<?php
session_start();

$DbHost = 'localhost';
$DbUser = 'root';
$Dbpw = '';
$Dbname = 'glassesrus';

// Connect to server and select database using mysqli
$connection = new mysqli($DbHost, $DbUser, $Dbpw, $Dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if ID is set in the URL
if (!isset($_GET['id'])) {
    die("ID parameter is missing.");
}

$id = $_GET['id'];
$_SESSION['id'] = $id; // Save ID in session for use in process_update.php

// Fetch record with specific id
$query = "SELECT * FROM customers WHERE id='" . $id . "'";
$result = $connection->query($query);

// Check if record exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Display update form with pre-filled data
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Record</title>
    </head>
    <body>
    <h1>Update Record</h1>
    <form name="form" method="post" action="process_update.php"> 
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <p><input type="text" name="title" value="<?php echo $row['Title']; ?>" /></p>
        <p><input type="text" name="sname" value="<?php echo $row['Surname']; ?>" /></p>
        <p><input type="text" name="fname" value="<?php echo $row['Firstname']; ?>" /></p>
        <p><input type="text" name="lname" value="<?php echo $row['Lastname']; ?>" /></p>
        <p><input type="text" name="email" value="<?php echo $row['Email']; ?>" /></p>
        <p><input name="submit" type="submit" value="Update" /></p>
    </form>
    </body>
    </html>
    <?php
} else {
    echo "Record not found.";
}

// Close the connection
$connection->close();
?>
