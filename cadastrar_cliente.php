<?php


require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/ClientesDAO.php';

if (isset($_POST['btnGravar'])) {

    $nome = $_POST['nome'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $tel = $_POST['tel'];
    $whats = $_POST['whats'];
    $datanascimento = $_POST['datanascimento'];
    $sexo = $_POST['sexo'];

    $objdao = new ClientesDAO();

    $ret = $objdao->CadastrarNovoCliente($nome, $rua, $bairro, $tel, $whats, $datanascimento, $sexo);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Cadastrar Cliente</title>
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

                        <h2><strong> Novo Cliente</strong></h2>
                    </div>
                </div>
                <hr />
                <form method="post" action="cadastrar_cliente.php">
                    <div class="form-group">
                        <label>Nome Cliente</label>
                        <input class="form-control" placeholder="Nome do seu cliente" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                        <label>Rua</label>
                        <input class="form-control" placeholder="Rua do seu cliente" name="rua" id="rua">
                    </div>
                    <div class="form-group">
                        <label>Bairro</label>
                        <input class="form-control" placeholder="Bairro do seu cliente" name="bairro" id="bairro">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="tel" class="form-control num tel" placeholder="Contato do seu cliente" name="tel" id="tel">
                    </div>
                    <div class="form-group">
                        <label>Whatsapp</label>
                        <input type="tel" class="form-control num cel" placeholder="Contato Whatsapp do seu cliente" name="whats" id="whats">
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>
                        <input type="date" class="form-control" placeholder="Contato Whatsapp do seu cliente" name="datanascimento" id="datanascimento">
                    </div>

                    <div class="form-group">


                        <label>Sexo</label>
                        <select class="form-control" name="sexo" id="sexo">
                            <option value="">Selecione</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>

                    </div>
                    <button name="btnGravar" onclick="return ValidarNovoCliente()" type="submit" class="btn btn-success">Gravar</button>
                </form>
            </div>
        </div>
    </div>
    </div>

</body>

</html>