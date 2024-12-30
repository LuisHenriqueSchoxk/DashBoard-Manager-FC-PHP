<?php
session_start();
include_once("../../../config/conexao.php");

$nova_senha = filter_input(INPUT_POST, 'nova_senha', FILTER_DEFAULT);
$confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha', FILTER_DEFAULT);

if (empty($nova_senha) || empty($confirmar_senha) || $nova_senha !== $confirmar_senha) {
    $_SESSION['erro'] = 'As senhas não coincidem ou não foram preenchidas.';
    header('Location: ./RecuperarSenha/VerificarCodigo/AlterarSenha');
    exit;
}

$email = $_SESSION['email_recuperacao'];
$senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE usuarios SET Senha = ? WHERE Email = ?");
$stmt->bind_param("ss", $senha_hash, $email);
if ($stmt->execute()) {
    $_SESSION['sucesso'] = 'Senha alterada com sucesso!';
    header('Location: ../../../Login');
} else {
    $_SESSION['erro'] = 'Erro ao alterar a senha. Tente novamente.';
    header('Location: ./RecuperarSenha/VerificarCodigo/AlterarSenha');
}
?>
