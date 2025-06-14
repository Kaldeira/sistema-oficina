<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Em Manutenção</title>
    <link rel="stylesheet" href="css/showroom.css">
</head>

<body>
    <?php
    include 'Menu.php';
    ?>

    <h1 class="titulo">Veículos em Manutenção</h1>

    <div class="carros-container">

        <?php
        require_once '../Modelo/ClassCarro.php';
        require_once "../Modelo/DAO/ClassCarroDAO.php";
        require_once "../Modelo/ClassCliente.php";
        require_once "../Modelo/DAO/ClassClienteDAO.php";
        require_once "../Modelo/ClassServico.php";
        require_once "../Modelo/DAO/ClassServicoDAO.php";



        $classCarroDAO = new ClassCarroDAO();
        $carros = $classCarroDAO->listarCarros();

        $classClienteDAO = new ClassClienteDAO();
        $classServicoDAO = new ClassServicoDAO();

        foreach ($carros as $carro) {

            $servico = $classServicoDAO->buscarServicoCarro($carro['idCarro']);

            if ($servico) {
                if ($carro['status'] == 'Finalizado') {
                    continue;
                }
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


            echo '<p><strong>Ano:</strong> ' . $carro['ano'] . '</p>';
            echo '<p><strong>Fabricante:</strong> ' . $carro['fabricante'] . '</p>';
            echo '<p><strong>Cor:</strong> ' . $carro['cor'] . '</p>';
            echo '<p><strong>Características:</strong> ' . $carro['caracteristicas'] . '</p>';
            echo '</div>';
            //echo '<button>Vender</button>';
            echo '<div class="botoes">';
            echo '<a href="FormRelatorio.php?idex=' . $carro['idCarro'] . '" class="btn-finalizar">Finalizar</a>';
            echo '<a href="AlterarCarro.php?idex=' . $carro['idCarro'] . '" class="btn-editar">Editar</a>';
            echo '<a href="../Controle/ControleCarro.php?ACAO=excluirCarro&idex=' . $carro['idCarro'] . '" class="btn-excluir" onclick="return confirm(\'Tem certeza que deseja excluir este carro?\')">Excluir</a>';
            echo '</div>';


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