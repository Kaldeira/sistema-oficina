<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatorios de Manutençao</title>
    <link rel="stylesheet" href="css/lista.css">
</head>

<body>
    <?php
    include 'Menu.php';
    ?>

    <h1 class="titulo">Relatorio do Serviço</h1>

    <table class="tabela-clientes">
        <thead>
            <tr>
                <!-- <th>Item</th> -->
                <th>Item</th>
                <th>Veiculo</th>
                <th>Cliente</th>
                <th>Mecânico</th>
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
            require_once "../Modelo/ClassMecanico.php";
            require_once "../Modelo/DAO/ClassMecanicoDAO.php";

            $id = $_GET['idex'];
            //var_dump($id);

            $classClienteDAO = new ClassClienteDAO();
            //$clientes = $classClienteDAO->listarClientes();
            $classCarroDAO = new ClassCarroDAO();
            $classServicoDAO = new ClassServicoDAO();
            $classMecanicoDAO = new ClassMecanicoDAO();

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
                // echo '<td>' . $servico['idItem'] . '</td>';
                echo '<td>' . $servico['descricaoItem'] . '</td>';
                echo '<td>' . $servico['modelo'] . '</td>';
                echo '<td>' . $servico['nome'] . '</td>';
                echo '<td>' . $servico['mecNome'] . '</td>';
                echo '<td> R$ ' . $servico['valor'] . '</td>';
                echo '</tr>';

                $valorTotal += $servico['valor'];
            }

            echo '<tr>';
            echo '<th colspan="5" style="text-align: center; color:green">Total: R$ ' . number_format($valorTotal, 2, ',', '.') . ' </th>';
            echo '</tr>';

            ?>

        </tbody>
    </table>

</body>

</html>