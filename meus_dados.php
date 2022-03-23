<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/UsuarioDAO.php';

$objdao = new UsuarioDAO();

if (isset($_POST['btnGravar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];


    $ret = $objdao->GravarMeusDados($nome, $email);
}

$dados = $objdao->CarregarMeusDados();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Meus Dados</title>
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

                        <h2><strong>Meus Dados</strong></h2>
                        <h5>Nesta página, você poderá alterar seus dados. </h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="meus_dados.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite o seu nome" name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" placeholder="Digite o seu email" name="email" id="email" value="<?= $dados[0]['email_usuario'] ?>" />
                    </div>
                    <button type="submit" name="btnGravar" onclick="return ValidarMeusDados()" class="btn btn-success">Gravar</button>
                </form>
            </div>

        </div>
    </div>
</body>

</html>