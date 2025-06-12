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

        <h1>Cadastro do Mecânico</h1>

        <br>

        <form method="post" action="../Controle/ControleMecanico.php?ACAO=cadastrarMecanico" enctype="multipart/form-data">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" required><br>

            <br> <br>

            <button type="submit">Cadastrar</button>
            <button type="reset">Limpar</button>
        </form>
    </div>
</body>

</html>