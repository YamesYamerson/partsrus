<?php 
// Accesses MAMP server and MySQL server and accesses
require_once 'php/server_login.php';
// Initialize variables
// Errors array
$errors = array (
    'client_id_error' => '',
    'client_username_error' => '',
    'password_error' => '',
    );
// Error handling boolean values
$id_valid = FALSE;
$id_exists = FALSE;
$username_valid = FALSE;
$username_exists = FALSE;
$password_valid = FALSE;
$password_verified = FALSE;
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
$stmt = $conn->prepare("SELECT clientId771, clientCompPassword771, username771 FROM clients771");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($client_id, $password, $username);
// Loop through users to check for existing usernames and passwords
while ($stmt->fetch()) {
    // Checks to see if Client Username entry field is empty
    if(empty($client_name_entry)){
        // Checks if Client ID entry is valid
        if($id_valid === FALSE && $client_id_length == 5){
            $id_valid = TRUE;
        }
        // Checks to see if Client ID entry is in DB if ID is valid
        if ($id_valid === TRUE) {
            if($client_id_entry == $client_id){
                $id_exists = TRUE;
            // Sends client error message if Client ID is not found
            }else{
                $errors['client_id_error'] = "Client ID not found!";
                break;
            }
        }
    }
    // Checks to see if Client ID field is empty
    if(empty($client_id_entry) && !empty($client_username_entry)){
        echo "client id empty";
        // Checks to see if Client Username entry is valid
        if($username_valid === FALSE && ($client_name_length > 4 || $client_name_length < 30)){
            $username_valid === TRUE;
            echo "client id is not set! AND username is valid";
        }
        // Checks to see if Client Username entry is in DB
        if($username_valid === TRUE){
            if($client_name_entry == $username){
                $username_exists = TRUE;
            }else{
                $errors['client_username_error'] = "Client Username not found!";
                break;
            }
        }
    }
    // Checks to see if use has input text for ClientID and ClientUsername (unsupported action)
    if(!empty($client_id_entry) === TRUE && !empty($client_name_entry)){
        unset($errors);
        $errors['client_id_error'] = "Enter text in one field ONLY: Client Id or Client Username";
        break;
    }
    // Checks to see if either Client ID or Username exist in database and have been confirmed
    if($id_exists === TRUE || $username_exists === TRUE){
            // Checks to see if password is valid format
        if ($password_length >= 7 && $password_length <= 20) {
            $password_valid = TRUE;
        }else{
            $errors['password_error'] = "Password must be between 7-20 characters!";
            break;
        }
    }
    // If a password is a valid format, check to see if it can be verified
    if($password_valid === TRUE){
        // Signs in user if password can be verified
        if(password_verify($password_entry, $password)) {
            $password_verified = TRUE;
            session_start(); // Start the session here
            // Set Session Variables
            $_SESSION["signin"] = TRUE;
            $_SESSION["client_id"] = $client_id;
            header('Location: index.php');
            exit; // Exit to prevent further script execution
        // Exits loop if password for detected client ID or username exists
        }else{
            $errors['password_error'] = "Incorrect Password!"; // Error message if password is incorrect
            break;
        }
    }
}
//If client id entry is more or less than 5 digits, display error message
if($id_valid === FALSE && empty($client_name_entry) === TRUE
){
    $errors['client_id_error'] = "Client ID must be 5 digits!";
}

// Clears errors on empty form (FIX LATER)
if(!isset($client_id_entry) && !isset($client_name_entry)){
    unset($errors);
}
// Heredoc to output the contents of form
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
