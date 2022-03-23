<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ProdutoDAO extends Conexao
{

    public function CadastrarProduto($nome, $descricao, $codigo, $tamanho, $pcompra, $pvenda)
    {

        if (trim($nome) == '' || trim($descricao) == '' || trim($codigo) == '' || trim($tamanho) == '' || trim($pcompra) == '' || trim($pvenda) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'insert into tb_produto
                        (nome_produto, descricao_produto, codigo_produto, tamanho_produto, preco_compra, preco_venda, id_usuario)
                        values
                        (?, ?, ?, ?, ?, ?, ?)';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $descricao);
        $sql->bindValue(3, $codigo);
        $sql->bindValue(4, $tamanho);
        $sql->bindValue(5, $pcompra);
        $sql->bindValue(6, $pvenda);
        $sql->bindValue(7, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarProduto()
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_produto,
                               nome_produto,
                               descricao_produto,
                               codigo_produto,
                               tamanho_produto,
                               preco_compra,
                               preco_venda
                          from tb_produto
                         where id_usuario = ? order by nome_produto ASC';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharProduto($idProduto)
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_produto,
                               nome_produto,
                               descricao_produto,
                               codigo_produto,
                               tamanho_produto,
                               preco_compra,
                               preco_venda
                          from tb_produto
                         where id_produto = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idProduto);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharItemSacola(){
       
        
    }

    public function AlterarProduto($idProduto, $nome, $descricao, $codigo, $tamanho, $pcompra, $pvenda)
    {

        if (trim($nome) == '' || trim($descricao) == '' || trim($codigo) == '' || trim($tamanho) == '' || trim($pcompra) == '' || trim($pvenda) == '' || trim($idProduto) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_produto
                           set nome_produto = ?,
                               descricao_produto = ?,
                               codigo_produto = ?, 
                               tamanho_produto = ?,
                               preco_compra = ?,
                               preco_venda = ?
                         where id_produto = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $descricao);
        $sql->bindValue(3, $codigo);
        $sql->bindValue(4, $tamanho);
        $sql->bindValue(5, $pcompra);
        $sql->bindValue(6, $pvenda);
        $sql->bindValue(7, $idProduto);
        $sql->bindValue(8, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function  ExcluirProduto($idProduto)
    {

        if ($idProduto == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete from tb_produto
                              where id_produto = ?
                                and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idProduto);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -4;
        }
    }
}
