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
    <title>Verificar Código</title>
    <link href="./css/index.css" rel="stylesheet">
</head>

<body>

    <form class="Formulario" action="verificar_codigo.php" method="POST">
        <img class="img-form" src="../../Assets/Logo/Manager_FC_Logo.png">

        <h1 class="titulo">Manager Dashboard</h1>

        <h2 class="sub-titulo">Verificar Código</h2>

        <label class="label-form" for="codigo">Digite o código que você recebeu por email:</label>
        <input class="input-one" type="text" name="codigo" id="codigo" placeholder="Codigo" required>

        <button class="botao-logar" type="submit">Verificar Código</button>

    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var codigo = document.getElementById('codigo').value;

            if (codigo.trim() === '') {
                alert("Por favor, insira o código que você recebeu por e-mail.");
                e.preventDefault();
            }
        });
    </script>

</body>

</html>