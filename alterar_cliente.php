<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/ClientesDAO.php';

$dao = new ClientesDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idCliente = $_GET['cod'];

    $dados = $dao->DetalharCliente($idCliente);

    if (count($dados) == 0) {
        header('location: consultar_cliente.php');
        exit;
    }
} else if (isset($_POST['btnGravar'])) {

    $idCliente = $_POST['cod'];
    $nome = $_POST['nome'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $tel = $_POST['tel'];
    $whats = $_POST['whats'];
    $datanascimento = $_POST['datanascimento'];
    $sexo = $_POST['sexo'];

    $ret = $dao->AlterarCliente($idCliente, $nome, $rua, $bairro, $tel, $whats, $datanascimento, $sexo);

    header('location: consultar_cliente.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExluir'])) {

    $idCliente = $_POST['cod'];
    $ret = $dao->ExcluirCliente($idCliente);

    header('location: consultar_cliente.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_cliente.php');
    exit;
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Alterar Cliente</title>
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

                        <h2>Alterar Cliente</h2>
                    </div>
                </div>
                <hr />
                <form method="post" action="alterar_cliente.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_cliente'] ?>">
                    <div class="form-group">
                        <label>Nome Cliente</label>
                        <input class="form-control" placeholder="Nome do seu cliente" name="nome" id="nome" value="<?= $dados[0]['nome_cliente'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Rua</label>
                        <input class="form-control" placeholder="Rua do seu cliente" name="rua" id="rua" value="<?= $dados[0]['rua_cliente'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Bairro</label>
                        <input class="form-control" placeholder="Bairro do seu cliente" name="bairro" id="bairro" value="<?= $dados[0]['bairro_cliente'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="tel" class="form-control" placeholder="Contato do seu cliente" name="tel" id="tel" value="<?= $dados[0]['tel_cliente'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Whatsapp</label>
                        <input type="tel" class="form-control" placeholder="Contato Whatsapp do seu cliente" name="whats" id="whats" value="<?= $dados[0]['whats_cliente'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>
                        <input type="date" class="form-control" placeholder="Contato Whatsapp do seu cliente" name="datanascimento" id="datanascimento" value="<?= $dados[0]['nascimento_cliente'] ?>">
                    </div>

                    <div class="form-group">

                        <label>Sexo</label>
                        <select class="form-control" name="sexo" id="sexo">
                            <option value="">Selecione</option>
                            <option value="1" <?= $dados[0]['sexo_cliente'] == 1 ? 'selected' : '' ?>>Masculino</option>
                            <option value="2" <?= $dados[0]['sexo_cliente'] == 2 ? 'selected' : '' ?>>Feminino</option>
                        </select>
                    </div>
                    <button name="btnGravar" onclick="return ValidarNovoCliente()" type="submit" class="btn btn-success">Gravar</button>

                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Exluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir o cliente: <b> <?= $dados[0]['nome_cliente'] ?> </b>
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