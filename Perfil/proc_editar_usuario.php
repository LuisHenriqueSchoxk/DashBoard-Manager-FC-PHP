<?php
include_once("../config/conexao.php");
session_start();

function sanitizarEntrada($entrada) {
    return htmlspecialchars($entrada, ENT_QUOTES, 'UTF-8');
}

$usuario_id = sanitizarEntrada(filter_input(INPUT_POST, 'usuario_id', FILTER_DEFAULT));
$nome = sanitizarEntrada(filter_input(INPUT_POST, 'nome', FILTER_DEFAULT));
$email = sanitizarEntrada(filter_input(INPUT_POST, 'email', FILTER_DEFAULT));

if (empty($nome) && empty($email)) {
    $_SESSION['erro'] = 'Por favor, preencha pelo menos um campo (nome ou email).';
    header('Location: ../Perfil');
    exit;
}

$query = "UPDATE usuarios SET ";
$parameters = [];
$types = "";

if (!empty($nome)) {
    $query .= "Nome = ?, ";
    $parameters[] = $nome;
    $types .= "s";
}

if (!empty($email)) {
    $query .= "Email = ?, ";
    $parameters[] = $email;
    $types .= "s";
}

$query = rtrim($query, ", ");

$query .= " WHERE idUsuario = ?";

$parameters[] = $usuario_id;
$types .= "i";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$parameters);

if ($stmt->execute()) {
    $_SESSION['registro_sucesso'] = 'Dados atualizados com sucesso!';
    header('Location: ../Perfil');
    exit;
} else {
    $_SESSION['erro'] = 'Erro ao atualizar usuário. Por favor, tente novamente.';
    header('Location: ../Perfil');
    exit;
}
?>
