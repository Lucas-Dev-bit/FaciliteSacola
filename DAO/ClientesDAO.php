<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ClientesDAO extends Conexao
{

    public function CadastrarNovoCliente($nome, $rua, $bairro, $tel, $whats, $datanascimento, $sexo)
    {

        if (trim($nome) == '' || trim($rua) == '' || trim($bairro) == '' || trim($tel) == '' || 
        trim($whats) == '' || trim($datanascimento) == '' || $sexo == '') 
            return 0;
        
        // 1 passo: criar uma variavel que receberá o OBJ de conexao
        $conexao = parent::retornarConexao();

        //2 passo: criar uma variavel que receberá o texto do comando SQL que deverá ser executado no BD
        $comando_sql = 'insert into tb_cliente
                        (nome_cliente, rua_cliente, bairro_cliente, tel_cliente, whats_cliente, nascimento_cliente, sexo_cliente, id_usuario)
                        values
                        (?, ?, ?, ?, ?, ?, ?, ?);';

        //3 passo: Criar um OBJ que será configurado e levado no BD para ser executado
        $sql = new PDOStatement();

        //4 passo: Colocar dentro do OBJ $SQL a conexao preparada para executar o comando SQL
        $sql = $conexao->prepare($comando_sql);

        //5 passo: Verificar se no comando_sql eu tenho ? para ser configurado. Se tiver, configurar os bindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $rua);
        $sql->bindValue(3, $bairro);
        $sql->bindValue(4, $tel);
        $sql->bindValue(5, $whats);
        $sql->bindValue(6, $datanascimento);
        $sql->bindValue(7, $sexo);
        $sql->bindValue(8, UtilDAO::CodigoLogado());

        //Bloco de tratamento de ERRO
        try {
            //6 passo: executar no BD
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarCliente()
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'select nome_cliente, 
                               rua_cliente, 
                               bairro_cliente, 
                               tel_cliente, 
                               whats_cliente, 
                               nascimento_cliente, 
                               sexo_cliente,
                               id_cliente
                          from tb_cliente
                         where id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharCliente($idCliente)
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_cliente,
                               nome_cliente, 
                               rua_cliente, 
                               bairro_cliente, 
                               tel_cliente, 
                               whats_cliente, 
                               nascimento_cliente, 
                               sexo_cliente
                          from tb_cliente
                         where id_cliente = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idCliente);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarCliente($idCliente, $nome, $rua, $bairro, $tel, $whats, $datanascimento, $sexo)
    {

        if (trim($nome) == '' || trim($rua) == '' || trim($bairro) == '' || trim($tel) == '' || trim($whats) == '' || trim($datanascimento) == '' || trim($sexo) == '' || trim($idCliente) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_cliente
                            set nome_cliente = ?, 
                                rua_cliente = ? ,
                                bairro_cliente = ? ,
                                tel_cliente = ? ,
                                whats_cliente = ? ,
                                nascimento_cliente = ?,
                                sexo_cliente = ?
                          where id_cliente = ?
                            and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $rua);
        $sql->bindValue(3, $bairro);
        $sql->bindValue(4, $tel);
        $sql->bindValue(5, $whats);
        $sql->bindValue(6, $datanascimento);
        $sql->bindValue(7, $sexo);
        $sql->bindValue(8, $idCliente);
        $sql->bindValue(9, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirCliente($idCliente)
    {

        if ($idCliente == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete from tb_cliente
                              where id_cliente = ?
                                and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idCliente);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -4;
        }
    }
}
