<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/ClientesDAO.php';
require_once 'DAO/SacolaDAO.php';

$dao_sac = new SacolaDAO();
$dao_cli = new ClientesDAO();
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $id_sacola = $_GET['cod'];
    $dados = $dao_sac->DetalharSacola($id_sacola);

    if (count($dados) == 0) {
        header('location: consultar_sacola.php');
        exit;
    }
} else if (isset($_POST['btnGravar'])) {

    $id_sacola = $_POST['cod'];
    
    $dataentrega = $_POST['data_entrega'];
    $dataretirada = $_POST['data_retirada'];
    $horaentrega = $_POST['hora_entrega'];
    $horaretirada = $_POST['hora_retirada'];
    $endentrega = $_POST['endereco_entrega'];
    $endretirada = $_POST['endereco_retirada'];
    $obs = $_POST['obs'];
    $status = $_POST['status'];

    $ret = $dao_sac->AterarSacola($id_sacola, $dataentrega, $dataretirada, $horaentrega, $horaretirada, $endentrega, $endretirada, $obs, $status);

    header('location: consultar_sacola.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {

    $id_sacola = $_POST['cod'];

    $ret = $dao_sac->ExcluirSacola($id_sacola);

    header('location: consultar_sacola.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_sacola.php');
    exit;
}

$clientes = $dao_cli->ConsultarCliente();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Alterar Sacola</title>
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <?php include_once '_msg.php' ?>

                        <h2><strong> Alterar Sacola</strong></h2>
                        <h5>Aqui você poderá alterar a sacola para seu cliente.</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="alterar_sacola.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_sacola'] ?>">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Selecione o Cliente</label>
                            <input disabled class="form-control" value="<?= $dados[0]['nome_cliente'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Entrega</label>
                            <input type="date" class="form-control" placeholder="Coloque a data de Entrega" name="data_entrega" id="data_entrega" value="<?= $dados[0]['data_entrega'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Retirada</label>
                            <input type="date" class="form-control" placeholder="Coloque a data de Retirada" name="data_retirada" id="data_retirada" value="<?= $dados[0]['data_retirada'] ?>" />
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hora de Entrega</label>
                            <input type="time" class="form-control" placeholder="Coloque a hora da entrega" name="hora_entrega" id="hora_entrega" value="<?= $dados[0]['hora_entrega'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hora de Retirada</label>
                            <input type="time" class="form-control" placeholder="Coloque a hora da retirada" name="hora_retirada" id="hora_retirada" value="<?= $dados[0]['hora_retirada'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Endereço de Entrega</label>
                            <input type="text" class="form-control" placeholder="Coloque endereço de entrega" name="endereco_entrega" id="endereco_entrega" value="<?= $dados[0]['endereco_entrega'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Endereço de Retirada</label>
                            <input type="text" class="form-control" placeholder="Coloque o endereço de retirada" name="endereco_retirada" id="endereco_retirada" value="<?= $dados[0]['endereco_retirada'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status da Sacola</label>
                            <select name="status" class="form-control">
                                <option value="1" <?= $dados[0]['status_sacola'] == 1 ? 'selected' : '' ?>>Em andamento</option>
                                <option value="2" <?= $dados[0]['status_sacola'] == 2 ? 'selected' : '' ?>>Finalizado</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação(opcional)</label>
                            <textarea name="obs" id="obs" class="form-control" rows="3"><?= $dados[0]['obs_sacola'] ?></textarea>
                        </div>
                        <button name="btnGravar" onclick="return ValidarFazerSacola()" type="submit" class="btn btn-success">Gravar</button>

                        <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Exluir</button>

                        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                    </div>
                                    <div class="modal-body">
                                        <center><b> Deseja excluir Sacola:</b></center>
                                        <br><br>
                                        <b>Nome Cliente: </b><?= $dados[0]['nome_cliente'] ?> <br>
                                        <b>Status Sacola: </b><?= $dados[0]['status_sacola'] == 1 ? 'Andamento' : 'Finalizada' ?> <br>
                                        <b>observação: </b><?= $dados[0]['obs_sacola'] ?> <br>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>