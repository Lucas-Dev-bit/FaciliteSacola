<?php

require_once './DAO/UtilDAO.php';

?>

<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="inicial.php">Facilite Sacola</a>
        </div>
        <div style="color: white;
        padding: 5px 50px 5px 50px;
        float: right;
        font-size: 17px;">Olá: <?= UtilDAO::NomeLogado() ?> <br> Dúvidas ligue para (45) 99926-3654 </div>
       
    </nav>