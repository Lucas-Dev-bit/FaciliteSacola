<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/SacolaDAO.php';
require_once 'DAO/ClientesDAO.php';

$situacao = '';
$dt_inicial = '';
$dt_final = '';

$dao = new SacolaDAO();
$dao_cli = new ClientesDAO();

if (isset($_POST['btnPesquisar'])) {

        $situacao = $_POST['situacao'];
        $dt_inicial = $_POST['inicial'];
        $dt_final = $_POST['final'];

        $dao = new SacolaDAO();

        $sacolas = $dao->FiltrarSacola($situacao, $dt_inicial, $dt_final);
    
}


//$clientes = $dao_cli->DetalharCliente($idCliente);
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Consulta Sacola</title>
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

                        <h2><strong>Consultar Sacola</strong></h2>
                        <h5>Consulte todas as sacolas no período informado</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="consultar_sacola.php">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Situação da Sacola</label>
                            <select class="form-control" name="situacao" id="situacao" />
                            <option value="0" <?= $situacao == '0' ? 'selected' : '' ?>>TODOS</option>
                            <option value="1" <?= $situacao == '1' ? 'selected' : '' ?>>Em Andamento</option>
                            <option value="2" <?= $situacao == '2' ? 'selected' : '' ?>>Finalizada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Inicial</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do movimento" name="inicial" id="inicial" value="<?= $dt_inicial ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Final</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do movimento" name="final" id="final" value="<?= $dt_final ?>" />
                        </div>
                    </div>
                    <center>
                        <button name="btnPesquisar" onclick="return ValidarConsultarSacola()" class="btn btn-info">Pesquisar</button>
                    </center>
                    <hr>
                </form>
                <?php if (isset($sacolas)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resultados encontrados
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Data Entrega</th>
                                                    <th>Data Retirada</th>
                                                    <th>Hora Entrega</th>
                                                    <th>Hora Retirada</th>
                                                    <th>Endereço Entrega</th>
                                                    <th>Endereço Retirada</th>
                                                    <th>Status</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($sacolas as $item) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $item['nome_cliente'] ?></td>
                                                        <td><?= $item['data_entrega'] ?></td>
                                                        <td><?= $item['data_retirada'] ?></td>
                                                        <td><?= $item['hora_entrega'] ?></td>
                                                        <td><?= $item['hora_retirada'] ?></td>
                                                        <td><?= $item['endereco_entrega'] ?></td>
                                                        <td><?= $item['endereco_retirada'] ?></td>
                                                        <td><?= $item['status_sacola'] == 1 ? 'Em andamento' : 'Finalizada' ?></td>
                                                        <td>
                                                            <a href="alterar_sacola.php?cod=<?= $item['id_sacola'] ?>" class="btn btn-warning btn-xs">Alterar</a>
                                                            <a href="adicionar_item.php?cod=<?= $item['id_sacola'] ?>" class="btn btn-info btn-xs">Adicionar</a>
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
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>