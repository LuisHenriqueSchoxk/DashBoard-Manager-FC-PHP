<?php
include_once("../config/conexao.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carrega a biblioteca PHPMailer
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

session_start();

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if (!$email) {
    $_SESSION['erro'] = 'Email inválido.';
    header('Location: ./RecuperarSenha');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['erro'] = 'Email não encontrado. Por favor, verifique o endereço de email.';
    header('Location: ./RecuperarSenha');
    exit;
}

$codigo = rand(100000, 999999);

$stmt = $conn->prepare("INSERT INTO recuperar_senha (Email, Codigo) VALUES (?, ?)");
$stmt->bind_param("si", $email, $codigo);
if ($stmt->execute()) {
    $_SESSION['codigo_recuperacao'] = $codigo;
    $_SESSION['email_recuperacao'] = $email;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'recuperarsenha@gamershub.com.br'; 
    $mail->Password = 'c#v9;K&G1U:'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Configura o charset para UTF-8
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('recuperarsenha@gamershub.com.br', 'Manager FC');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Código de Recuperação de Senha';
    $mail->Body = "Seu código de recuperação de senha é: <b>$codigo</b>";

    // Enviar o email
    $mail->send();

    header('Location: ./VerificarCodigo');
    exit;
} catch (Exception $e) {
    $_SESSION['erro'] = 'Erro ao enviar o email. Tente novamente.'; 
    header('Location: ./RecuperarSenha'); 
    exit;
}
?>