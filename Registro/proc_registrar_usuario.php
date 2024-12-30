<?php
include_once("../config/conexao.php");
session_start();

function sanitizarEntrada($entrada) {
    return htmlspecialchars($entrada, ENT_QUOTES, 'UTF-8');
}

$nome = sanitizarEntrada(filter_input(INPUT_POST, 'nome', FILTER_DEFAULT));
$email = filter_var(filter_input(INPUT_POST, 'email', FILTER_DEFAULT), FILTER_VALIDATE_EMAIL);
if (!$email) {
    $_SESSION['erro'] = 'Email inválido.'; 
    header('Location: ../Registro'); 
    exit;
}

$senha = sanitizarEntrada(filter_input(INPUT_POST, 'senha', FILTER_DEFAULT));
$confirmesenha = sanitizarEntrada(filter_input(INPUT_POST, 'confirmar_senha', FILTER_DEFAULT));

if (empty($nome) || empty($email) || empty($senha) || empty($confirmesenha)) {
    $_SESSION['erro'] = 'Por favor, preencha todos os campos.'; 
    header('Location: ../Registro'); 
    exit;
}

if ($senha !== $confirmesenha) {
    $_SESSION['erro'] = 'As senhas não coincidem.';
    header('Location: ../Registro'); 
    exit;
}

$stmt = $conn->prepare("SELECT Email FROM usuarios WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['erro'] = 'Email já registrado.'; 
    header('Location: ../Registro'); 
    exit;
} else {
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (Nome, Email, Senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senhaCriptografada);

    if ($stmt->execute()) {
        $_SESSION['registro_sucesso'] = 'Cadastro realizado com sucesso!';
        header('Location: ../Login'); 
        exit;
    } else {
        $_SESSION['erro'] = 'Erro ao cadastrar usuário. Por favor, tente novamente.'; 
        header('Location: ../Registro'); 
        exit;
    }
}
?>