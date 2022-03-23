<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/SacolaDAO.php';
require_once 'DAO/ClientesDAO.php';
require_once 'DAO/ProdutoDAO.php';


$dao_cli = new ClientesDAO();
$dao_prod = new ProdutoDAO();
$dao_sac = new SacolaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $id_sacola = $_GET['cod'];
    $dados = $dao_sac->DetalharSacola($id_sacola);

    if (count($dados) == 0) {
        header('location: consultar_sacola.php');
        exit;
    } else {
        if ($dados[0]['status_sacola'] == 2) {
            $ret = -8;
        }
        $itens_sacola = $dao_sac->DetalharSacolaAdd($id_sacola);
    }
} else if (isset($_POST['btnAdicionar'])) {

    $id_sacola = $_POST['cod'];
    $id_produto = $_POST['produto'];
    $qtd = $_POST['qtdproduto'];
    $valor = $_POST['valor'];
    $obs = $_POST['obs'];

    $ret = $dao_sac->AdicinarItemSacola($id_produto, $id_sacola, $qtd, $valor, $obs);

    $itens_sacola = $dao_sac->DetalharSacolaAdd($id_sacola);

    $dados = $dao_sac->DetalharSacola($id_sacola);
} else if (isset($_POST['btnExcluir'])) {

    $id_produto = $_POST['idProd'];
    $id_sacola = $_POST['idSac'];

    $ret = $dao_sac->ExcluirItemSacola($id_produto, $id_sacola);

    header("location: adicionar_item.php?cod=$id_sacola&ret=$ret");
    exit;
} else {
    header('location: consultar_sacola.php');
    exit;
}

$clientes = $dao_cli->ConsultarCliente();
$produto = $dao_prod->ConsultarProduto();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Adicionar Item</title>
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

                        <?php include_once '_msg.php' ?>

                        <h2><strong>Adicionar Item na Sacola</strong></h2>
                        <h5>Adicione mais itens há sua sacola.</h5>
                    </div>
                </div>
                <br>
                <form method="post" action="adicionar_item.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_sacola'] ?>">
                    <div class="form-group">
                        <label>Nome Cliente</label>
                        <input disabled class="form-control" value="<?= $dados[0]['nome_cliente'] ?>">

                    </div>
                    <hr>
                    <center>
                        <h3><strong> Dados da Sacola</strong></h3>
                    </center><br>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Entrega</label>
                            <input disabled type="date" class="form-control" placeholder="Coloque a data de Entrega" name="dataentrega" id="dataentrega" value="<?= $dados[0]['data_entrega'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Retirada</label>
                            <input disabled type="date" class="form-control" placeholder="Coloque a data de Retirada" name="dataretirada" id="dataretirada" value="<?= $dados[0]['data_retirada'] ?>" />
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hora de Entrega</label>
                            <input disabled type="time" class="form-control" placeholder="Coloque a hora da entrega" name="horaentrega" id="horaentrega" value="<?= $dados[0]['hora_entrega'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hora de Retirada</label>
                            <input disabled type="time" class="form-control" placeholder="Coloque a hora da retirada" name="horaretirada" id="horaretirada" value="<?= $dados[0]['hora_retirada'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Endereço de Entrega</label>
                            <input disabled type="text" class="form-control" placeholder="Coloque endereço de entrega" name="enderecoentrega" id="enderecoentrega" value="<?= $dados[0]['endereco_entrega'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Endereço de Retirada</label>
                            <input disabled type="text" class="form-control" placeholder="Coloque o endereço de retirada" name="enderecoretirada" id="enderecoretirada" value="<?= $dados[0]['endereco_retirada'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Staus Sacola</label>
                            <input disabled type="text" class="form-control" placeholder="Status da Sacola" name="status" id="status" value="<?= $dados[0]['status_sacola'] == 1 ? 'Andamento' : 'Finalizada' ?>" />
                        </div>
                    </div>
                    <br><br>
                    <hr>
                    <?php if ($dados[0]['status_sacola'] == 1) { ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome do Produto</label>
                                <select class="form-control" name="produto" id="produto">
                                    <option value="">Selecione</option>
                                    <?php foreach ($produto as $item) { ?>
                                        <option value="<?= $item['id_produto'] ?>">
                                            <?= $item['nome_produto'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantidade</label>
                                    <input class="form-control" placeholder="quantidade produto" name="qtdproduto" id="qtdproduto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input class="form-control" placeholder="valor produto" name="valor" id="valor">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Observação do item</label>
                                    <textarea name="obs" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <center>
                                <button name="btnAdicionar" onclick="return ValidarAdicionarItem()" class="btn btn-info">Add Item</button>
                            </center>
                        <?php } ?>
                </form>
                <hr>
                <?php if (isset($itens_sacola) && count($itens_sacola) > 0) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Itens Adicionados na Sacola
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>

                                                    <th>Nome</th>
                                                    <th>Descrição</th>
                                                    <th>Valor</th>
                                                    <th>Qtd.</th>
                                                    <th>Obs.</th>
                                                    <th>Total item</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $total = 0;
                                                foreach ($itens_sacola as $item) { ?>
                                                    <tr class="odd gradeX">

                                                        <td><?= $item['nome_produto'] ?></td>
                                                        <td><?= $item['descricao_produto'] ?></td>
                                                        <td>R$ <?= $item['valor_item'] ?></td>
                                                        <td><?= $item['qtd_item'] ?></td>
                                                        <td><?= $item['obs_item'] ?></td>
                                                        <td>R$ <?= $item['valor_item'] * $item['qtd_item']  ?></td>
                                                        <td>
                                                            <?php if ($dados[0]['status_sacola'] == 1) { ?>
                                                                <a href="#" data-toggle="modal" data-target="#modalExcluir<?= $i ?>" class="btn btn-danger btn-xs">Excluir</a>

                                                                <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                                                            </div>
                                                                            <form method="post" action="adicionar_item.php">
                                                                                <input type="hidden" name="idProd" value="<?= $item['id_produto'] ?>">
                                                                                <input type="hidden" name="idSac" value="<?= $item['id_sacola'] ?>">
                                                                                <div class="modal-body">
                                                                                    <center><b> Deseja excluir Item da Sacola:</b></center>
                                                                                    <br><br>
                                                                                    <b>Nome do produto: <?= $itens_sacola[0]['nome_produto'] ?><br>
                                                                                        <b>Descrição: </b><?= $itens_sacola[0]['descricao_produto'] ?> <br>
                                                                                        <b>Valor: </b><?= $itens_sacola[0]['valor_item'] ?> <br>
                                                                                        <b>Quantidade: </b><?= $itens_sacola[0]['qtd_item'] ?> <br>
                                                                                        <b>Obs: </b><?= $itens_sacola[0]['obs_item'] ?> <br>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                    <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                    $total = $total +  $item['valor_item'] * $item['qtd_item'];
                                                } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <h4><b>Total itens Sacola R$ <?= $total  ?></b></h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>