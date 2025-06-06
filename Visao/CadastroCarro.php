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
    ?>

    <div class="container">

        <h1>Cadastro do Veiculo</h1>

        <br>

        <form method="post" action="../Controle/ControleCarro.php?ACAO=cadastrarCarro" enctype="multipart/form-data">

            <label for="fabricante">Fabricante:</label>
            <input type="text" name="fabricante" id="fabricante" required>

            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" required>

            <label for="placa">Placa:</label>
            <input type="text" name="placa" id="placa" required>

            <label for="cor">Cor:</label>
            <input type="text" name="cor" id="cor" required>

            <label for="ano">Ano:</label>
            <input type="number" name="ano" id="ano" min="1900" max="2200" required>

            <label for="caracteristicas">Caracteristicas do Problema:</label>
            <textarea style="    padding: 10px; border: 1px solid #333; border-radius: 8px; width: 100%; background-color: #2b2b2b; color: #f0f0f0; resize: none;" name="caracteristicas" id="caracteristicas" placeholder="Caracteristicas sobre o Veiculo..."></textarea>

            <label for="cliente">Cliente:</label>
            <select name="cliente" id="cliente" style="    font-size: 14px; padding: 15px; border: 1px solid #333; border-radius: 8px; width: 100%; background-color: #2b2b2b; color: #f0f0f0; resize: none;">
                <?php
                require_once '../Modelo/DAO/ClassClienteDAO.php';

                $DAO = new ClassClienteDAO();
                $clientes = $DAO->listarClientes();

                foreach ($clientes as $cliente) {
                    echo "<option value='" . $cliente['idCliente'] . "'>" . $cliente['nome'] . "</option>";
                }
                ?>
            </select>

            <label for="mecanico">Mecanico Responsavel:</label>
            <select name="mecanico" id="mecanico" style=" font-size: 14px; padding: 15px; border: 1px solid #333; border-radius: 8px; width: 100%; background-color: #2b2b2b; color: #f0f0f0; resize: none;">
                <?php
                require_once '../Modelo/DAO/ClassMecanicoDAO.php';

                $DAO = new ClassMecanicoDAO();
                $mecanicos = $DAO->listarMecanico();

                var_dump($mecanicos);

                foreach ($mecanicos as $mecanico) {
                    echo "<option value='" . $mecanico['idMecanico'] . "'>" . $mecanico['nome'] . "</option>";
                }
                ?>
            </select>


            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" required><br><br>
            <button type="submit">Cadastrar Veiculo</button>
        </form>
    </div>
</body>

</html>