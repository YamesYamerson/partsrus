<?php
// Start the session at the very top of your script
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'php/server_login.php';

// Initialize variables
$client_id_entry = $client_name_entry = $password_entry = "";
$errors = array('client_id_error' => '', 'client_username_error' => '', 'password_error' => '');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id_entry = trim($_POST["ClientId"]);
    $client_name_entry = trim($_POST["ClientUsername"]);
    $password_entry = trim($_POST["Password"]);

    // Validate inputs
    if (empty($client_id_entry) && empty($client_name_entry)) {
        // Both fields are empty
        $errors['client_id_error'] = "Please enter Client ID or Client Username.";
    } elseif (!empty($client_id_entry) && !empty($client_name_entry)) {
        // Both fields are filled
        $errors['client_id_error'] = "Please fill in only one field: Client ID or Client Username.";
    } else {
        // At least one field is filled, proceed to check with the database
        $sql = "SELECT clientId771, clientCompPassword771, username771 FROM clients771 WHERE ";
        $sql .= !empty($client_id_entry) ? "clientId771 = ?" : "username771 = ?";

        if ($stmt = $conn->prepare($sql)) {
            $param = !empty($client_id_entry) ? $client_id_entry : $client_name_entry;
            $stmt->bind_param("s", $param);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($client_id, $hashed_password, $username);
                $stmt->fetch();
                if (password_verify($password_entry, $hashed_password)) {
                    // Password is correct, start a new session
                    $_SESSION["signin"] = TRUE;
                    $_SESSION["client_id"] = $client_id; // Store client ID in session

                    // Redirect to your desired page
                    header("location: index.php");
                    exit;
                } else {
                    $errors['password_error'] = "Invalid password.";
                }
            } else {
                $field_error = !empty($client_id_entry) ? 'client_id_error' : 'client_username_error';
                $errors[$field_error] = "No account found with that ID/Username.";
            }
            $stmt->close();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}

$conn->close();
?>

<!-- HTML for form -->
<div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-2">
    <h1 class="fw-bolder text-center">Sign-In</h1>
    <div class="row gx-5 justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <form method="post">
                <div class="form-floating mb-2">
                    <input type="text" name="ClientId" id="floatingClientId" placeholder="Client ID" class="form-control" value="<?php echo $client_id_entry; ?>" />
                    <label for="floatingClientId">Enter Client ID</label>
                    <p class="text-center text-danger"><?php echo $errors['client_id_error']; ?></p>
                </div>
                <p class="text-center">or</p>
                <div class="form-floating mb-2">
                    <input type="text" name="ClientUsername" id="floatingUsername" placeholder="Client Username" class="form-control" value="<?php echo $client_name_entry; ?>" />
                    <label for="floatingUsername">Enter Client Username</label>
                    <p class="text-center text-danger"><?php echo $errors['client_username_error']; ?></p>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" name="Password" id="floatingPassword" class="form-control" placeholder="Enter Company Password" />
                    <label for="floatingPassword">Enter Password</label>
                    <p class="text-center text-danger"><?php echo $errors['password_error']; ?></p>
                </div>
                <div class="d-grid">
                    <input name="Submit" type="submit" class="btn btn-secondary btn-lg" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</div>
