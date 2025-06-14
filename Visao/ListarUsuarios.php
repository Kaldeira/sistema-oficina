<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/lista.css">
</head>

<body>
    <?php
    include 'Menu.php';
    ?>

    <h1 class="titulo">Lista de Usuarios</h1>

    <table class="tabela-clientes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nivel</th>
                <th>Data Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../Modelo/ClassUsuario.php';
            require_once "../Modelo/DAO/ClassUsuarioDAO.php";

            $userDAO = new ClassUsuarioDAO();
            $users = $userDAO->listarUsuarios();

           // var_dump($users);

            foreach ($users as $user) {
                echo '<tr>';
                echo '<td>' . $user['idUsuario'] . '</td>';
                echo '<td>' . $user['login'] . '</td>';
                echo '<td>' . $user['email'] . '</td>';
                echo '<td>' . $user['nivel'] . '</td>';
                echo '<td>' . $user['dataCadastro'] . '</td>';
                echo '<td>
                    <a href="AlterarUsuario.php?idex=' . $user['idUsuario'] . '"class="btn btn-editar">Editar</a>
                    <a href="../Controle/ControleUsuario.php?ACAO=deletarUser&idex=' . $user['idUsuario'] . '" class="btn btn-excluir" onclick="return confirm(\'Tem certeza que deseja excluir este usuario?\')">Excluir</a>
                    </td>';
                echo '</tr>';
            }

            ?>

        </tbody>
    </table>

</body>

</html>