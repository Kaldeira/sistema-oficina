<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Equipe Mecanica</title>
    <link rel="stylesheet" href="css/lista.css">
</head>

<body>
    <?php
    include 'Menu.php';

    //echo "Bem-vindo, " . $_SESSION['nivel'];
    ?>

    <h1 class="titulo">Equipe Mecanica</h1>

    <table class="tabela-clientes">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Data Cadastro</th>
                <?php if ($_SESSION['nivel'] == 1) { ?>
                    <th>Ações</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../Modelo/ClassMecanico.php';
            require_once "../Modelo/DAO/ClassMecanicoDAO.php";

            $classMecanicoDAO = new ClassMecanicoDAO();
            $mecanicos = $classMecanicoDAO->listarMecanico();

            //var_dump($mecanicos);

            foreach ($mecanicos as $mecanico) {
                echo '<tr>';
                echo '<td>' . $mecanico['nome'] . '</td>';
                echo '<td>' . $mecanico['telefone'] . '</td>';
                echo '<td>' . $mecanico['dataCadastro'] . '</td>';

                if ($_SESSION['nivel'] == 1) {
                    echo '<td>
                    <a href="AlterarMecanico.php?idex=' . $mecanico['idMecanico'] . '"class="btn btn-editar">Editar</a>
                    <a href="../Controle/ControleMecanico.php?ACAO=deletarMecanico&idex=' . $mecanico['idMecanico'] . '" class="btn btn-excluir" onclick="return confirm(\'Tem certeza que deseja excluir este mecânico?\')">Excluir</a>
                    </td>';
                }

                echo '</tr>';
            }

            ?>

        </tbody>
    </table>

</body>

</html>