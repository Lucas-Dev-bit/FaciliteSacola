<?php

require_once 'DAO/UtilDAO.php';

if (isset($_GET['close']) && $_GET['close'] == '1') {
    UtilDAO::Deslogar();
}
?>

<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a href="meus_dados.php"><i class="fa fa-user fa-2x"></i>Meus dados</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-2x"></i>Clientes<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="cadastrar_cliente.php">Cadastrar Cliente</a>
                    </li>
                    <li>
                        <a href="consultar_cliente.php">Consultar Clientes</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-2x"></i>Produtos<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="cadastrar_produto.php">Cadastrar Produto</a>
                    </li>
                    <li>
                        <a href="consultar_produto.php">Consultar Produto</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-2x"></i>Sacola<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                    <li>
                        <a href="fazer_sacola.php">Fazer Sacola</a>
                    </li>
                    <li>
                        <a href="consultar_sacola.php">Consultar Sacola</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="_menu.php?close=1"><i class="fa fa-square-o fa-2x"></i>Sair</a>
            </li>
        </ul>
    </div>
</nav>