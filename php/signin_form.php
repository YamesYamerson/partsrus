<?php 
<<<<<<< HEAD
// Accesses MAMP server and MySQL server and accesses
require_once 'php/server_login.php';
// Initialize variables
$errors = array (
    'client_id_error' => '',
    'client_username_error' => '',
    'password_error' => '',
    );
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Form submitted variables with whitespace removed
    $client_id_entry = trim($_POST["ClientId"]);
    $password_entry = trim($_POST["Password"]);
    $client_name_entry = trim($_POST["ClientUsername"]);
    // Form submitted variable string lengths
    $client_id_length = strlen($client_id_entry);
    $client_name_length = strlen($client_name_entry);
    $password_length = strlen($password_entry);
}
// Create a prepared statement to get data from the clients771 table
$stmt = $conn->prepare("SELECT clientId771, clientName771, clientCompPassword771, username771 FROM clients771");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($client_id, $client_name, $password, $username);
// Error handling boolean values
$id_valid = FALSE;
$id_exists = FALSE;
$username_valid = FALSE;
$username_exists = FALSE;
$password_valid = FALSE;
$password_verified = FALSE;

// Loop through users to check for existing usernames and passwords
while ($stmt->fetch()) {
    if(empty($client_name_entry)){
        // Checks if Client ID entry is valid
        if($id_valid === FALSE && $client_id_length == 5){
            $id_valid = TRUE;
        }else{
            $errors['client_id_error'] = "Client ID must be 5 digits!";
            break;
        }
        // Checks to see if Client ID entry is in DB
        if ($id_valid === TRUE) {
            if($client_id_entry == $client_id){
                $id_exists = TRUE;
            }else{
                $errors['client_id_error'] = "Client id not found!";
=======
    //Accesses MAMP server an MySql server and accesses 
    require_once 'php/server_login.php';
    // Variables
    $status = 1; // 0 for continue, 1 for exit, quits by default unless name exists in database
    $username_status = 1; // 0 for found, 1 for not found - not found by default
    // Form submitted variables with whitespace removed
    $client_id_entry = trim($_POST["ClientId"]);
    $password_entry = trim($_POST["Password"]); //gets password form post and cleans whitespace
    // Form submitted variable string lengths
    $client_id_length = strlen($client_id_entry); //gets string length of name from form submit
    $password_length = strlen($password_entry); //gets string length of title from form submit
    // //Creates prepared statement to get data from artists table
    $stmt = $conn -> prepare("SELECT clientId771, clientName771, clientCompPassword771 FROM clients771");
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($client_id, $client_name, $password);
    // Loops through users to check for existing usernames and passwords
    while ($stmt -> fetch()) {
        //Checks username to see if it is compatible with database
        if($client_id_entry != null && $client_id_length < 31 && $client_id_length > 0){
            $error = '';
            $status = 0;
        }else{
            $error = "Username must be between 1-30 characters!\n";
            $status = 1;
            break;
        }
        //Checks to see if username was verified as valid
        if($status == 0){
            if($client_id_entry == $client_id){
                $username_status = 0;
                $error = '';
            }else{
                $error = "Client ID not found, please try again!"; //error if name does not exist in database
                $status = 1;
            }
        }
        //Checks password to see if it is compatible with database
        if($username_status == 0){
            if($password_entry != null && $password_length < 21 && $password_length >= 7){
                $error = '';
                $status = 0;
            }else{
                $error = "Password must be between 7-20 characters!\n";
                $status = 1;
            }
        }
        // Checks to see if input was verified successfully
        if($client_id_entry == $client_id){ 
            if (password_verify($password_entry, $password)){
                $pass_ver = TRUE;
            }
            if($pass_ver == TRUE){
                $status = 0;
                $_SESSION["signin"] = TRUE;
                $_SESSION["client_id"] = $client_id;
                header('Location: index.php');
            }else{
                $error = "Password is incorrect, please try again!\n";
                $status = 1;
>>>>>>> 12ada200dd7b1c3874ddf0337041eabc7a3508e5
                break;
            }
        }
    }
<<<<<<< HEAD
    if(empty($client_id_entry)){
        // Checks to see if Client Username entry is valid
        if($username_valid === FALSE && ($client_name_length < 1 || $client_name_length > 30)){
            $errors['client_username_error'] = "Client Username must be 1-30 characters!";
            break;
        }
        // Checks to see if Client Username entry is in DB
        if($client_name_entry == $username){
            $username_exists = TRUE;
            echo "username exists!!!";
        }
    }
    // Checks to see if use has input text for ClientID and ClientUsername (unsupported action)
    if(!empty($client_id_entry && !empty($client_name_entry))){
        unset($errors);
        $errors['client_id_error'] = "Enter text in one field ONLY: Client Id or Client Username";
    }
    // Checks to see if password is valid format
    if($id_exists === TRUE || $username_exists === TRUE){
        if ($password_length >= 7 && $password_length <= 20) {
            $password_valid = TRUE;
        }else{
            $errors['password_error'] = "Password must be between 7-20 characters!";
            break;
        }
    }
    if($password_valid === TRUE){
        
        if(password_verify($password_entry, $password)) {
            $password_verified = TRUE;
            session_start(); // Start the session here
            $_SESSION["signin"] = TRUE;
            $_SESSION["client_id"] = $client_id;
            header('Location: index.php');
            exit; // Exit to prevent further script execution
        }else{
            $errors['password_error'] = "Incorrect Password!";
            break;
        }
    }
}
// Outputs error message if username is not in database
if($username_exists == FALSE ){
    $errors['client_username_error'] = "Username not found!";

}
// Clears errors on empty form (FIX LATER)
if(!isset($client_id_entry) && !isset($client_name_entry)){
    unset($errors);
}
    
$signin_output = <<<SIGNINCARD
<div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-2">
    <h1 class="fw-bolder text-center">Sign-In</h1>
    <div class="row gx-5 justify-content-center">
        <div class="col-lg-8 col-xl-6 ">   
        <!-- Outputs Error Message --> 
        <form method="post">
            <br/>
            <p class="text-center text-danger"> {$errors['client_id_error']} </p>
            <div class="form-floating mb-2">
                <input type="text" name="ClientId" id="floatingClientId" placeholder="Client ID" class="form-control" value="$client_id_entry" />
                <label for="floatingClientId">Enter Client ID</label>
            </div>
            <p class="text-center">or</p>
            <p class="text-center text-danger"> {$errors['client_username_error']} </p>
            <div class="form-floating mb-2">
                <input type="text" name="ClientUsername" id="floatingUsername" placeholder="Client Name" class="form-control" value="$client_name_entry" />
                <label for="floatingUsername">Enter Client Username</label>
            </div>
            <p class="text-center text-danger"> {$errors['password_error']} </p>
            <div class="form-floating mb-2">
                <input type="password" name="Password" id="floatingPassword" class="form-control" placeholder="Enter Company Password" value="$password_entry" />
                <label for="floatingPassword">Enter Password</label>
            </div>
            <br>
            <div class="d-grid"><input name="Submit" type="submit" class="btn btn-secondary btn-lg" value="Submit" /></div>                           
        </form>
    </div>
</div>
SIGNINCARD;
echo $signin_output; // Outputs Sign-In form

$conn->close(); // Close connection
?>
=======
    // Clear error on refresh or navigation
    if(!isset($_POST["Submit"])){
        $error = '';
    }
    
    $signin_output = <<<SIGNINCARD
    <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-2">
        <h1 class="fw-bolder text-center">Sign-In</h1>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 ">   
            <!-- Outputs Error Message --> 
            <p class="text-center text-danger"> $error </p>
            <form method="post">
                <br />
                <div class="form-floating mb-2">
                    <input type="text" name="ClientId" id="floatingUsername" placeholder="Client ID" class="form-control" value="$client_id_entry" />
                    <label for="floatingUsername">Enter Client ID</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" name="Password" id="floatingPassword" class="form-control" placeholder="Enter Company Password" value="$password_entry" />
                    <label for="floatingPassword">Enter Password</label>
                </div>
                <br>
                <div class="d-grid"><input name = "Submit" type ="Submit" class="btn btn-secondary btn-lg" value="Submit" /></div>                           
            </form>
        </div>
    </div>
    SIGNINCARD;
    echo $signin_output; // Outputs Sign-In form
    $conn->close(); //Close connection
?>
>>>>>>> 12ada200dd7b1c3874ddf0337041eabc7a3508e5
