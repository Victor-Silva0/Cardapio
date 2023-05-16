DROP DATABASE IF EXISTS CARDAPIO;
CREATE DATABASE CARDAPIO;
USE CARDAPIO;
CREATE TABLE ORIGEM_COMANDA (
idOrigem INT NOT NULL AUTO_INCREMENT,
descricaoOrigem VARCHAR(50),
PRIMARY KEY (idOrigem)
);
CREATE TABLE SITUACAO_COMANDA (
idSituacao int not null AUTO_INCREMENT,
descricao varchar(40),
primary key (idSituacao)
);
CREATE TABLE COMANDA (
idComanda INT NOT NULL AUTO_INCREMENT,
nomeClienteComanda VARCHAR(50),
idOrigem INT NOT NULL,
idSituacao int not null,
dataComanda datetime NOT NULL DEFAULT current_timestamp(),
PRIMARY KEY (idComanda),
foreign key (idOrigem) references ORIGEM_COMANDA (idOrigem),
foreign key (idSituacao) references SITUACAO_COMANDA (idSituacao)
);
CREATE TABLE TIPO_OPCOES_CARDAPIO (
idTipoOpcoesCardapio INT NOT NULL AUTO_INCREMENT,
descricao VARCHAR(50),
PRIMARY KEY (idTipoOpcoesCardapio)
);
CREATE TABLE OPCOES_CARDAPIO (
idOpcaoCardapio INT NOT NULL AUTO_INCREMENT,
nomeOpcaoCardapio VARCHAR(50),
idTipoOpcoesCardapio int not null,
descricao varchar(50),
preco double,
PRIMARY KEY (idOpcaoCardapio),
foreign key (idTipoOpcoesCardapio) references TIPO_OPCOES_CARDAPIO
(idTipoOpcoesCardapio)
);
CREATE TABLE ITENS_COMANDA (
idItemComanda int not null AUTO_INCREMENT,
idComanda int not null,
idOpcaoCardapio int not null,
quantidade int not null,
obs varchar (50),
primary key (idItemComanda),
foreign key (idComanda) references COMANDA (idComanda),
foreign key (idOpcaoCardapio) references OPCOES_CARDAPIO (idOpcaoCardapio)
);
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Mesa 01');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Mesa 02');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Mesa 03');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Mesa 04');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Mesa 05');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Mesa 06');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Balcão');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Telefone');
INSERT INTO ORIGEM_COMANDA (descricaoOrigem) VALUES ('Whatsapp');
INSERT INTO SITUACAO_COMANDA (descricao) VALUES ('Aberta');
INSERT INTO SITUACAO_COMANDA (descricao) VALUES ('Fechada');
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Rafael', 1, 1);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Vitor', 2, 1);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Giovana', 4, 2);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Anderson', 5, 2);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Pedro', 3, 1);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Marilda', 6, 1);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Cecilia', 7, 1);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('Lucia', 8, 2);
INSERT INTO COMANDA (nomeClienteComanda, idOrigem, idSituacao) values ('João', 8, 2);
INSERT INTO TIPO_OPCOES_CARDAPIO (descricao) values ('Refrigerante');
INSERT INTO TIPO_OPCOES_CARDAPIO (descricao) values ('Cerveja');
INSERT INTO TIPO_OPCOES_CARDAPIO (descricao) values ('Chop');
INSERT INTO TIPO_OPCOES_CARDAPIO (descricao) values ('Suco');
INSERT INTO TIPO_OPCOES_CARDAPIO (descricao) values ('Sobremesa');
INSERT INTO TIPO_OPCOES_CARDAPIO (descricao) values ('Lanche');
INSERT INTO OPCOES_CARDAPIO (nomeOpcaoCardapio, idTipoOpcoesCardapio, descricao,
preco) values ('Coca-Cola', 1, '1 Litro', 9.50);
INSERT INTO OPCOES_CARDAPIO (nomeOpcaoCardapio, idTipoOpcoesCardapio, descricao,
preco) values ('X-Burguer', 6, 'Pão, Hamburguer, Queijo', 16.80);
INSERT INTO OPCOES_CARDAPIO (nomeOpcaoCardapio, idTipoOpcoesCardapio, descricao,
preco) values ('X-Salada', 6, 'Pão, Hamburguer, Alface, Tomate', 15.50);
INSERT INTO OPCOES_CARDAPIO (nomeOpcaoCardapio, idTipoOpcoesCardapio, descricao,
preco) values ('X-Frango', 6, 'Pão, Frango', 17.80);
INSERT INTO OPCOES_CARDAPIO (nomeOpcaoCardapio, idTipoOpcoesCardapio, descricao,
preco) values ('X-Calabresa', 6, 'Pão, Calabresa, Cebola, Alface', 16.80);
INSERT INTO OPCOES_CARDAPIO (nomeOpcaoCardapio, idTipoOpcoesCardapio, descricao,
preco) values ('Funada', 1, '2 Litros', 5.50);
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (1, 1,
2, 'Colocar gelo no copo');
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (1, 2,
1, 'Partir o lanche ao meio');
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (1, 4,
1, '');
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (2, 6,
1, '');
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (2, 2,
1, '');
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (6, 5,
1, 'Não colocar cebola');
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (7, 5,
1, '');
INSERT INTO ITENS_COMANDA (idComanda, idOpcaoCardapio, quantidade, obs) VALUES (8, 3,
3, '');
