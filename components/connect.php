<?php
$db_host = 'localhost';
$db_port = '3307'; // Change to your specific port number
$db_name = 'purpleave_db';
$db_user = 'root';
$db_pass = 'mario';

try {
    $conn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Uncomment this line for testing purposes
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function unique_id(){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $chars[mt_rand(0, $charLength - 1)];
    }
    return $randomString;
}
?>
