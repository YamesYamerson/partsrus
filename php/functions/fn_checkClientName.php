<?php
function checkClientName($client_name, array $errors, $status){
    $client_name_length = strlen($client_name);
    if ($client_name != null && $client_name_length >= 1 && $client_name_length <= 30) {
        $errors[0] = '';
        $status = 0;
    } else {
        $errors[0] = "Client Name must be between 1-30 characters!";
        $status = 1;
    }
}
?>