<?php


require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/ProdutoDAO.php';

if (isset($_POST['btnGravar'])) {

    $nome = $_POST['nome'];
    $descicao = $_POST['descricao'];
    $codigo = $_POST['codigo'];
    $tamanho = $_POST['tamanho'];
    $pcompra = $_POST['pcompra'];
    $pvenda = $_POST['pvenda'];

    $objdao = new ProdutoDAO();

    $ret = $objdao->CadastrarProduto($nome, $descicao, $codigo, $tamanho, $pcompra, $pvenda);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facilite Sacola - Cadastrar Produto</title>
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

                        <h2><strong>Cadastrar Produto</strong></h2>
                    </div>
                </div>
                <hr />
                <form method="post" action="cadastrar_produto.php">
                    <div class="form-group">
                        <label>Nome do Produto</label>
                        <input class="form-control" placeholder="nome produto" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <input class="form-control" placeholder="Descrição do produto" name="descricao" id="descricao">
                    </div>
                    <div class="form-group">
                        <label>Código</label>
                        <input class="form-control num cod" placeholder="Código do produto" name="codigo" id="codigo">
                    </div>
                    <div class="form-group">
                        <label>Tamanho</label>
                        <input class="form-control" placeholder="Tamanho da peça" name="tamanho" id="tamanho">
                    </div>
                    <div class="form-group">
                        <label>Preço de Compra</label>
                        <input class="form-control dinheiro .num .dinheiro" placeholder="Preço de compra" name="pcompra" id="pcompra">
                    </div>
                    <div class="form-group">
                        <label>Preço de Venda</label>
                        <input class="form-control dinheiro .num .dinheiro" placeholder="preço de Venda" name="pvenda" id="pvenda">
                    </div>
                    <button name="btnGravar" onclick="return ValidarProduto()" type="submit" class="btn btn-success">Gravar</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>