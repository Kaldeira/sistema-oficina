<?php
require_once '../Modelo/ClassCarro.php';
require_once "../Modelo/DAO/ClassCarroDAO.php";
require_once "../Modelo/ClassServico.php";

$id = @$_POST['idex'];
$modelo = @$_POST['modelo'];
$fabricante = @$_POST['fabricante'];
$ano = @$_POST['ano'];
$placa = @$_POST['placa'];
$cor = @$_POST['cor'];
$idCliente = @$_POST['idCliente'];
$caracteristicas = @$_POST['caracteristicas'];
$acao = $_GET['ACAO'];

//$novoCarro = new ClassCarro();
$novoCarro = new ClassServico();
$novoCarro->setIdCarro($id);
$novoCarro->setModelo($modelo);
$novoCarro->setFabricante($fabricante);
$novoCarro->setAno($ano);
$novoCarro->setPlaca($placa);
$novoCarro->setCor($cor);
$novoCarro->setIdCliente($idCliente);
$novoCarro->setCaracteristicas($caracteristicas);
$novoCarro->setDescricao(@$_POST['descricao']);
$novoCarro->setIdMecanico(@$_POST['mecanico']);
$novoCarro->setIdCliente(@$_POST['cliente']);


if (isset($_FILES['imagem']['name']) && !empty($_FILES['imagem']['name'])) {
    $nomeArquivo = strtolower($_FILES['imagem']['name']);
    $novoNome = md5(time()) . '-' . $nomeArquivo; // gera um novo nome para o arquivo
    $caminhoRelativo = "../Visao/imagens/" . $novoNome; 
    $caminhoCompleto = __DIR__ . "/../Visao/imagens/" . $novoNome;

    printf("<br>Nome original: %s", $_FILES['imagem']['name']);
    printf("<br>Tipo do arquivo: %s", $_FILES['imagem']['type']);
    printf("<br>Novo nome: %s", $novoNome);
    printf("<br>Destino (relativo): %s<br>", $caminhoRelativo);

    // Move o arquivo do diretório temporário para a pasta final
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoRelativo)) {
        $novoCarro->setImagem($novoNome); // Salva apenas o nome no banco
    } else {
        echo "<br>Erro ao mover o arquivo!";
    }
}


var_dump($novoCarro);

$classCarroDAO = new ClassCarroDAO();
switch ($acao) {
    case "cadastrarCarro":
        $carro = $classCarroDAO->cadastrar($novoCarro);
        if ($carro >= 1) {
            header('Location:../Visao/ListarCarros.php?&MSG= Cadastro realizado com sucesso!');
            //$servico = $classCarroDAO->cadastrarServico($novoCarro);
        } else {
            header('Location:../Visao/CadastroCarro.php?&MSG= Não foi possivel realizar o cadastro!');
        }
        break;
    /*case 'alterarCarro':
        //codigo aqui   
        $carro = $classCarroDAO->alterarCarro($novoCarro);
        if ($carro == 1) {
            header('Location:../index.php?&MSG= Cadastro atualizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG= Não foi possivel realizar a atualização!');
        }

        break;

    case "excluirCarro":
        if (isset($_GET['idex'])) {
            $idCarro = $_GET['idex'];
            $classCarroDAO = new ClassCarroDAO();
            $car = $classCarroDAO->excluirCarros($idCarro);
            if ($car == TRUE) {
                header('Location:../index.php?PAGINA=listarCarros&MSG= Carro foi excluido com sucesso!');
            } else {
                header('Location:../index.php?PAGINA=listarCarros&MSG=Não foi possivel realizar a exclusão do Carro!');
            }
        }

        break;*/
    default:
        break;
}
?>