<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/ClientesDAO.php';
require_once 'DAO/ProdutoDAO.php';
require_once 'DAO/SacolaDAO.php';

$dao_cli = new ClientesDAO();

if (isset($_POST['btnGravar'])) {

    $cliente = $_POST['cliente'];
    $Dentrega = $_POST['dataentrega'];
    $Dretirada = $_POST['dataretirada'];
    $Hentrega = $_POST['horaentrega'];
    $Hretirada = $_POST['horaretirada'];
    $Eentrega = $_POST['enderecoentrega'];
    $Eretirada = $_POST['enderecoretirada'];
    $obs = $_POST['obs'];

    $dao = new SacolaDAO();

    $ret = $dao->FazerSacola($cliente, $Dentrega, $Dretirada, $Hentrega, $Hretirada, $Eentrega, $Eretirada, $obs);

    
}

$clientes = $dao_cli->ConsultarCliente();

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Fazer Sacola</title>
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

                        <?php require_once '_msg.php' ?>

                        <h2><strong>Fazer Sacola</strong></h2>
                        <h5>Aqui você pode fazer uma sacola para seu cliente</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="fazer_sacola.php">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Selecione o Cliente</label>
                            <select class="form-control" name="cliente" id="cliente">
                                <?php foreach ($clientes as $item) { ?>
                                    <option value="<?= $item['id_cliente'] ?>">
                                        <?= $item['nome_cliente'] ?>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Entrega</label>
                            <input type="date" class="form-control" placeholder="Coloque a data de Entrega" name="dataentrega" id="dataentrega" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Retirada</label>
                            <input type="date" class="form-control" placeholder="Coloque a data de Retirada" name="dataretirada" id="dataretirada" />
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hora de Entrega</label>
                            <input type="time" class="form-control" placeholder="Coloque a hora da entrega" name="horaentrega" id="horaentrega" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hora de Retirada</label>
                            <input type="time" class="form-control" placeholder="Coloque a hora da retirada" name="horaretirada" id="horaretirada" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Endereço de Entrega</label>
                            <input type="text" class="form-control" placeholder="Coloque endereço de entrega" name="enderecoentrega" id="enderecoentrega" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Endereço de Retirada</label>
                            <input type="text" class="form-control" placeholder="Coloque o endereço de retirada" name="enderecoretirada" id="enderecoretirada" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação(opcional)</label>
                            <textarea name="obs" id="obs" class="form-control" rows="3"></textarea>
                        </div>
                        <button name="btnGravar" onclick="return ValidarFazerSacola()" type="submit" class="btn btn-success">Gravar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>