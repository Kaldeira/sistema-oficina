<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link href="css/form.css" rel="stylesheet">
</head>

<body>

    <?php
    include 'Menu.php';
    ?>

    <div class="container">

        <h1>Cadastro do Cliente</h1>

        <br>

        <form method="post" action="../Controle/ControleCliente.php?ACAO=cadastrarCliente" enctype="multipart/form-data">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" required><br>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" required><br>

            <br> <br>

            <button type="submit">Cadastrar</button>
            <button type="reset">Limpar</button>
        </form>
    </div>
</body>

</html>