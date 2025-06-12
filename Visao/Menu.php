<?php
session_start();

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
    <title>Document</title>
    <link href="css/menu.css" rel="stylesheet">
</head>

<body>

    <div class="sidebar">
        <h1>Oficina</h1>
        <ul>
            <li><a href="CadastroCarro.php" class="menu-button">Nova Entrada de Veículo</a></li>
            <li><a href="ListarCarros.php" class="menu-button">Em Manutenção</a></li>
            <li><a href="ListarFinalizados.php" class="menu-button">Serviços Finalizados</a></li>
            <hr>
            <li><a href="CadastroCliente.php" class="menu-button">Novo Cliente</a></li>
            <li><a href="ListarClientes.php" class="menu-button">Clientes Cadastrados</a></li>
            <hr>
            <?php if ($nivel == 1) { ?>
                <li><a href="ListarMecanicos.php" class="menu-button">Equipe Mecânica</a></li>
                <li><a href="CadastroMecanico.php" class="menu-button">Cadastrar Mecânico</a></li>
                <hr>
                <li><a href="ListarServicos.php" class="menu-button">Histórico de Serviços</a></li>
            <?php } ?>
        </ul>

        <?php

        echo "<p>Bem Vindo, " . ucfirst($_SESSION['login']) . "</p>";
        if ($nivel == 1) {
            echo "<p style=' font-size: 15px; bottom: 20px;'> Nivel: Gerência</p>";
        } else {
            echo "<p style=' font-size: 15px; bottom: 20px;'> Nivel: Atendimento</p>";
        }

        echo "<a href='../Controle/ControleUsuario.php?ACAO=sair' class='menu-button' style='text-align: center; width: 70%; margin-left: 15%;' >Log out</a>";
        ?>
    </div>


</body>

</html>