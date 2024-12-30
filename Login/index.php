<?php
session_start();

if (isset($_SESSION['registro_sucesso'])) {
    echo "<script>alert('" . $_SESSION['registro_sucesso'] . "');</script>";
    unset($_SESSION['registro_sucesso']);
}

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
    <title>Login</title>
    <link href="./css/index.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>


<body>

    <form class="Formulario" action="proc_logar.php" method="POST">
        <img class="img-form" src="../Assets/Logo/Manager_FC_Logo_Sem_Fundo.png">

        <h1 class="titulo">Manager FC</h1>
        <p class="discricao">Gerencie seu modo carreira!!</p>

        <h2 class="sub-titulo">Faça seu Login</h2>

        <label class="label-form" for="email">Endereço de email</label>
        <input class="input-one" type="email" name="email" id="email" placeholder="Seu email" required>

        <label class="label-form" for="senha">Senha</label>
        <input class="input-one" type="password" name="senha" id="senha" placeholder="Senha" required>

        <div>
            <label class="label-form">
                <input class="input-check" name="salvar_senha" type="checkbox" value="salvar_senha"> Lembrar de mim
            </label>
        </div>

        <button class="botao1" type="submit">Entrar</button>

        <a class="link" href="../RecuperarSenha">Esqueci minha senha</a>

        <a class="link-registro" href="../Registro">Se registre aqui!!</a>

        <p class="divisao">ou</p>

        <div id="g_id_onload"
            data-client_id="717031330490-j4rig73hvfu189u2icdvraph8fuj9c10.apps.googleusercontent.com"
            data-context="signin"
            data-ux_mode="popup"
            data-callback="handleCredentialResponse"
            data-auto_prompt="false">
        </div>

        <div class="g_id_signin"
            data-type="standard"
            data-shape="rectangular"
            data-theme="outline"
            data-text="sign_in_with"
            data-size="large"
            data-logo_alignment="left">
        </div>

    </form>

    <script>
        // Função para lidar com o token de credenciais
        function handleCredentialResponse(response) {
            console.log("ID Token do Google:", response.credential);
            // Enviar o token para o servidor para validação
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            var email = document.getElementById('email').value;
            var senha = document.getElementById('senha').value;

            if (!email || !senha) {
                alert('Por favor, preencha todos os campos.');
                e.preventDefault();
                return;
            }

            var lembrarSenha = document.querySelector('input[name="salvar_senha"]').checked;

            if (lembrarSenha) {
                localStorage.setItem('email', email);
                localStorage.setItem('senha', senha);
            } else {
                localStorage.removeItem('email');
                localStorage.removeItem('senha');
            }
        });

        window.addEventListener('load', function() {
            if (localStorage.getItem('email') && localStorage.getItem('senha')) {
                document.getElementById('email').value = localStorage.getItem('email');
                document.getElementById('senha').value = localStorage.getItem('senha');
                document.querySelector('input[name="salvar_senha"]').checked = true;
            }
        });
    </script>
</body>

</html>