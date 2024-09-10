<?php
//Nødvendig informasjon for å koble til server
$server = "localhost";
$serverusername = "root";
$serverpassword = "";
$database_name = "reserver_kunder";

$conn = mysqli_connect($server, $serverusername, $serverpassword, $database_name); //kobler til database

?>