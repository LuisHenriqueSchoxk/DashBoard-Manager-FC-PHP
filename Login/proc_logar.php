<?php
include_once("../config/conexao.php");
session_start();

// Função para sanitizar entradas
function sanitizarEntrada($entrada) {
    return htmlspecialchars($entrada, ENT_QUOTES, 'UTF-8');
}

// Importação e sanitização
$email = filter_var(filter_input(INPUT_POST, 'email', FILTER_DEFAULT), FILTER_VALIDATE_EMAIL);
$senha = sanitizarEntrada(filter_input(INPUT_POST, 'senha', FILTER_DEFAULT));

if (!$email) {
    $_SESSION['erro'] = 'Email inválido.';
    header('Location: ../Login');
    exit;
}

if (empty($email) || empty($senha)) {
    $_SESSION['erro'] = 'Por favor, preencha todos os campos.';
    header('Location: ../Login');
    exit;
}

// Consultar o banco de dados para verificar o email
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se o email existe no banco de dados
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // Verificar a senha
    if (password_verify($senha, $usuario['Senha'])) {
        // A senha está correta, criar as variáveis de sessão
        $_SESSION['usuario_id'] = $usuario['idUsuario'];
        $_SESSION['usuario_nome'] = $usuario['Nome'];
        $_SESSION['usuario_email'] = $usuario['Email'];

        // Redirecionar para a página inicial ou para onde desejar
        header('Location: ../Dashboard');
        exit;
    } else {
        $_SESSION['erro'] = 'Senha incorreta.';
        header('Location: ../Login');
        exit;
    }
} else {
    $_SESSION['erro'] = 'Email não encontrado.';
    header('Location: ../Login');
    exit;
}