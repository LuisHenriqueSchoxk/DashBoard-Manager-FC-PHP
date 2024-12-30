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
    <title>Alterar Senha</title>
    <link href="./css/index.css" rel="stylesheet">
</head>

<body>

    <form class="Formulario" action="proc_alterar_senha.php" method="POST">
        <img class="img-form" src="../../../Assets/Logo/Manager_FC_Logo.png">

        <h1 class="titulo">Manager Dashboard</h1>

        <h2 class="sub-titulo">Alterar Senha</h2>

        <label class="label-form" for="nova_senha">Nova Senha</label>
        <input class="input-one" type="password" name="nova_senha" id="nova_senha" placeholder="Digite a Senha" required>

        <label class="label-form" for="confirmar_senha">Confirme sua Senha</label>
        <input class="input-one" type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Digite a Senha novamente" required>

        <button class="botao-logar" type="submit">Alterar Senha</button>

    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var novaSenha = document.getElementById('nova_senha').value;
            var confirmarSenha = document.getElementById('confirmar_senha').value;

            if (novaSenha === '' || confirmarSenha === '') {
                alert("Os campos de senha são obrigatórios.");
                e.preventDefault();
                return;
            }

            if (novaSenha !== confirmarSenha) {
                alert("As senhas não coincidem.");
                e.preventDefault();
                return;
            }

            var regexSenha = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;

            if (!regexSenha.test(novaSenha)) {
                alert("A senha deve conter pelo menos 1 letra maiúscula, 1 número e 1 caractere especial.");
                e.preventDefault();
                return;
            }
        });
    </script>
</body>

</html>