<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Tela de Cadastro</title>
    <link href="css/form.css" rel="stylesheet">
    <style>
        @media (min-width: 1280px) and (max-width: 1380px) {
            body {
                   margin-left: 5%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <form method="post" action="../Controle/ControleUsuario.php?ACAO=cadastrarUsuario">
            <label for="login">Usuário:</label>
            <input type="text" name="login" id="login" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <button type="submit" class="submit-btn">Cadastrar</button>
        </form>
        <p><a href="../index.php">Voltar para tela de login?</a></p>
    </div>

</body>

</html>