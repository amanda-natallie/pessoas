-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Mar-2021 às 00:14
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pessoas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pessoas`
--

CREATE TABLE `tbl_pessoas` (
  `p_id` int(11) NOT NULL,
  `p_nome` varchar(500) NOT NULL,
  `p_endereco` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_pessoas`
--

INSERT INTO `tbl_pessoas` (`p_id`, `p_nome`, `p_endereco`) VALUES
(1, 'Suellen Marques', 'R. Irmã Joséfina da Veiga, 67 - Loja 1 - Praia do Siqueira, Cabo Frio - RJ, 28911-120'),
(2, 'Amanda Natallie', 'R. Sambeatiba, 261 - Cachoeirinha, Belo Horizonte - MG, 31150-220'),
(4, 'Leonardo Tomazelli', 'R. São Paulo, 656 -asddasd Centro, Belo Horizonte - MG, 30170-130'),
(5, 'Talissa de Andrade', 'Av. Olegário Maciel, 405 - Centro, Belo Horizonte - MG, 30180-110'),
(6, 'Eros Mariano', 'R. Curitiba, 1001 - Centro, Belo Horizonte - MG, 30170-121');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_telefones`
--

CREATE TABLE `tbl_telefones` (
  `t_id` int(11) NOT NULL,
  `t_id_pessoa` int(255) NOT NULL,
  `t_numero` int(10) NOT NULL,
  `t_ddd` int(3) NOT NULL,
  `t_tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_telefones`
--

INSERT INTO `tbl_telefones` (`t_id`, `t_id_pessoa`, `t_numero`, `t_ddd`, `t_tipo`) VALUES
(1, 1, 992704989, 11, 2),
(4, 2, 912341234, 11, 2),
(5, 2, 956569898, 12, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbl_pessoas`
--
ALTER TABLE `tbl_pessoas`
  ADD PRIMARY KEY (`p_id`);

--
-- Índices para tabela `tbl_telefones`
--
ALTER TABLE `tbl_telefones`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `t_id_pessoa` (`t_id_pessoa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_pessoas`
--
ALTER TABLE `tbl_pessoas`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_telefones`
--
ALTER TABLE `tbl_telefones`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbl_telefones`
--
ALTER TABLE `tbl_telefones`
  ADD CONSTRAINT `fk_id_pessoa` FOREIGN KEY (`t_id_pessoa`) REFERENCES `tbl_pessoas` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
