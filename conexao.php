<?php
$localhost = "127.0.0.1";
$user = "root";
$password = "";
$banco = "safespace";

$conn = new mysqli($localhost, $user, $password, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
