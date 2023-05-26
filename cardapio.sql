-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/05/2023 às 02:57
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cardapio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comanda`
--

CREATE TABLE `comanda` (
  `idComanda` int(11) NOT NULL,
  `nomeClienteComanda` varchar(50) DEFAULT NULL,
  `idOrigem` int(11) NOT NULL,
  `idSituacao` int(11) NOT NULL,
  `dataComanda` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comanda`
--

INSERT INTO `comanda` (`idComanda`, `nomeClienteComanda`, `idOrigem`, `idSituacao`, `dataComanda`) VALUES
(1, 'Rafael', 1, 1, '2023-05-13 01:07:22'),
(2, 'Vitor', 2, 1, '2023-05-13 01:07:22'),
(3, 'Giovana', 4, 2, '2023-05-13 01:07:22'),
(4, 'Anderson', 5, 2, '2023-05-13 01:07:22'),
(5, 'Pedro', 3, 1, '2023-05-13 01:07:22'),
(6, 'Marilda', 6, 1, '2023-05-13 01:07:22'),
(7, 'Cecilia', 7, 1, '2023-05-13 01:07:22'),
(8, 'Lucia', 8, 2, '2023-05-13 01:07:22'),
(9, 'João', 8, 2, '2023-05-13 01:07:22'),
(14, 'jose', 1, 0, '2023-05-16 22:44:23'),
(15, 'Debora', 4, 0, '2023-05-16 22:44:59'),
(16, 'sss', 1, 0, '2023-05-16 22:46:21'),
(17, 'Rute', 6, 1, '2023-05-16 22:48:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_comanda`
--

CREATE TABLE `itens_comanda` (
  `idItemComanda` int(11) NOT NULL,
  `idComanda` int(11) NOT NULL,
  `idOpcaoCardapio` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `obs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_comanda`
--

INSERT INTO `itens_comanda` (`idItemComanda`, `idComanda`, `idOpcaoCardapio`, `quantidade`, `obs`) VALUES
(1, 1, 1, 2, 'Colocar gelo no copo'),
(2, 1, 2, 1, 'Partir o lanche ao meio'),
(3, 1, 4, 1, ''),
(4, 2, 6, 1, ''),
(5, 2, 2, 1, ''),
(6, 6, 5, 1, 'Não colocar cebola'),
(7, 7, 5, 1, ''),
(8, 8, 3, 3, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcoes_cardapio`
--

CREATE TABLE `opcoes_cardapio` (
  `idOpcaoCardapio` int(11) NOT NULL,
  `nomeOpcaoCardapio` varchar(50) DEFAULT NULL,
  `idTipoOpcoesCardapio` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `preco` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `opcoes_cardapio`
--

INSERT INTO `opcoes_cardapio` (`idOpcaoCardapio`, `nomeOpcaoCardapio`, `idTipoOpcoesCardapio`, `descricao`, `preco`) VALUES
(1, 'Coca-Cola', 1, '1 Litro', 9.5),
(2, 'X-Burguer', 6, 'Pão, Hamburguer, Queijo', 16.8),
(3, 'X-Salada', 6, 'Pão, Hamburguer, Alface, Tomate', 15.5),
(4, 'X-Frango', 6, 'Pão, Frango', 17.8),
(5, 'X-Calabresa', 6, 'Pão, Calabresa, Cebola, Alface', 16.8),
(6, 'Funada', 1, '2 Litros', 5.5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `origem_comanda`
--

CREATE TABLE `origem_comanda` (
  `idOrigem` int(11) NOT NULL,
  `descricaoOrigem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `origem_comanda`
--

INSERT INTO `origem_comanda` (`idOrigem`, `descricaoOrigem`) VALUES
(1, 'Mesa 01'),
(2, 'Mesa 02'),
(3, 'Mesa 03'),
(4, 'Mesa 04'),
(5, 'Mesa 05'),
(6, 'Mesa 06'),
(7, 'Balcão'),
(8, 'Telefone'),
(9, 'Whatsapp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `situacao_comanda`
--

CREATE TABLE `situacao_comanda` (
  `idSituacao` int(11) NOT NULL,
  `descricao` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `situacao_comanda`
--

INSERT INTO `situacao_comanda` (`idSituacao`, `descricao`) VALUES
(1, 'Aberta'),
(2, 'Fechada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_opcoes_cardapio`
--

CREATE TABLE `tipo_opcoes_cardapio` (
  `idTipoOpcoesCardapio` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_opcoes_cardapio`
--

INSERT INTO `tipo_opcoes_cardapio` (`idTipoOpcoesCardapio`, `descricao`) VALUES
(1, 'Refrigerante'),
(2, 'Cerveja'),
(3, 'Chop'),
(4, 'Suco'),
(5, 'Sobremesa'),
(6, 'Lanche');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`idComanda`),
  ADD KEY `idOrigem` (`idOrigem`),
  ADD KEY `idSituacao` (`idSituacao`);

--
-- Índices de tabela `itens_comanda`
--
ALTER TABLE `itens_comanda`
  ADD PRIMARY KEY (`idItemComanda`),
  ADD KEY `idComanda` (`idComanda`),
  ADD KEY `idOpcaoCardapio` (`idOpcaoCardapio`);

--
-- Índices de tabela `opcoes_cardapio`
--
ALTER TABLE `opcoes_cardapio`
  ADD PRIMARY KEY (`idOpcaoCardapio`),
  ADD KEY `idTipoOpcoesCardapio` (`idTipoOpcoesCardapio`);

--
-- Índices de tabela `origem_comanda`
--
ALTER TABLE `origem_comanda`
  ADD PRIMARY KEY (`idOrigem`);

--
-- Índices de tabela `situacao_comanda`
--
ALTER TABLE `situacao_comanda`
  ADD PRIMARY KEY (`idSituacao`);

--
-- Índices de tabela `tipo_opcoes_cardapio`
--
ALTER TABLE `tipo_opcoes_cardapio`
  ADD PRIMARY KEY (`idTipoOpcoesCardapio`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comanda`
--
ALTER TABLE `comanda`
  MODIFY `idComanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `itens_comanda`
--
ALTER TABLE `itens_comanda`
  MODIFY `idItemComanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `opcoes_cardapio`
--
ALTER TABLE `opcoes_cardapio`
  MODIFY `idOpcaoCardapio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `origem_comanda`
--
ALTER TABLE `origem_comanda`
  MODIFY `idOrigem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `situacao_comanda`
--
ALTER TABLE `situacao_comanda`
  MODIFY `idSituacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo_opcoes_cardapio`
--
ALTER TABLE `tipo_opcoes_cardapio`
  MODIFY `idTipoOpcoesCardapio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_comanda`
--
ALTER TABLE `itens_comanda`
  ADD CONSTRAINT `itens_comanda_ibfk_1` FOREIGN KEY (`idComanda`) REFERENCES `comanda` (`idComanda`),
  ADD CONSTRAINT `itens_comanda_ibfk_2` FOREIGN KEY (`idOpcaoCardapio`) REFERENCES `opcoes_cardapio` (`idOpcaoCardapio`);

--
-- Restrições para tabelas `opcoes_cardapio`
--
ALTER TABLE `opcoes_cardapio`
  ADD CONSTRAINT `opcoes_cardapio_ibfk_1` FOREIGN KEY (`idTipoOpcoesCardapio`) REFERENCES `tipo_opcoes_cardapio` (`idTipoOpcoesCardapio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
