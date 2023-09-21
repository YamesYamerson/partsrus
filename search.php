<<<<<<< HEAD
<?php 
    session_start(); 
    include "server_login.php"
?>
=======
<?php session_start(); ?>
>>>>>>> 12ada200dd7b1c3874ddf0337041eabc7a3508e5
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Parts Search Results</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
<<<<<<< HEAD
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
=======
>>>>>>> 12ada200dd7b1c3874ddf0337041eabc7a3508e5
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <?php include 'php/navbar.php'; ?>
    <?php include 'php/functions/fn_search.php'; ?>
    <div class="container mt-4">
        <?php displaySearchResults(); ?>
    </div>
<<<<<<< HEAD
 
=======
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
>>>>>>> 12ada200dd7b1c3874ddf0337041eabc7a3508e5
</body>
</html>
