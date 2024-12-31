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

$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT nome, email FROM usuarios WHERE idUsuario = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $nome = $usuario['nome'];
    $email = $usuario['email'];
} else {
    echo "<script>
            alert('Usuário não encontrado.');
            window.location.href = '../Login'; // Redireciona para a página de login
          </script>";
    exit();
}

$stmt->close();

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
            <h1>Dados do Usuário</h1>
            <a href="#" class="botao-editar" id="editarBtn">
                <i class="fa-solid fa-pen-to-square fa-2xl" style="color: #FF8326;"></i>
            </a>
        </div>
        <div class="informacoes">
            <div class="info-item">
                <strong>Nome:</strong>
                <span><?php echo htmlspecialchars($nome); ?></span>
            </div>
            <div class="info-item">
                <strong>Email:</strong>
                <span><?php echo htmlspecialchars($email); ?></span>
            </div>
        </div>
        <div class="botoes">
            <a class="botao2" href="../Dashboard">Voltar</a>
            <a class="botao2" href="#" id="mudarSenhaBtn">Mudar Senha</a>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div id="editarModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Dados</h5>
                    <button type="button" class="close" id="fecharModal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editarForm" action="proc_editar_usuario.php" method="POST">
                        <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
                        <div class="form-group">
                            <label for="editNome" class="label-form">Nome:</label>
                            <input type="text" class="input-one" name="nome" id="editNome" value="<?php echo htmlspecialchars($nome); ?>">
                        </div>
                        <div class="form-group">
                            <label for="editEmail" class="label-form">Email:</label>
                            <input type="email" class="input-one" name="Email" id="editEmail" value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" id="fecharModalFooter">Fechar</button>
                    <button type="button" class="btn-primary" id="salvarAlteracoes">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Mudar Senha -->
    <div id="mudarSenhaModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Senha</h5>
                    <button type="button" class="close" id="fecharModalSenha">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="mudarSenhaForm" action="proc_mudar_senha.php" method="POST">
                        <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
                        <div class="form-group">
                            <label for="senhaAtual" class="label-form">Senha Atual:</label>
                            <input type="password" class="input-one" name="senha_atual" id="senhaAtual" required>
                        </div>
                        <div class="form-group">
                            <label for="novaSenha" class="label-form">Nova Senha:</label>
                            <input type="password" class="input-one" name="nova_senha" id="novaSenha" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmarSenha" class="label-form">Confirmar Nova Senha:</label>
                            <input type="password" class="input-one" name="confirmar_senha" id="confirmarSenha" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" id="fecharModalSenhaFooter">Fechar</button>
                    <button type="button" class="btn-primary" id="salvarSenhaAlteracao">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Modal Mudar Senha  -->
    <script>
        document.getElementById("mudarSenhaBtn").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("mudarSenhaModal").style.display = 'flex';
        });

        const fecharModalSenhaBtns = document.querySelectorAll('#fecharModalSenha, #fecharModalSenhaFooter');

        fecharModalSenhaBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById("mudarSenhaModal").style.display = 'none';
            });
        });

        // Validar e enviar o formulário de mudança de senha
        document.getElementById("salvarSenhaAlteracao").addEventListener("click", function() {
            var senhaAtual = document.getElementById("senhaAtual").value;
            var novaSenha = document.getElementById("novaSenha").value;
            var confirmarSenha = document.getElementById("confirmarSenha").value;

            // Verificar se os campos de senha não estão vazios
            if (senhaAtual.trim() === "" || novaSenha.trim() === "" || confirmarSenha.trim() === "") {
                alert("Por favor, preencha todos os campos.");
                return;
            }

            // Verificar se as senhas coincidem
            if (novaSenha !== confirmarSenha) {
                alert("As senhas não coincidem!");
                return;
            }

            // Verificar se a nova senha atende aos requisitos de segurança
            var senhaRequisitos = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/; // 1 letra maiúscula, 1 número, 1 caractere especial
            if (!senhaRequisitos.test(novaSenha)) {
                alert("A nova senha deve conter pelo menos uma letra maiúscula, um número e um caractere especial.");
                return;
            }

            // Enviar o formulário
            document.getElementById("mudarSenhaForm").submit();
        });

        window.addEventListener('click', function(e) {
            if (e.target === document.getElementById("mudarSenhaModal")) {
                document.getElementById("mudarSenhaModal").style.display = 'none';
            }
        });
    </script>
    <!-- Script Modal Editar Dados  -->
    <script>
        document.getElementById("salvarAlteracoes").addEventListener("click", function() {
            var nome = document.getElementById("editNome").value;
            var email = document.getElementById("editEmail").value;

            if (nome.trim() === "" || email.trim() === "") {
                alert("Por favor, preencha todos os campos.");
                return;
            }

            document.getElementById("editarForm").submit();
        });

        const editarBtn = document.getElementById('editarBtn');
        const modal = document.getElementById('editarModal');
        const fecharModalBtns = document.querySelectorAll('#fecharModal, #fecharModalFooter');

        editarBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = 'flex';
        });

        fecharModalBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        });

        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>


</html>