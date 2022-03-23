<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/SacolaDAO.php';

$dao = new SacolaDAO();

$total_finalizada = $dao->TotalFinalizada();
$total_andamento = $dao->TotalAndamento();
$sacola = $dao->MostrarUltimosLancamentos();
$valorAndamento = $dao->TotalValorAndamento();
$valorFinalizada = $dao->TotalValorFinalizado();
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola</title>
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

                        <h2><strong>Página Inicial</strong></h2>
                        <h5>Aqui você tem um balanço geral.</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-border bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h4>Finalizadas</h4>
                            <h3> <?= $total_finalizada[0]['total'] != null ? $total_finalizada[0]['total'] : '0' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            <h4>TOTAL FINALIZADA</h4>
                            <h3>R$ <?= $valorFinalizada[0]['valor_total'] ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-border bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h4>Andamento</h4>
                            <h3> <?= $total_andamento[0]['total'] != null ? $total_andamento[0]['total'] : '0' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            <h4>TOTAL ANDAMENTO</h4>
                            <h3>R$ <?= $valorAndamento[0]['valor_total'] ?></h3>
                        </div>

                    </div>
                </div>
                <hr>

                <?php if (count($sacola) > 0) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Últimos 10 lançamentos</b>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nome Cliente</th>
                                                    <th>Data Entrega</th>
                                                    <th>Hora Entrega</th>
                                                    <th>Endereço Entrega</th>
                                                    <th>Status</th>
                                                    <th>Valor da Sacola</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($sacola as $item) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $item['nome_cliente'] ?></td>
                                                        <td><?= $item['data_entrega'] ?></td>
                                                        <td><?= $item['hora_entrega'] ?></td>
                                                        <td><?= $item['endereco_entrega'] ?></td>
                                                        <td><?= $item['status_sacola'] == 1 ? 'Andamento' : 'Finalizada' ?></td>
                                                        <td>R$ <?= $item['total_sacola'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <center>
                        <div class="alert alert-info col-md-12">
                            Não existe nenhuma sacola para ser exibida!
                        </div>
                    </center>
                <?php } ?>

            </div>
        </div>
    </div>

</body>

</html>