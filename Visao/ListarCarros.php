<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Carros</title>
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

        $classCarroDAO = new ClassCarroDAO();
        $carros = $classCarroDAO->listarCarros();

        $classClienteDAO = new ClassClienteDAO();

        foreach ($carros as $carro) {
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
            echo '<a href="" class="btn btn-editar">Finalizar</a>';
            echo '<a href="AlterarCarro.php?idex=' . $carro['idCarro'] . '"class="btn btn-editar">Editar</a>';
            echo '<a href="" class="btn btn-editar">Excluir</a>';
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