<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatorios de Manutençao</title>
    <link rel="stylesheet" href="css/clientes.css">
</head>

<body>
    <h1>Relatorio do Serviço</h1>

    <?php
    include 'Menu.php';
    ?>

    <table class="tabela-clientes">
        <thead>
            <tr>
                <th>Item</th>
                <th>Descrição</th>
                <th>Veiculo</th>
                <th>Cliente</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>

            <?php

            require_once "../Modelo/ClassServico.php";
            require_once "../Modelo/ClassServicoItem.php";
            require_once "../Modelo/DAO/ClassServicoDAO.php";
            require_once '../Modelo/ClassCliente.php';
            require_once "../Modelo/DAO/ClassClienteDAO.php";
            require_once "../Modelo/ClassCarro.php";
            require_once "../Modelo/DAO/ClassCarroDAO.php";

            $id = $_GET['idex'];
            //var_dump($id);

            $classClienteDAO = new ClassClienteDAO();
            $clientes = $classClienteDAO->listarClientes();
            $classCarroDAO = new ClassCarroDAO();
            $classServicoDAO = new ClassServicoDAO();
            $servicos = $classServicoDAO->listarRelatorio($id);

            if (!$servicos) {
                echo '<tr>';
                echo '<td colspan="5" style="text-align: center; color:red">Nenhum relatório encontrado</td>';
                echo '</tr>';
                exit;
            }

            //var_dump($servicos);

            $valorTotal = 0;
            foreach ($servicos as $servico) {
                echo '<tr>';
                echo '<td>' . $servico['idItem'] . '</td>';
                echo '<td>' . $servico['descricaoItem'] . '</td>';
                echo '<td>' . $servico['modelo'] . '</td>';
                echo '<td>' . $servico['nome'] . '</td>';
                echo '<td> R$ ' . $servico['valor'] . '</td>';
                echo '</tr>';

                $valorTotal += $servico['valor'];
            }

            echo '<tr>';
            echo '<th colspan="5" style="text-align: center; color:green">Total: R$ ' . $valorTotal . ' </th>';
            echo '</tr>';

            ?>

        </tbody>
    </table>

</body>

</html>