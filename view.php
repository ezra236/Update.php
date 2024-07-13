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

// Fetch all records from the customers table
$query = "SELECT * FROM customers";
$result = $connection->query($query);

// Check if records exist
if ($result->num_rows > 0) {
    echo "<table border=1>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Title</th>";
    echo "<th>Surname</th>";
    echo "<th>Firstname</th>";
    echo "<th>Lastname</th>";
    echo "<th>Email</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['Surname'] . "</td>";
        echo "<td>" . $row['Firstname'] . "</td>";
        echo "<td>" . $row['Lastname'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
        echo '<td><a href="update.php?id=' . $row['id'] . '">Update Record</a></td>';
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}

// Close the connection
$connection->close();
?>
