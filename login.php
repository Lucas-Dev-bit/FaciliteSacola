<?php

require_once 'DAO/UsuarioDAO.php';


if (isset($_POST['btnAcessar'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objdao = new UsuarioDAO();

    $ret = $objdao->ValidarLogin($email, $senha);
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<style>
    img {
        margin: auto;
        width: 100px;
    }

    .face {
        margin: 8px;
        width: 30px;

    }
</style>


<title>Facilite Sacola - Acesso</title>
<?php
include_once "_head.php";
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />


                <?php require_once '_msg.php' ?>
                <img src="./assets/img/sacola.png">
                <h1> <strong>Facilite Sacola</strong> </h1>

                <h5> Faça seu login </h5>
                <br />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center><strong>Entre com seus dados</strong></center>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="login.php">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Seu@email.com" name="email" id="email" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Sua senha" name="senha" id="senha" />
                            </div>
                            <button onclick="return ValidarLogin()" name="btnAcessar" class="btn btn-primary ">Acessar</button>
                            <hr />
                        </form>
                    </div>
                </div>
                <center>

                    <h4>Desenvolvido por: <br><strong><a href="https://www.linkedin.com/in/lucas-claro-b7071b145/" target="_blank">Lucas Claro</a></strong></h4>


                    <div class="social">
                        <a href="https://www.facebook.com/lucas.claro.982" target="_blank"><img src="./assets/img/facebook.png" class="face"></a>
                        <a href="https://www.instagram.com/the_lucasx/" target="_blank"><img src="./assets/img/instagram.png" class="face"></a>
                        <a href="#" target="_blank"><img src="./assets/img/twitter.png" class="face"></a>
                        <a href="https://github.com/Lucas-Dev-bit" target="_blank"><img src="./assets/img/github.png" class="face"></a>
                    </div>

                </center>
            </div>
        </div>
    </div>
</body>


</html>