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
// define('DB_PASSWORD', "1m4Jvlf*C:");
// define('DB_NAME', 'u574591760_Manager');

// $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// if (!$conn) {
//     die("Falha na conexão: " . mysqli_connect_error());
// }

// function escape_string($conn, $value) {
//     return mysqli_real_escape_string($conn, $value);
// }

// // Exemplo de consulta usando prepared statement
// $username = escape_string($conn, $_POST['username']);
// $sql = "SELECT * FROM users WHERE username = ?";
// $stmt = mysqli_prepare($conn, $sql);
// mysqli_stmt_bind_param($stmt, "s", $username);
// mysqli_stmt_execute($stmt);
// $result = mysqli_stmt_get_result($stmt);
// while ($row = mysqli_fetch_assoc($result)) {
// }
?>