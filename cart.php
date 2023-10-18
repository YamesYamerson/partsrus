<?php
// Starts session
session_start();
//Set variables

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>4140 Assn2 Parts Ordering</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <?php
    // Check if user is signed in and client ID is set in the session
    if (!isset($_SESSION["signin"]) || !isset($_SESSION["client_id"])) {
        // // Redirect the user to the sign-in page
        // header("Location: signin.php");
        // exit();
    }else{
        $client_id = $_SESSION['client_id'];
    }
    ?>

    <!-- Navigation-->
    <?php include 'php/navbar.php'; ?>
    <!-- Header-->
    <header class="bg-dark py-2">
        <div class="container px-4 px-lg-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Cart</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">

                <!-- Display Cart Items -->
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">
                            <!-- Added "d-flex justify-content-end" classes to align the form on the right side -->
                            <div class="col-12">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                    <tr>
                                        <th>Line #</th>
                                        <th>Part #</th>
                                        <th>Part Name</th>
                                        <th>Description</th>
                                        <th>Current Price ($)</th>
                                        <th>Quantity</th>
                                        <th>Subtotal ($)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include 'php/server_login.php';
                                    $totalCost = 0;
                                    $lineNumber = 1;

                                    foreach ($_SESSION['cart'] as $key => $item) {
                                        $partNo = $item['partno'];
                                        $quantity = $item['quantity'];
                                        // Retrieve the cart item details from the database
                                        $stmt = $conn->prepare("SELECT partNo771, partName771, partDescription771, currentPrice771 FROM parts771 WHERE partNo771 = ?");
                                        $stmt->bind_param("i", $partNo);
                                        $stmt->execute();
                                        $stmt->store_result();
                                        $stmt->bind_result($partNo771, $partName771, $partDescription771, $currentPrice771);
                                        $stmt->fetch();
                                        $stmt->close();
                                        $subtotal = $currentPrice771 * $quantity;
                                        $subtotal = number_format((float)$subtotal, 2, '.', '');
                                        $totalCost += $subtotal;
                                        // Output table
                                        echo <<<HTML
                                        <tr>
                                            <td>$lineNumber</td>
                                            <td>$partNo771</td>
                                            <td>$partName771</td>
                                            <td>$partDescription771</td>
                                            <td>$currentPrice771</td>
                                            <td>$quantity</td>
                                            <td>$subtotal</td>
                                            <td><a href="php/remove_from_cart.php?key=$key" class="btn btn-primary btn-sm"><i class="bi bi-cart-dash"></i></a></td>
                                        </tr>
                                        HTML;
                                        $lineNumber++;
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-end fw-bold">Total Cost:</td>
                                        <td colspan="2"><?php echo number_format((float)$totalCost, 2, '.', ''); ?></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div>
                                <button id="submit" type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include 'php/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Set status as "Pending"
    $status = "Pending";

    // First, get the last inserted PO number
    $result = $conn->query("SELECT MAX(poNo771) as last_po_no FROM purchaseorders771");
    $row = $result->fetch_assoc();
    $last_po_no = isset($row['last_po_no']) ? $row['last_po_no'] : 0; // default to 0 if there's no entry yet
    $new_po_no = $last_po_no + 1;

    // Prepare the SQL statement with the new PO number. Note the corrected SQL syntax.
    $stmt2 = $conn->prepare("INSERT INTO purchaseorders771 (poNo771, clientId771, datePO771, status771) VALUES (?, ?, now(), ?)");

    // Bind the variables to the prepared statement
    $stmt2->bind_param("iis", $new_po_no, $client_id, $status);

    // Execute the prepared statement and check if the data was inserted successfully
    if($stmt2->execute()){
        // The record was successfully inserted
    } else {
        // There was an error in the insertion
        echo "Error: " . $stmt2->error;
    }
    // Close statement
    $stmt2->close();
}
?>
