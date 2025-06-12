<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Itens ao Relatório</title>
    <link rel="stylesheet" href="css/form.css">
    <style>
        .form-container {
            width: 90%;
            max-width: 1000px;
            margin: auto;
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #e0e0e0;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #333;
        }

        th {
            background-color: #2b2b2b;
        }

        textarea,
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            background-color: #2b2b2b;
            border: 1px solid #444;
            border-radius: 6px;
            color: #fff;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #cccccc;
            font-weight: bold;
        }

        .add-btn {
            background-color: #28a745;
            padding: 10px 16px;
            font-size: 18px;
            border-radius: 6px;
            cursor: pointer;
            color: #fff;
            border: none;
        }

        .add-btn:hover {
            background-color: #218838;
        }

        .submit-btn {
            background-color: #ff0022c4;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #ff00228f;
        }
    </style>
</head>

<body>

    <?php
    include 'Menu.php';

    require_once "../Modelo/ClassServico.php";
    require_once "../Modelo/ClassServicoItem.php";
    require_once "../Modelo/DAO/ClassServicoDAO.php";
    require_once '../Modelo/ClassCliente.php';
    require_once "../Modelo/DAO/ClassClienteDAO.php";
    require_once "../Modelo/ClassCarro.php";
    require_once "../Modelo/DAO/ClassCarroDAO.php";

    $id = $_GET['idex'];
    var_dump($id);

    $classClienteDAO = new ClassClienteDAO();
    $clientes = $classClienteDAO->listarClientes();
    $classCarroDAO = new ClassCarroDAO();
    $classServicoDAO = new ClassServicoDAO();
    $carro = $classCarroDAO->buscarCarro($id);
    $cliente = $classClienteDAO->buscarCliente($carro['idCliente']);

    var_dump($carro);

    ?>



    <div class="form-container">

        <form method="post" action="../Controle/ControleServico.php?ACAO=cadastrarServico">
            <h1 class="titulo">Adicionar Itens ao Relatório</h1>

            <label for="descricaoServico">Descrição do Serviço</label>
            <textarea name="descricaoServico" id="descricaoServico" rows="4" required></textarea>

            <br> <br>

            <label for="mecanico">Mecanico Responsavel:</label>
            <select name="mecanico" id="mecanico" style=" font-size: 14px; padding: 15px; border: 1px solid #333; border-radius: 8px; width: 100%; background-color: #2b2b2b; color: #f0f0f0; resize: none;">
                <?php
                require_once '../Modelo/DAO/ClassMecanicoDAO.php';

                $DAO = new ClassMecanicoDAO();
                $mecanicos = $DAO->listarMecanico();

                var_dump($mecanicos);

                foreach ($mecanicos as $mecanico) {
                    echo "<option value='" . $mecanico['idMecanico'] . "'>" . $mecanico['nome'] . "</option>";
                }
                ?>
            </select>

            <br><br>

            <input type="hidden" name="idCarro" value="<?= $id ?>">

            <table id="itensTable">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Veículo</th>
                        <th>Cliente</th>
                        <th>Valor (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="descricao[]" required></td>
                        <td>
                            <input type="text" name="veiculo[]" value="<?= htmlspecialchars($carro['modelo']) ?>" readonly>
                        </td>
                        <td>
                            <input type="text" name="cliente[]" value="<?= htmlspecialchars($cliente["nome"]) ?>" readonly>
                        </td>
                        <td><input type="number" step="0.01" name="valor[]" required></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="add-btn" onclick="adicionarLinha()">+ Adicionar Linha</button>
            <br><br>
            <button type="submit" class="submit-btn">Salvar Relatório</button>
        </form>
    </div>

    <script>
        function adicionarLinha() {
            const tabela = document.getElementById("itensTable").getElementsByTagName('tbody')[0];
            const novaLinha = tabela.insertRow();

            const veiculo = "<?= addslashes($carro['modelo']) ?>";
            const cliente = "<?= addslashes($cliente["nome"]) ?>";

            // Descrição
            let cell1 = novaLinha.insertCell();
            let inputDescricao = document.createElement("input");
            inputDescricao.type = "text";
            inputDescricao.name = "descricao[]";
            inputDescricao.required = true;
            cell1.appendChild(inputDescricao);

            // Veículo 
            let cell2 = novaLinha.insertCell();
            let inputVeiculo = document.createElement("input");
            inputVeiculo.type = "text";
            inputVeiculo.name = "veiculo[]";
            inputVeiculo.value = veiculo;
            inputVeiculo.readOnly = true;
            cell2.appendChild(inputVeiculo);

            // Cliente 
            let cell3 = novaLinha.insertCell();
            let inputCliente = document.createElement("input");
            inputCliente.type = "text";
            inputCliente.name = "cliente[]";
            inputCliente.value = cliente;
            inputCliente.readOnly = true;
            cell3.appendChild(inputCliente);

            // Valor
            let cell4 = novaLinha.insertCell();
            let inputValor = document.createElement("input");
            inputValor.type = "number";
            inputValor.name = "valor[]";
            inputValor.step = "0.01";
            inputValor.required = true;
            cell4.appendChild(inputValor);
        }
    </script>
</body>

</html>