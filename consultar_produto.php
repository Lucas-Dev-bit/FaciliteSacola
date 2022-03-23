<?php

require_once '../facilitesacola/DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../facilitesacola/DAO/ProdutoDAO.php';

$dao = new ProdutoDAO;

$produto = $dao->ConsultarProduto();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Consulta Produto</title>
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

                        <h2><strong>Consultar Produto</strong></h2>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Aqui você pode consultar todos os seus produtos.
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Código</th>
                                                <th>Tamanhos</th>
                                                <th>Preço Compra</th>
                                                <th>Preço Venda</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($produto); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $produto[$i]['nome_produto'] ?></td>
                                                    <td><?= $produto[$i]['descricao_produto'] ?></td>
                                                    <td><?= $produto[$i]['codigo_produto'] ?></td>
                                                    <td><?= $produto[$i]['tamanho_produto'] ?></td>
                                                    <td><?= $produto[$i]['preco_compra'] ?></td>
                                                    <td><?= $produto[$i]['preco_venda'] ?></td>
                                                    <td>
                                                        <a href="alterar_produto.php?cod=<?= $produto[$i]['id_produto'] ?>" class="btn btn-primary">Alterar</a>
                                                    
                                                    </td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>