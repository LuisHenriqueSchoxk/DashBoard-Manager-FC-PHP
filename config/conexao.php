<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "manager_fc";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'u574591760_Manager');
// define('DB_PASSWORD', "Vc9?3aTp/V");
// define('DB_NAME', 'u574591760_Manager');

// // Conexão com o banco de dados
// $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// if (!$conn) {
//     error_log("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
//     die("Erro interno. Tente novamente mais tarde.");
// }
?>