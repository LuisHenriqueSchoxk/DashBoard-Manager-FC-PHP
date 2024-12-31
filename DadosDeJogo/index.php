<?php
session_start();
include_once("../config/conexao.php");

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
    <title>Perfil</title>
    <link href="./css/index.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dados">
        <div class="titulo">
            <h1>Dados do Jogo</h1>
            <a href="#" class="botao-adicionar" id="adicionarBtn">
                <i class="fa-solid fa-plus fa-2xl" style="color: #FF8326;"></i>
            </a>
        </div>
        <form action="processa_formulario.php" method="POST">
            <div class="form-group">
                <label for="exemploSelect" class="label-form">Escolha uma opção:</label>
                <select name="opcao" id="exemploSelect" class="input-one">
                    <?php
                    include_once("../config/conexao.php");

                    // Consulta ao banco de dados para obter as opções
                    $stmt = $conn->prepare("SELECT Temporada FROM temporada");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Preenche as opções do select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['idTemporada']) . "'>" . htmlspecialchars($row['Temporada']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </form>
        <div class="informacoes">
            <div class="info-item">
                <strong>Pais:</strong>
                <span><?php echo htmlspecialchars($pais); ?></span>
            </div>
            <div class="info-item">
                <strong>Liga:</strong>
                <span><?php echo htmlspecialchars($liga); ?></span>
            </div>
            <div class="info-item">
                <strong>Formacao:</strong>
                <span><?php echo htmlspecialchars($formacao); ?></span>
            </div>
            <div class="info-item">
                <strong>Treinador:</strong>
                <span><?php echo htmlspecialchars($treinador); ?></span>
            </div>
            <div class="info-item">
                <strong>História do Treinador:</strong>
                <span><?php echo htmlspecialchars($obs_treinador); ?></span>
            </div>
        </div>
        <div class="botoes">
            <a class="botao2" href="../Dashboard">Voltar</a>
            <div>
                <a class="botao2" href="#" id="mudarSenhaBtn">Excluir</a>
                <a class="botao2" href="#" id="mudarSenhaBtn">Editar</a>
            </div>
        </div>
    </div>

    <!-- Modal para Inserir Dados -->
    <div id="inserirModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inserir Dados</h5>
                    <button type="button" class="close" id="fecharModalInserir">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="inserirForm" action="processa_insercao.php" method="POST">
                        <div class="form-group">
                            <label for="temporada" class="label-form">Temporada:</label>
                            <input type="text" class="input-one" name="temporada" id="temporada" placeholder="Qual a sua temporada" required>
                        </div>
                        <div class="form-group">
                            <label for="pais" class="label-form">País:</label>
                            <input type="text" class="input-one" name="pais" id="pais" placeholder="Qual o país" required>
                        </div>
                        <div class="form-group">
                            <label for="liga" class="label-form">Liga:</label>
                            <input type="email" class="input-one" name="liga" id="liga" placeholder="Qual sua liga" required>
                        </div>
                        <div class="form-group">
                            <label for="clube" class="label-form">Clube:</label>
                            <input type="text" class="input-one" name="clube" id="clube" placeholder="Qual seu clube" required>
                        </div>
                        <div class="form-group">
                            <label for="formacao" class="label-form">Formação:</label>
                            <input type="email" class="input-one" name="formacao" id="formacao" placeholder="Qual sua formação" required>
                        </div>
                        <div class="form-group">
                            <label for="treinador" class="label-form">Treinador:</label>
                            <input type="text" class="input-one" name="treinador" id="treinador" placeholder="Nome do treinador" required>
                        </div>
                        <div class="form-group">
                            <label for="obs_treinador" class="label-form">História do Treinador:</label>
                            <textarea id="obs_treinador" name="obs_treinador" rows="4" cols="50" placeholder="Conte a história do treinador"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" id="fecharModalInserirFooter">Fechar</button>
                    <button type="button" class="btn-primary" id="salvarInserir">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Modal Inserir Dados -->
    <script>
        document.getElementById("salvarInserir").addEventListener("click", function() {
            var nome = document.getElementById("nomeJogador").value;
            var email = document.getElementById("emailJogador").value;
            var posicao = document.getElementById("posicaoJogador").value;
            var temporada = document.getElementById("temporadaSelect").value;

            if (nome.trim() === "" || email.trim() === "" || posicao.trim() === "" || temporada.trim() === "") {
                alert("Por favor, preencha todos os campos.");
                return;
            }

            document.getElementById("inserirForm").submit();
        });

        const adicionarBtn = document.getElementById('adicionarBtn');
        const modalInserir = document.getElementById('inserirModal');
        const fecharModalBtnsInserir = document.querySelectorAll('#fecharModalInserir, #fecharModalInserirFooter');

        adicionarBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modalInserir.style.display = 'flex';
        });

        fecharModalBtnsInserir.forEach(btn => {
            btn.addEventListener('click', function() {
                modalInserir.style.display = 'none';
            });
        });

        window.addEventListener('click', function(e) {
            if (e.target === modalInserir) {
                modalInserir.style.display = 'none';
            }
        });
    </script>
</body>



</html>