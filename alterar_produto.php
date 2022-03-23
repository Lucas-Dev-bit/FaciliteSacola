<?php

require_once '../facilitesacola/DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../facilitesacola/DAO/ProdutoDAO.php';

$dao = new ProdutoDAO;

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idProduto = $_GET['cod'];

    $dados = $dao->DetalharProduto($idProduto);

    if (count($dados) == '') {
        header('location: consultar_produto.php');
        exit;
    }
} else if (isset($_POST['btnGravar'])) {

    $idProduto = $_POST['cod'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $codigo = $_POST['codigo'];
    $tamanho = $_POST['tamanho'];
    $pcompra = $_POST['pcompra'];
    $pvenda = $_POST['pvenda'];

    $ret = $dao->AlterarProduto($idProduto, $nome, $descricao, $codigo, $tamanho, $pcompra, $pvenda);

    header('location: consultar_produto.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {

    $idProduto = $_POST['cod'];
    $ret = $dao->ExcluirProduto($idProduto);

    header('location: consultar_produto.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_produto.php');
    exit;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facilite Sacola - Alterar Produto</title>
<?php
include_once "_head.php";
?>

<body>
    <div id="wrapper">
        <?php
        include_once "_topo.php";
        include_once "_menu.php";
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <?php require_once '_msg.php' ?>

                        <h2><strong>Alterar Produto</strong></h2>
                    </div>
                </div>
                <hr />
                <form method="post" action="alterar_produto.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_produto'] ?>">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Nome do produto" name="nome" id="nome" value="<?= $dados[0]['nome_produto'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <input class="form-control" placeholder="Descrição do produto" name="descricao" id="descricao" value="<?= $dados[0]['descricao_produto'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Código</label>
                        <input class="form-control" placeholder="Código do produto" name="codigo" id="codigo" value="<?= $dados[0]['codigo_produto'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Tamanho</label>
                        <input class="form-control" placeholder="Tamanho da peça" name="tamanho" id="tamanho" value="<?= $dados[0]['tamanho_produto'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Preço de Compra</label>
                        <input class="form-control" placeholder="Preço de compra" name="pcompra" id="pcompra" value="<?= $dados[0]['preco_compra'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Preço de Venda</label>
                        <input class="form-control" placeholder="preço de Venda" name="pvenda" id="pvenda" value="<?= $dados[0]['preco_venda'] ?>">
                    </div>
                    <button name="btnGravar" onclick="return ValidarProduto()" type="submit" class="btn btn-success">Gravar</button>

                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Exluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir o produto: <b> <?= $dados[0]['nome_produto'] ?> / Descrição: <?= $dados[0]['descricao_produto'] ?> - Código: <?= $dados[0]['codigo_produto'] ?> </b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>