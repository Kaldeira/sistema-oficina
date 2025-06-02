<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Carros Finalizados</title>
    <link rel="stylesheet" href="css/showroom.css">
</head>

<body>
    <?php
    include 'Menu.php';
    ?>

    <div class="carros-container">

        <?php
        require_once '../Modelo/ClassCarro.php';
        require_once "../Modelo/DAO/ClassCarroDAO.php";
        require_once "../Modelo/ClassCliente.php";
        require_once "../Modelo/DAO/ClassClienteDAO.php";
        require_once "../Modelo/ClassServico.php";
        require_once "../Modelo/DAO/ClassServicoDAO.php";


        $classClienteDAO = new ClassClienteDAO();
        $classServicoDAO = new ClassServicoDAO();
        $classCarroDAO = new ClassCarroDAO();
        $carros = $classCarroDAO->listarCarros();

        $teste = $classServicoDAO->listarServicosJoin();

        var_dump($teste);
        foreach ($carros as $carro) {

            $servico = $classServicoDAO->buscarServicoCarro($carro['idCarro']);

            if ($servico) {
                if ($servico['status'] == 'Manutencao') {
                    continue;
                }
            } else {
                continue;
            }

            echo '<div class="card">';
            echo '<img src="imagens/' . $carro['imagem'] . '" alt="' . $carro['modelo'] . '">';
            echo '<div class="info">';
            echo '<h2>' . $carro['modelo'] . '</h2>';

            $cliente = $classClienteDAO->buscarCliente($carro['idCliente']);
            if ($cliente) {
                echo '<p><strong>Cliente:</strong> ' . $cliente['nome'] . '</p>';
            } else {
                echo '<p><strong>Cliente:</strong> Não cadastrado</p>';
            }

            echo '<p><strong>Placa:</strong> ' . $carro['placa'] . '</p>';

            echo '<p><strong>Entrada:</strong> ' . $servico['dataServico'] . '</p>';
            echo '<br>';
            echo '<h3>Descrição da Manutenção:</h3> <p align="left"> ' . $servico['descricao'] . '</p>';
            // echo '<br>';
            //   echo '<p><strong>Valor Total:</strong> ' . $servico['valorServico']  . '</p>';
            echo '</div>';

            echo '<a href="ListarRelatorio.php?idex=' .$servico['idServico'] . '"><button>Ver Relatorio</button></a>';

            /*if ($carro['status'] == 'disponivel') {
                echo '<button>Vender</button>';
            } else {
                echo '<button style="background-color:rgba(0, 255, 21, 0.56);">Vendido </button>';
            }*/


            echo '</div>';
        }


        ?>
    </div>

</body>

</html>