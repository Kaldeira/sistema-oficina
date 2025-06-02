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

    require '../Modelo/ClassCliente.php';
    require '../Modelo/DAO/ClassClienteDAO.php';
    $id = @$_GET['idex'];
    $novoCliente = new ClassCliente();
    $clienteDao = new ClassClienteDAO();
    $novoCliente = $clienteDao->buscarCliente($id);

    //printf("ID: $id");
    //echo "<br>";
    //var_dump($novoCliente );
    ?>

    <div class="container">

        <h1>Cadastro do Cliente</h1>

        <br>

        <form method="post" action="../Controle/ControleCliente.php?ACAO=alterarCliente" enctype="multipart/form-data">
            <input type="hidden" name="idex" value="<?php echo $novoCliente['idCliente']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $novoCliente['nome'] ?>" /><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?php echo $novoCliente['telefone'] ?>"><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $novoCliente['email'] ?>"><br>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" value="<?php echo $novoCliente['cpf'] ?>"><br>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" value="<?php echo $novoCliente['endereco'] ?>"><br>

            <br> <br>

            <button type="submit">Alterar</button>
            <button type="reset">Reset</button>
        </form>
    </div>
</body>

</html>