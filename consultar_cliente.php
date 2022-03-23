<?php

require_once '../facilitesacola/DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../facilitesacola/DAO/ClientesDAO.php';

$dao = new ClientesDAO();
$clientes = $dao->ConsultarCliente();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Consultar Cliente</title>
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

                        <h2><strong>Consultar Cliente</strong></h2>
                    </div>
                </div>
                <hr />
                <div class="row">

                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Aqui você pode consultar todos os seus Clientes.
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Rua</th>
                                                <th>Bairro</th>
                                                <th>Telefone</th>
                                                <th>Whatsapp</th>
                                                <th>Data Nascimento</th>
                                                <th>Sexo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($clientes as $item) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $item['nome_cliente'] ?></td>
                                                    <td><?= $item['rua_cliente'] ?></td>
                                                    <th><?= $item['bairro_cliente'] ?></th>
                                                    <td><?= $item['tel_cliente'] ?></td>
                                                    <td><?= $item['whats_cliente'] ?></td>
                                                    <td><?= $item['nascimento_cliente'] ?></td>
                                                    <td><?= $item['sexo_cliente'] == 1 ? 'Masculino' : 'Feminino' ?></td>
                                                    <td>
                                                        <a href="alterar_cliente.php?cod=<?= $item['id_cliente'] ?>" class="btn btn-primary">Alterar</a>
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
    </div>
</body>

</html>