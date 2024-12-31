<?php
session_start();

if (isset($_SESSION['erro'])) {
    echo "<script>alert('" . $_SESSION['erro'] . "');</script>";
    unset($_SESSION['erro']);
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../Login');
    exit();
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <title>Manager FC</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./css/index.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header class="cabecalho">
        <div class="logo-cabecalho-container">
            <img class="img-form" src="../Assets/Logo/Manager_FC_Logo_Sem_Fundo.png" alt="Logo Manager FC">
        </div>
        <div class="titulo-cabecalho-container">
            <h1>MANAGER FC</h1>
            <p>O Melhor Gerenciador de Modo de Carreira</p>
        </div>
        <nav class="nav-cabecalho-container">
            <ul class="nav-cabecalho-links">
                <li>
                    <i class="fa-solid fa-user fa-xl" style="color: #030303;"></i>
                    <a href="../Perfil">Usuário</a>
                </li>
                <li>
                    <i class="fa-solid fa-gamepad fa-xl" style="color: #030303;"></i>
                    <a href="../DadosDeJogo">Dados de Jogo</a>
                </li>
                <li>
                    <i class="fa-solid fa-right-from-bracket fa-xl" style="color: #030303;"></i>
                    <a href="Proc_Logout.php">Sair</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="conteudo">
        <a href="../Treinador" class="botao">Treinador</a>
        <a href="#" class="botao">Transferencias</a>
        <a href="#" class="botao">Categoria de base</a>
        <a href="#" class="botao">Lista de Trasnferencia</a>
        <a href="#" class="botao">Ligas Nacionais</a>
        <a href="#" class="botao">Liga Uefa</a>
        <a href="#" class="botao">Liga Comebol</a>
        <a href="#" class="botao">Titulos</a>
        <a href="#" class="botao">Elencos</a>
    </div>

    <footer class="rodape">
        <div class="contatos">
            <a href="https://www.linkedin.com/in/seu-usuario" target="_blank" aria-label="LinkedIn">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="https://www.instagram.com/seu-usuario" target="_blank" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://wa.me/seu-numero" target="_blank" aria-label="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
        <div class="finalizacao">
            <p>&copy; 2024 Desenvolvido por Serwazi</p>
        </div>
    </footer>

</body>

</html>