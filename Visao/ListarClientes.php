<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <link rel="stylesheet" href="css/lista.css">
</head>

<body>
    <?php
    include 'Menu.php';
    ?>

    <h1 class="titulo">Lista de Clientes</h1>

    <table class="tabela-clientes">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Endereço</th>
                <th>Veículos</th>
                <th>Data Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../Modelo/ClassCliente.php';
            require_once "../Modelo/DAO/ClassClienteDAO.php";
            require_once "../Modelo/ClassCarro.php";
            require_once "../Modelo/DAO/ClassCarroDAO.php";

            $classClienteDAO = new ClassClienteDAO();
            $clientes = $classClienteDAO->listarClientes();
            $classCarroDAO = new ClassCarroDAO();

            foreach ($clientes as $cliente) {
                echo '<tr>';
                echo '<td>' . $cliente['nome'] . '</td>';
                echo '<td>' . $cliente['telefone'] . '</td>';
                echo '<td>' . $cliente['email'] . '</td>';
                echo '<td>' . $cliente['cpf'] . '</td>';
                echo '<td>' . $cliente['endereco'] . '</td>';

                $carrosCliente = $classCarroDAO->buscarCarroCliente($cliente['idCliente']);
                // var_dump($carrosCliente );
                echo '<td>';
                if ($carrosCliente) {
                    foreach ($carrosCliente as $carro) {
                        echo $carro['modelo'] . ' - ' . $carro['placa'] . '<br>';
                    }
                } else {
                    echo 'Nenhum veículo cadastrado';
                }
                echo '</td>';

                echo '<td>' . $cliente['dataCadastro'] . '</td>';
                echo '<td>
                    <a href="AlterarCliente.php?idex=' . $cliente['idCliente'] . '"class="btn btn-editar">Editar</a>
                    <a href="../Controle/ControleCliente.php?ACAO=deletarCliente&idex=' . $cliente['idCliente'] . '" class="btn btn-excluir" onclick="return confirm(\'Tem certeza que deseja excluir este cliente?\')">Excluir</a>
                    </td>';
                echo '</tr>';
            }

            ?>

        </tbody>
    </table>

</body>

</html>