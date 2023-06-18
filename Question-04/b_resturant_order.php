<?php

$result = "";

// CONNECT TO DATABASE 
$dbHost = 'localhost';
$dbUser = 'root';
$dbPw = '';
$dbName = 'question_04';

$con = new mysqli($dbHost, $dbUser, $dbPw, $dbName);

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

// get result from db
if ($result == "") {
    try {
        $sql = "SELECT resturants.title,items.title AS item,orders.id AS orderId FROM orders LEFT JOIN items ON orders.items_id = items.id  LEFT JOIN resturants ON items.resturants_id = resturants.id";
        $result = mysqli_query($con, $sql);

        // Fetch all
        $row = mysqli_fetch_array($result);

        if ($result->num_rows > 0) {
            echo "Resturant Name: " . $row["title"] . "\n  ";

            // OUTPUT DATA OF EACH ROW
            while ($row = $result->fetch_assoc()) {
                echo "Order Data: " .
                    " - " ."  Order No: " .  $row["orderId"] . "\n  ".
                    "  Item Name: " .  $row["item"] . "\n  ";
            }
        } else {
            echo "0 results";
        }

        mysqli_free_result($result);
    } catch (Exception $ex) {
        $result = $ex->getMessage();
    }
}

mysqli_close($con);
?>
