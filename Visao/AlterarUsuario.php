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

    require '../Modelo/classUsuario.php';
    require '../Modelo/DAO/classUsuarioDAO.php';
    $id = @$_GET['idex'];
    $novo = new ClassUsuario();
    $clienteDao = new ClassUsuarioDAO();
    $novo = $clienteDao->buscarUsuario($id);
    $nivelAtual = $novo['nivel'];

    //printf("ID: $id");
    //echo "<br>";
    //var_dump($novoCliente );
    ?>

    <div class="container">

        <h1>Alterar Usuario</h1>

        <br>

        <form method="post" action="../Controle/ControleUsuario.php?ACAO=alterarUsuario" enctype="multipart/form-data">
            <input type="hidden" name="idex" value="<?php echo $novo['idUsuario']; ?>">

            <label for="login">Username:</label>
            <input type="text" name="login" id="login" value="<?php echo $novo['login'] ?>" /><br>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $novo['email'] ?>"><br>

            <label for="email">Senha:</label>
            <input type="password" name="senha" id="senha" value="<?php echo $novo['senha'] ?>"><br>

            <label for="nivel">Nivel:</label>
            <select name="nivel" id="nivel" style="font-size: 14px; padding: 15px; border: 1px solid #333; border-radius: 8px; width: 100%; background-color: #2b2b2b; color: #f0f0f0; resize: none;">
                <option value="1" <?php if ($nivelAtual == 1) echo 'selected'; ?>>Gerente</option>
                <option value="2" <?php if ($nivelAtual == 2) echo 'selected'; ?>>Atendente</option>
            </select>

            <br> <br>

            <button type="submit">Alterar</button>
            <button type="reset">Reset</button>
        </form>
    </div>
</body>

</html>