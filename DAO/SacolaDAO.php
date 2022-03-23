<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';

class SacolaDAO extends Conexao
{

    public function FazerSacola($cliente, $dataentrega, $dataretirada, $horaentrega, $horaretirada, $endentrega, $endretirada, $obs)
    {

        if (trim($cliente) == '' || trim($dataentrega) == '' || trim($dataretirada) == '' || trim($horaentrega) == '' || trim($horaretirada) == '' || trim($endentrega) == '' || trim($endretirada) == '' || trim($obs) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'insert into tb_sacola
                        (data_entrega, data_retirada, hora_entrega, hora_retirada, endereco_entrega, endereco_retirada, obs_sacola, id_usuario, id_cliente, status_sacola)
                        values
                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $dataentrega);
        $sql->bindValue(2, $dataretirada);
        $sql->bindValue(3, $horaentrega);
        $sql->bindValue(4, $horaretirada);
        $sql->bindValue(5, $endentrega);
        $sql->bindValue(6, $endretirada);
        $sql->bindValue(7, $obs);
        $sql->bindValue(8, UtilDAO::CodigoLogado());
        $sql->bindValue(9, $cliente);
        $sql->bindValue(10, 1); //esse 1 sgnifica que está no status EM ANDAMENTO

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();

            return -1;
        }
    }

    public function AterarSacola($id_sacola, $dataentrega, $dataretirada, $horaentrega, $horaretirada, $endentrega, $endretirada, $obs, $situacao)
    {

        $conexao = parent::retornarConexao();

        $comando_sql = ' update tb_sacola 
                            set data_entrega = ?,
                                data_retirada = ?,
                                hora_entrega = ?,
                                hora_retirada = ?,
                                endereco_entrega =?,
                                endereco_retirada = ?,
                                obs_sacola = ?,
                                status_sacola = ?
                          where id_sacola = ?
                            and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $dataentrega);
        $sql->bindValue(2, $dataretirada);
        $sql->bindValue(3, $horaentrega);
        $sql->bindValue(4, $horaretirada);
        $sql->bindValue(5, $endentrega);
        $sql->bindValue(6, $endretirada);
        $sql->bindValue(7, $obs);
        $sql->bindValue(8, $situacao);

        $sql->bindValue(9, $id_sacola);
        $sql->bindValue(10, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirSacola($id_sacola)
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete from tb_item_sacola
                         where id_sacola = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_sacola);

        $conexao->beginTransaction();

        try {

            //Exclui os itens da sacola
            $sql->execute();

            $comando_sql = 'delete 
                            from tb_sacola
                            where id_sacola = ?
                            and id_usuario = ?';



            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $id_sacola);
            $sql->bindValue(2, UtilDAO::CodigoLogado());

            //Exclui a sacola
            $sql->execute();

            //Finaliza a transação
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            return -4;
        }
    }


    public function FiltrarSacola($situacao, $dtinicial, $dtfinal)
    {

        if (trim($dtinicial) == '' || trim($dtfinal) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = ' select id_sacola,
                                status_sacola,
                                date_format(data_entrega, "%d/%m/%Y") as data_entrega,
                                date_format(data_retirada, "%d/%m/%Y") as data_retirada,
                                hora_entrega,
                                hora_retirada,
                                endereco_entrega,
                                endereco_retirada,
                                obs_sacola,
                                nome_cliente
                           from tb_sacola inner join tb_cliente 
                             on tb_sacola.id_cliente = tb_cliente.id_cliente
                          where tb_sacola.id_usuario = ? and data_entrega between ? and ?
                          order by tb_sacola.id_sacola DESC limit 100';
        if ($situacao != 0) {
            $comando_sql = $comando_sql . ' and status_sacola = ?';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $dtinicial);
        $sql->bindValue(3, $dtfinal);

        if ($situacao != 0) {
            $sql->bindValue(4, $situacao);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }



    public function ExcluirItemSacola($id_produto, $id_sacola)
    {
        if ($id_produto == '' || $id_sacola == '') {
            return 0;
        }
        $conexao = parent::retornarConexao();

        $comando_sql = 'delete from tb_item_sacola
                              where id_produto = ?
                                and id_sacola = ?';


        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_produto);
        $sql->bindValue(2, $id_sacola);


        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -4;
        }
    }

    public function MostrarUltimosLancamentos()
    {

        $conexao = parent::retornarConexao();

        $comando_sql = ' select id_sacola,
                                date_format(data_entrega, "%d/%m/%Y") as data_entrega,
                                date_format(data_retirada, "%d/%m/%Y") as data_retirada,
                                hora_entrega,
                                hora_retirada,
                                endereco_entrega,
                                endereco_retirada,
                                obs_sacola,
                                nome_cliente,
                                status_sacola,
                                (select sum(qtd_item * valor_item) from tb_item_sacola as isac where isac.id_sacola = tb_sacola.id_sacola  ) as total_sacola
                           from tb_sacola
                          inner join tb_cliente
                             on tb_cliente.id_cliente = tb_sacola.id_cliente
                          where tb_sacola.id_usuario = ?
                          order by tb_sacola.id_sacola DESC limit 10';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    private function ValidarItemSacola($id_sacola, $id_produto)
    {
        $conexao = parent::retornarConexao();

        $comando_sql = ' select count(*) as contar
                       from tb_item_sacola
                      where id_sacola = ? and id_produto = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_sacola);
        $sql->bindValue(2, $id_produto);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $ret =  $sql->fetchAll();

        return $ret[0]['contar'];
    }

    public function DetalharSacolaAdd($id_sacola)
    {

        $conexao = parent::retornarConexao();

        $comando_sql = ' select tb_item_sacola.id_produto, 
                                tb_item_sacola.id_sacola,
                                tb_produto.nome_produto,
                                tb_produto.descricao_produto,
                                qtd_item,
                                valor_item,
                                obs_item    
                           from tb_item_sacola
                        inner join tb_produto 
                          on tb_produto.id_produto = tb_item_sacola.id_produto      
                          where id_sacola = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_sacola);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
    public function DetalharSacola($id_sacola)
    {

        $conexao = parent::retornarConexao();

        $comando_sql = ' select tb_sacola.id_sacola, 
                                tb_cliente.nome_cliente,
                                 data_entrega,
                                data_retirada,
                                hora_entrega,
                                hora_retirada,
                                endereco_entrega,
                                endereco_retirada,
                                status_sacola,
                                obs_sacola,
                                nome_cliente
                           from tb_sacola 
                           inner join tb_cliente
                           on tb_sacola.id_cliente = tb_cliente.id_cliente
                          where tb_sacola.id_sacola = ?
                            and tb_sacola.id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_sacola);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AdicinarItemSacola($id_produto, $id_sacola, $qtd, $valor, $obs)
    {

        if (trim($qtd) == '' || trim($valor) == '' || $id_produto == '' || $id_sacola == '') {
            return 0;
        }

        if ($this->ValidarItemSacola($id_sacola, $id_produto) == 0) {


            $conexao = parent::retornarConexao();

            $comando_sql = 'insert into tb_item_sacola
                        (id_produto, id_sacola, qtd_item, valor_item, obs_item)
                        values
                        (?, ?, ?, ?, ?)';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $id_produto);
            $sql->bindValue(2, $id_sacola);
            $sql->bindValue(3, $qtd);
            $sql->bindValue(4, $valor);
            $sql->bindValue(5, $obs);

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        } else {
            return -7;
        }
    }

    public function TotalFinalizada()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = ' select count(id_sacola) as total
                            from tb_sacola
                            where status_sacola = 2
                            and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();
    }

    public function TotalAndamento()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = ' select count(id_sacola) as total
                            from tb_sacola
                            where status_sacola = 1
                            and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();
    }
    public function TotalValorAndamento()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = ' select sum(qtd_item * valor_item) as valor_total
                            from tb_item_sacola 
                            inner join tb_sacola on tb_item_sacola.id_sacola = tb_sacola.id_sacola
                            where status_sacola = 1
                            and tb_sacola.id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();
    }
    public function TotalValorFinalizado()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = ' select sum(qtd_item * valor_item) as valor_total
                            from tb_item_sacola 
                            inner join tb_sacola on tb_item_sacola.id_sacola = tb_sacola.id_sacola
                            where status_sacola = 2
                            and tb_sacola.id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();
    }



    // public function AdicionarItemSacola($id_sacola, $id_produto, $qtd, $valor, $obs)
    // {



    //     $conexao = parent::retornarConexao();

    //     $comando_sql = ' insert into tb_item_sacola
    //                     (id_produto, id_sacola, qtd_item, valor_item, obs_item)
    //                     values
    //                     (?, ?, ?, ?, ?)';

    //     $sql = new PDOStatement();

    //     $sql = $conexao->prepare($comando_sql);

    //     $sql->bindValue(1, $id_sacola);
    //     $sql->bindValue(2, $id_produto);
    //     $sql->bindValue(3, $qtd);
    //     $sql->bindValue(4, $valor);
    //     $sql->bindValue(5, $obs);

    //     try {
    //         $sql->execute();
    //         return 1;
    //     } catch (Exception $ex) {
    //         echo $ex->getMessage();
    //         return -1;
    //     }
    // }
}
