<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatorios de Serviços</title>
    <link rel="stylesheet" href="css/lista.css">
</head>

<body>
    <?php
    include 'Menu.php';
    ?>

    <h1 class="titulo">Historico de Serviços</h1>

    <table class="tabela-clientes">
        <thead>
            <tr>
                <th>Serviço</th>
                <th>Data do Serviço</th>
                <th>Veiculo</th>
                <th>Placa</th>
                <th>Cliente</th>
                <th>Mecânico</th>
                <th>Usuário</th>
                <th>Relatório</th>
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

            $id = @$_POST['idex'];

            $classClienteDAO = new ClassClienteDAO();
            $clientes = $classClienteDAO->listarClientes();
            $classCarroDAO = new ClassCarroDAO();
            $classServicoDAO = new ClassServicoDAO();
            $servicos = $classServicoDAO->listarServicosJoin();

            // var_dump($servicos);

            foreach ($servicos as $servico) {
                echo '<tr>';
                echo '<td>' . $servico['descricao'] . '</td>';
                echo '<td>' . $servico['dataServico'] . '</td>';
                echo '<td>' . $servico['modelo'] . '</td>';
                echo '<td>' . $servico['placa'] . '</td>';
                echo '<td>' . $servico['nome'] . '</td>';
                echo '<td>' . $servico['mecanico'] . '</td>';
                echo '<td>' . $servico['userName'] . '</td>';
                echo '<td>
                <a href="ListarRelatorio.php?idex=' . $servico['idServico'] . '"class="btn btn-editar">Ver Relatorio</a> 
                  <a href="../Controle/ExcluirServico.php?idex=' . $servico['idServico'] . '"class="btn btn-excluir">Cancelar</a> 
                </td>';
                echo '</tr>';
            }

            ?>

        </tbody>
    </table>

</body>

</html>