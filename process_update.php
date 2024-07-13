<?php

// Check if form submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (isset($_POST['id'], $_POST['title'], $_POST['sname'], $_POST['fname'], $_POST['lname'], $_POST['email'])) {
        // Retrieve POST data
        $id = $_POST['id'];
        $title = $_POST['title'];
        $surname = $_POST['sname'];
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];

        // Proceed with update query
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

        $update = "UPDATE customers SET Title='$title', Surname='$surname', Firstname='$firstname', Lastname='$lastname', Email='$email' WHERE id='$id'";
        
        // Perform update query (replace with prepared statement in production)
        $result = $connection->query($update) or die("could not update record: " . $connection->error);

        // Check if update was successful
        if ($result) {
            echo '<h1 style="color:#0000FF">Record Updated Successfully</h1>';
        } else {
            echo '<h1 style="color:#FF0000">Record Not Updated</h1>';
        }
        
        // Redirect to view page
        header("Location: view.php");
        exit;
    } else {
        // Handle case where required fields are missing
        echo "Error: Required fields are missing.";
    }
} else {
    // Handle case where form was not submitted via POST
    echo "Error: Form was not submitted.";
}
?>
