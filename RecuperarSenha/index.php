<?php
session_start();

if (isset($_SESSION['erro'])) {
    echo "<script>alert('" . $_SESSION['erro'] . "');</script>";
    unset($_SESSION['erro']);
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <title>Recuperar Senha</title>
    <link href="./css/index.css" rel="stylesheet">
</head>

<body>

    <form class="Formulario" action="proc_recuperar_senha.php" method="POST">
        <img class="img-form" src="../Assets/Logo/Manager_FC_Logo.png">

        <h1 class="titulo">Manager Dashboard</h1>

        <h2 class="sub-titulo">Recupere sua Senha</h2>

        <label class="label-form" for="email">Endereço de email</label>
        <input class="input-one" type="email" name="email" id="email" placeholder="Seu email" required>

        <button class="botao-logar" type="submit">Receber codigo</button>

    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var email = document.getElementById('email').value;

            // Verificar se o campo "email" está vazio
            if (email.trim() === '') {
                alert("O campo de email é obrigatório.");
                e.preventDefault(); // Impede o envio do formulário
                return;
            }

            // Verificar se o email é válido
            var regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!regexEmail.test(email)) {
                alert("Por favor, insira um email válido.");
                e.preventDefault(); // Impede o envio do formulário
            }
        });
    </script>

</body>

</html>