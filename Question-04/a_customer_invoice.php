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
            $sql = "SELECT customers.name,invoice_lists.invoices_id AS invoiceId,orders.id AS orderId FROM invoice_lists LEFT JOIN orders ON invoice_lists.orders_id = orders.id  LEFT JOIN customers ON orders.customers_id = customers.id";
            $result = mysqli_query($con, $sql);

            // Fetch all
            $row = mysqli_fetch_array($result);

            if ($result->num_rows > 0) {
                echo "Invoice No: " . $row["invoiceId"] . "\n  ";
                echo "Customer Name: " .  $row["name"] .  "\n  ";

                // OUTPUT DATA OF EACH ROW
                while ($row = $result->fetch_assoc()) {
                    echo "Invoice Data: " .
                        " - " .
                        "  Order No: " .  $row["orderId"] . "\n  ";
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
