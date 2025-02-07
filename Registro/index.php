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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

    <form class="Formulario" action="proc_registrar_usuario.php" method="POST">
        <img class="img-form" src="../Assets/Logo/Manager_FC_Logo_Sem_Fundo.png">

        <h1 class="titulo">Manager FC</h1>
        <p class="discricao">Gerencie seu modo carreira!!</p>

        <h2 class="sub-titulo">Faça seu Registro</h2>

        <label class="label-form" for="nome">Seu nome:</label>
        <input class="input-one" type="text" name="nome" id="nome" placeholder="Seu nome" required>

        <label class="label-form" for="email">Endereço de email:</label>
        <input class="input-one" type="email" name="email" id="email" placeholder="Seu email" required>

        <label class="label-form" for="senha">Senha</label>
        <input class="input-one" type="password" name="senha" id="senha" placeholder="Senha" required>

        <label class="label-form" for="confirmar_senha">Confirme sua Senha</label>
        <input class="input-one" type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Senha" required>

        <button class="botao1" type="submit">Registrar-se</button>

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