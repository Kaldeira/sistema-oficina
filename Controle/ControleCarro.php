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
$novoCarro = new ClassCarro();
$novoCarro->setIdCarro($id);
$novoCarro->setModelo($modelo);
$novoCarro->setFabricante($fabricante);
$novoCarro->setAno($ano);
$novoCarro->setPlaca($placa);
$novoCarro->setCor($cor);
$novoCarro->setIdCliente($idCliente);
$novoCarro->setCaracteristicas($caracteristicas);
//$novoCarro->setDescricao(@$_POST['descricao']);
//$novoCarro->setIdMecanico(@$_POST['mecanico']);
$novoCarro->setIdCliente(@$_POST['cliente']);
$novoCarro->setStatus('Manutencao'); // Define o status como 'Manutencao' por padrão


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

//printf("<br>acao: %s", $acao);

$urlAlt = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/AlterarCarro.php';
$urlCad = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/CadastroCarro.php';
$url = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/ListarCarros.php';

$classCarroDAO = new ClassCarroDAO();
switch ($acao) {
    case "cadastrarCarro":
        $carro = $classCarroDAO->cadastrar($novoCarro);
        if ($carro >= 1) {
            header('Location:../Visao/ListarCarros.php?&MSG= Cadastro realizado com sucesso!');
            //$servico = $classCarroDAO->cadastrarServico($novoCarro);
        } else {
            echo "<script> alert('Não foi possivel realizar o cadastro!');
        window.location.href = '$urlCad';
      </script>";
        }
        break;
    case 'alterarCarro':
        //codigo aqui   
        $carro = $classCarroDAO->alterarCarro($novoCarro);
        if ($carro == 1) {
            header('Location:../Visao/ListarCarros.php?&MSG= Cadastro atualizado com sucesso!');
        } else {
            echo "<script> alert('Não foi possível alterar!');
        window.location.href = '$urlAlt';
      </script>";
        }

        break;

    case "excluirCarro":
        if (isset($_GET['idex'])) {
            $idCarro = $_GET['idex'];
            //echo "<br>idex:" . $idCarro ;
            $classCarroDAO = new ClassCarroDAO();
            $car = $classCarroDAO->deletarCarro($idCarro);
            if ($car == TRUE) {
                header('Location:../Visao/ListarCarros.php?PAGINA=listarCarros&MSG= Carro foi excluido com sucesso!');
            } else {
                echo "<script> alert('Não foi possível Deletar!'); window.location.href = '$url'; </script>";
            }
        } else {
            echo "<script> alert('Não foi possível Deletar!'); window.location.href = '$url'; </script>";
        }

        break;
    default:
        break;
}
