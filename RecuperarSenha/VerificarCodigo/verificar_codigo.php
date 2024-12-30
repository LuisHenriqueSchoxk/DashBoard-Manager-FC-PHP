<?php
session_start();

$codigo_digitado = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT);
if (!$codigo_digitado || $codigo_digitado != $_SESSION['codigo_recuperacao']) {
    $_SESSION['erro'] = 'Código inválido.';
    header('Location: ./RecuperarSenha/VerificarCodigo');
    exit;
}

header('Location: ./AlterarSenha');
exit;
?>
