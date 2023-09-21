<?php
function checkClientId($client_id, $error, $status){

    $client_id_length = strlen($client_id);
    if ($client_id != null && $client_id_length >= 1 && $client_id_length <= 30) {
        $error = '';
        $status = 0;
    } else {
        $error = "Client ID must be between 1-30 characters!";
        $status = 1;
        return $error;
    }
}
?>