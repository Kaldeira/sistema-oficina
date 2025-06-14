<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// todas telas o menu é incluido, entao todas as telas precisam de login para serem acessadas, check apartir daqui.
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php?&MSG= Você precisa fazer login primeiro!');
    exit();
}

$nivel = $_SESSION['nivel'];

//echo "Bem-vindo, " . $_SESSION['nivel'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="sidebar">
        <h1>Oficina</h1>
        <ul>
            <li><a href="CadastroCarro.php" class="menu-button"><i class="fas fa-car"></i> Entrada de Veículo</a></li>
            <li><a href="ListarCarros.php" class="menu-button"><i class="fas fa-tools"></i> Em Manutenção</a></li>
            <li><a href="ListarFinalizados.php" class="menu-button"><i class="fas fa-check-circle"></i> Serviços Finalizados</a></li>
            <hr>
            <li><a href="CadastroCliente.php" class="menu-button"><i class="fas fa-user-plus"></i> Novo Cliente</a></li>
            <li><a href="ListarClientes.php" class="menu-button"><i class="fas fa-users"></i> Clientes Cadastrados</a></li>
            <hr>
            <li><a href="ListarMecanicos.php" class="menu-button"><i class="fa-solid fa-people-group"></i> Equipe Mecânica</a></li>
            <?php if ($nivel == 1) { ?>
                <li><a href="CadastroMecanico.php" class="menu-button"><i class="fas fa-user-cog"></i> Cadastrar Mecânico</a></li>
            <?php } ?>
            <hr>
            <?php if ($nivel == 1) { ?>
                <li><a href="ListarUsuarios.php" class="menu-button"><i class="fa-solid fa-list"></i> Usuarios Cadastrados</a></li>
            <?php } ?>

            <li><a href="ListarServicos.php" class="menu-button"><i class="fas fa-history"></i> Histórico de Serviços</a></li>
        </ul>


        <div class="user-info">
            <p>Bem-vindo, <strong><?php echo ucfirst($_SESSION['login']); ?></strong></p>
            <p style="font-size: 14px;">
                Nível: <?php echo ($nivel == 1) ? "Gerência" : "Atendimento"; ?>
            </p>
            <a href="../Controle/ControleUsuario.php?ACAO=sair" class="logout-button">
                <i class="fas fa-sign-out-alt"></i> Log out
            </a>
        </div>
    </div>

</body>

</html>