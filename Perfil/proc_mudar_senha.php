<?php
session_start();
include_once("../config/conexao.php");

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../Login');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];

// Validação de entrada
if (empty($senha_atual) || empty($nova_senha)) {
    $_SESSION['erro'] = 'Por favor, preencha todos os campos.';
    header('Location: ../Perfil');
    exit();
}

// Verifica se a senha atual está correta
$stmt = $conn->prepare("SELECT Senha FROM usuarios WHERE idUsuario = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($senha_atual, $usuario['Senha'])) {
        // A senha atual está correta, agora podemos atualizar para a nova senha
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("UPDATE usuarios SET Senha = ? WHERE idUsuario = ?");
        $stmt->bind_param("si", $nova_senha_hash, $usuario_id);
        
        if ($stmt->execute()) {
            $_SESSION['registro_sucesso'] = 'Senha alterada com sucesso!';
            header('Location: ../Perfil');
            exit();
        } else {
            $_SESSION['erro'] = 'Erro ao alterar senha. Por favor, tente novamente.';
            header('Location: ../Perfil');
            exit();
        }
    } else {
        $_SESSION['erro'] = 'Senha atual incorreta.';
        header('Location: ../Perfil');
        exit();
    }
} else {
    $_SESSION['erro'] = 'Usuário não encontrado.';
    header('Location: ../Login');
    exit();
}
?>
