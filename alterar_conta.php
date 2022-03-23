<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Facilite Sacola - Alterar Conta</title>
<?php
include_once '_head.php';
?>
<body>
    <div id="wrapper">
        <?php
            include_once '_topo.php';
            include_once '_menu.php';
        ?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Alterar Conta</h2>   
                        <h5>Aqui você poderá alterar todas as suas Contas</h5>                    
                    </div>
                </div>
                 <hr />
                 <div class="form-group">
                    <label>Nome do Banco*</label>
                    <input class="form-control" placeholder="Digite o nome do Banco" />
                </div>
                <div class="form-group">
                    <label>Agencia*</label>
                    <input class="form-control" placeholder="Digite a Agencia" />
                </div>
                <div class="form-group">
                    <label>Numero da Conta*</label>
                    <input class="form-control" placeholder="Digite o numero da conta" />
                </div>
                <div class="form-group">
                    <label>Saldo*</label>
                    <input class="form-control" placeholder="Digite o saldo" />
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
        </div>        
    </div>   
</body>
</html>
