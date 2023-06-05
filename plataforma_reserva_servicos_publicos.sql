-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Maio-2023 às 23:16
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `plataforma_reserva_servicos_publicos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `iddocumento` int(11) NOT NULL,
  `nome_documento` varchar(100) NOT NULL,
  `id_tipo_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idfuncionario` int(11) NOT NULL,
  `nome_funcionario` varchar(100) NOT NULL,
  `telefone_funcionario` varchar(45) NOT NULL,
  `email_funcionario` varchar(45) NOT NULL,
  `senha_funcionario` varchar(45) NOT NULL,
  `nivel` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `identificacao`
--

CREATE TABLE `identificacao` (
  `ididentificacao` int(11) NOT NULL,
  `nome_identificacao` varchar(200) NOT NULL,
  `tipo_dentificacao` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `NIF` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcoes`
--

CREATE TABLE `marcoes` (
  `idmarcao` int(11) NOT NULL,
  `id_solicitacao` int(11) NOT NULL,
  `data_aprovacao` varchar(45) NOT NULL,
  `hora_aprovacao` varchar(45) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `dia` varchar(45) NOT NULL,
  `mes` varchar(45) NOT NULL,
  `ano` varchar(45) NOT NULL,
  `feedback_marcao` longtext NOT NULL DEFAULT 'mensagem padrão'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipios`
--

CREATE TABLE `municipios` (
  `idmunicipio` int(11) NOT NULL,
  `nome_municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `idsolicitacao` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `data_solicitacao` varchar(100) NOT NULL,
  `hora_solicitacao` varchar(45) NOT NULL,
  `estado_solicitacao` enum('0','1','2') NOT NULL DEFAULT '0',
  `dia` varchar(45) NOT NULL,
  `mes` varchar(45) NOT NULL,
  `id_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `idtipo_servico` int(11) NOT NULL,
  `nome_tipo_documento` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_identificacao`
--

CREATE TABLE `tipo_identificacao` (
  `idtipo_identificacao` int(11) NOT NULL,
  `nome_tipo_identificacao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utentes`
--

CREATE TABLE `utentes` (
  `idutente` int(11) NOT NULL,
  `nome_utente` varchar(200) NOT NULL,
  `email_utente` varchar(200) NOT NULL,
  `telefone_utente` varchar(45) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `senha_utente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`iddocumento`),
  ADD KEY `documentos_tipo_idx` (`id_tipo_doc`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idfuncionario`);

--
-- Índices para tabela `identificacao`
--
ALTER TABLE `identificacao`
  ADD PRIMARY KEY (`ididentificacao`),
  ADD KEY `fk_identificacao_tipo_identificacao1_idx` (`tipo_dentificacao`),
  ADD KEY `fk_identificacao_municipios1_idx` (`id_municipio`);

--
-- Índices para tabela `marcoes`
--
ALTER TABLE `marcoes`
  ADD PRIMARY KEY (`idmarcao`),
  ADD KEY `fk_marcoes_solicitacoes1_idx` (`id_solicitacao`),
  ADD KEY `fk_marcoes_funcionarios1_idx` (`id_funcionario`);

--
-- Índices para tabela `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`idmunicipio`);

--
-- Índices para tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`idsolicitacao`),
  ADD KEY `fk_solicitacoes_utentes1_idx` (`id_utente`),
  ADD KEY `fk_solicitacoes_documentos1_idx` (`id_documento`);

--
-- Índices para tabela `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`idtipo_servico`);

--
-- Índices para tabela `tipo_identificacao`
--
ALTER TABLE `tipo_identificacao`
  ADD PRIMARY KEY (`idtipo_identificacao`);

--
-- Índices para tabela `utentes`
--
ALTER TABLE `utentes`
  ADD PRIMARY KEY (`idutente`),
  ADD KEY `fk_utentes_municipios1_idx` (`id_municipio`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `idfuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `identificacao`
--
ALTER TABLE `identificacao`
  MODIFY `ididentificacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marcoes`
--
ALTER TABLE `marcoes`
  MODIFY `idmarcao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `municipios`
--
ALTER TABLE `municipios`
  MODIFY `idmunicipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `idsolicitacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `idtipo_servico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_identificacao`
--
ALTER TABLE `tipo_identificacao`
  MODIFY `idtipo_identificacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `utentes`
--
ALTER TABLE `utentes`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_tipo` FOREIGN KEY (`id_tipo_doc`) REFERENCES `tipo_documento` (`idtipo_servico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `identificacao`
--
ALTER TABLE `identificacao`
  ADD CONSTRAINT `fk_identificacao_municipios1` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`idmunicipio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_identificacao_tipo_identificacao1` FOREIGN KEY (`tipo_dentificacao`) REFERENCES `tipo_identificacao` (`idtipo_identificacao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `marcoes`
--
ALTER TABLE `marcoes`
  ADD CONSTRAINT `fk_marcoes_funcionarios1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_marcoes_solicitacoes1` FOREIGN KEY (`id_solicitacao`) REFERENCES `solicitacoes` (`idsolicitacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `fk_solicitacoes_documentos1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`iddocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitacoes_utentes1` FOREIGN KEY (`id_utente`) REFERENCES `utentes` (`idutente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `utentes`
--
ALTER TABLE `utentes`
  ADD CONSTRAINT `fk_utentes_municipios1` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`idmunicipio`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
