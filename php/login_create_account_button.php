<?php
<<<<<<< HEAD
    $current_page = $_SERVER['REQUEST_URI'];
    if($_SESSION["signin"] == TRUE){     
        $button_output = <<<BUTTONOUTPUT
            <div class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdownSignin" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
=======
    if($_SESSION["signin"] == TRUE){     
        $button_output = <<<BUTTONOUTPUT
            <div class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdownSignin" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Signout</a>
>>>>>>> 12ada200dd7b1c3874ddf0337041eabc7a3508e5
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownSignin">
                    <li><a class="dropdown-item" href="php/signout.php">Sign Out</a></li>
                </ul>
            </div>
            BUTTONOUTPUT;
<<<<<<< HEAD
    }else if($current_page == "/Parts-R-Us/signin.php"){
        $button_output = <<<BUTTONOUTPUT
        <div class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle" id="navbarDropdownSignin" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownSignin">
                <li><a class="dropdown-item" href="create_account.php">Create Account</a></li>
            </ul>
        </div>
        BUTTONOUTPUT;
    }else if($current_page == "/Parts-R-Us/create_account.php"){
        $button_output = <<<BUTTONOUTPUT
        <div class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle" id="navbarDropdownSignin" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownSignin">
                <li><a class="dropdown-item" href="signin.php">Sign In</a></li>
            </ul>
        </div>
        BUTTONOUTPUT;
    }else{
        $button_output = <<<BUTTONOUTPUT
        <div class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle" id="navbarDropdownSignin" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
=======
    }else{
        $button_output = <<<BUTTONOUTPUT
        <div class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle" id="navbarDropdownSignin" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Signin</a>
>>>>>>> 12ada200dd7b1c3874ddf0337041eabc7a3508e5
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownSignin">
                <li><a class="dropdown-item" href="signin.php">Sign In</a></li>
                <li><a class="dropdown-item" href="create_account.php">Create Account</a></li>
            </ul>
        </div>
        BUTTONOUTPUT;
    }
    echo $button_output;
?>