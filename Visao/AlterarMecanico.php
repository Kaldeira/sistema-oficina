<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Mecanico</title>
    <link href="css/form.css" rel="stylesheet">
</head>

<body>

    <?php
    include 'Menu.php';

    require '../Modelo/classMecanico.php';
    require '../Modelo/DAO/classMecanicoDAO.php';
    $id = @$_GET['idex'];
    $novoCliente = new ClassMecanico();
    $clienteDao = new ClassMecanicoDAO();
    $novoCliente = $clienteDao->buscarMecanico($id);

    //printf("ID: $id");
    //echo "<br>";
    //var_dump($novoCliente );
    ?>

    <div class="container">

        <h1>Alterar Mecanico</h1>

        <br>

        <form method="post" action="../Controle/ControleMecanico.php?ACAO=alterarMecanico" enctype="multipart/form-data">
            <input type="hidden" name="idex" value="<?php echo $novoCliente['idMecanico']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $novoCliente['nome'] ?>" /><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?php echo $novoCliente['telefone'] ?>"><br>

            <br> <br>

            <button type="submit">Alterar</button>
            <button type="reset">Reset</button>
        </form>
    </div>
</body>

</html>