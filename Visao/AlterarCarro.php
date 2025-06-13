<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/form.css" rel="stylesheet">
</head>

<body>

    <?php
    include 'Menu.php';

    require '../Modelo/ClassCarro.php';
    require '../Modelo/DAO/ClassCarroDAO.php';
    require_once '../Modelo/DAO/ClassClienteDAO.php';
    require_once '../Modelo/DAO/ClassServicoDAO.php';
    require_once '../Modelo/ClassServico.php';

    $DAO = new ClassClienteDAO();
    $clientes = $DAO->listarClientes();

    $id = @$_GET['idex'];
    $novoCarro = new ClassCarro();
    $carroDao = new ClassCarroDAO();
    $novoCarro = $carroDao->buscarCarro($id);

    $servicoDAO = new ClassServicoDAO();
    $servicoCarro = new ClassServico();
    $servicoCarro = $servicoDAO->buscarServicoCarro($id);

    //printf("ID: $id");
    //echo "<br>";
   // var_dump($novoCarro);
    ?>

    <div class="container">

        <h1>Cadastro do Veiculo</h1>

        <br>

        <form method="post" action="../Controle/ControleCarro.php?ACAO=alterarCarro" enctype="multipart/form-data">
            <input type="hidden" name="idex" value="<?php echo $novoCarro['idCarro']; ?>">

            <label for="fabricante">Fabricante:</label>
            <input type="text" name="fabricante" id="fabricante" value="<?php echo $novoCarro['fabricante'] ?>">

            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" value="<?php echo $novoCarro['modelo'] ?>">

            <label for="placa">Placa:</label>
            <input type="text" name="placa" id="placa" value="<?php echo $novoCarro['placa'] ?>">

            <label for="cor">Cor:</label>
            <input type="text" name="cor" id="cor" value="<?php echo $novoCarro['cor'] ?>">

            <label for="ano">Ano:</label>
            <input type="number" name="ano" id="ano" min="1900" max="2200" value="<?php echo $novoCarro['ano'] ?>">

            <label for="caracteristicas">Descricao do Serviço:</label>
            <textarea style="    padding: 10px; border: 1px solid #333; border-radius: 8px; width: 100%; background-color: #2b2b2b; color: #f0f0f0; resize: none;" name="caracteristicas" id="caracteristicas" placeholder="Descricao sobre o Servico..."><?php echo $novoCarro['caracteristicas'] ?></textarea>

            <label for="cliente">Cliente:</label>
            <select name="cliente" id="cliente" style="    font-size: 14px; padding: 15px; border: 1px solid #333; border-radius: 8px; width: 100%; background-color: #2b2b2b; color: #f0f0f0; resize: none;">
                <?php

                foreach ($clientes as $cliente) {
                    echo "<option value='" . $cliente['idCliente'] . "'>" . $cliente['nome'] . "</option>";
                }
                ?>
            </select>


            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*"><br><br>
            <button type="submit">Cadastrar Veiculo</button>
        </form>
    </div>
</body>

</html>