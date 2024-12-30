<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "manager_fc";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>