<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <title>Tela de Login</title>
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
        <form method="post" action="Controle/ControleUsuario.php?ACAO=fazerLogin">
            <label for="login">Usuário:</label>
            <input type="text" name="login" id="login" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit" class="submit-btn">Fazer Login</button>
        </form>
        <p>Não tem uma conta? <a href="Visao/CadastroUsuario.php">Cadastre-se</a></p>
    </div>

</body>

</html>