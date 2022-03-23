-- COMANDO INSERIR --
insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Lucas Claro', 'lucasclaro@outlook.com.br', 'pswd@2021', '2021-03-28')

insert into tb_produto
(nome_produto, descricao_produto, codigo_produto, tamanho_produto, preco_compra, preco_venda, id_usuario)
values
('Calça', 'Calça Masculina M', '66741-M', 'tamanho M', 45.50, 89.99, 1)

insert into tb_sacola
(data_entraga, data_retirada, hora_entrega, hora_retirada, endereco_entrega, endereco_retirada, obs_sacola, id_usuario)
values
('2021-04-08', '2021-04-08', '14:00', '14:30', 'Rua das orquideas', 'Rua das orquideas', null, 1)