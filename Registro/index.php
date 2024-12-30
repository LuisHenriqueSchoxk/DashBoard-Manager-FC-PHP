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
    <title>Registro</title>
    <link href="./css/index.css" rel="stylesheet">
</head>

<body>

    <form class="Formulario" action="proc_registrar_usuario.php" method="POST">
        <img class="img-form" src="../Assets/Logo/Manager_FC_Logo.png">

        <h1 class="titulo">Manager Dashboard</h1>

        <h2 class="sub-titulo">Faça seu Registro</h2>

        <label class="label-form" for="nome">Seu nome:</label>
        <input class="input-one" type="text" name="nome" id="nome" placeholder="Seu nome" required>

        <label class="label-form" for="email">Endereço de email:</label>
        <input class="input-one" type="email" name="email" id="email" placeholder="Seu email" required>

        <label class="label-form" for="senha">Senha</label>
        <input class="input-one" type="password" name="senha" id="senha" placeholder="Senha" required>

        <label class="label-form" for="confirmar_senha">Confirme sua Senha</label>
        <input class="input-one" type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Senha" required>

        <button class="botao-registrar" type="submit">Registrar</button>

    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var nome = document.getElementById('nome').value;
            var email = document.getElementById('email').value;
            var senha = document.getElementById('senha').value;
            var confirmaSenha = document.getElementById('confirmar_senha').value;

            if (!nome || !email || !senha || !confirmaSenha) {
                alert("Por favor, preencha todos os campos obrigatórios.");
                e.preventDefault();
                return;
            }

            if (senha !== confirmaSenha) {
                alert("As senhas não coincidem.");
                e.preventDefault();
                return;
            }

            var senhaRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/;

            if (!senhaRegex.test(senha)) {
                alert("A senha deve conter pelo menos 1 letra maiúscula, 1 número e 1 caractere especial.");
                e.preventDefault();
            }
        });
    </script>
</body>

</html>