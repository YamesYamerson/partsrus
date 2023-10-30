<?php
// Starts session
session_start();
// Turn on output buffering
ob_start();
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
        // Redirect the user to the sign-in page
        header("Location: signin.php");
        exit();
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
                <h1 class="display-4 fw-bolder">Purchase Order Submitted!</h1>
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
                            <div class="col-12 border text-center justify-content-center mb-3 rounded">
                                <p class="mt-3 mb-3">Your purchase order has been submitted successfuly! Click <span class="fw-bold">"Home"</span> to navigate to the main page</p> 
                            </div>
                            <div>
                                <button id="submit" type="submit" name="submit" class="btn btn-primary">Home</button>
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

<?php if (isset($_POST['submit'])) {
    header("location: index.php");
}
// End output buffering and flush the buffer
ob_end_flush();
?>
