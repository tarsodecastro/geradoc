-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Set 30, 2014 as 10:36 PM
-- Versão do Servidor: 5.1.44
-- Versão do PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `geradoc_git`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `usuario_nome` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `data` datetime NOT NULL,
  `url` tinytext NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '10',
  `user_data` text COLLATE latin1_general_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `sexo` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'M',
  `cargo` int(11) NOT NULL DEFAULT '1',
  `setor` int(11) NOT NULL DEFAULT '1',
  `fone` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `mail1` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `mail2` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `assinatura` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `status` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `despacho_head`
--

CREATE TABLE `despacho_head` (
  `despacho_id` int(11) NOT NULL,
  `num_processo` varchar(100) NOT NULL,
  `interessado` varchar(100) NOT NULL,
  `de` varchar(100) NOT NULL,
  `para` varchar(200) NOT NULL,
  PRIMARY KEY (`despacho_id`),
  KEY `despacho_id_idx` (`despacho_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT '1',
  `setor` int(11) DEFAULT NULL,
  `cidade` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `data_criacao` date DEFAULT NULL,
  `destinatario` int(11) DEFAULT NULL,
  `assunto` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `referencia` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `redacao` text COLLATE latin1_general_ci,
  `remetente` int(11) DEFAULT NULL,
  `para` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `dono` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dono_cpf` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `cadeado` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S',
  `oculto` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `cancelado` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `carimbo` char(1) COLLATE latin1_general_ci DEFAULT 'N',
  `processo` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `interessado` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `objetivo` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `id_documento` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `texto` longtext COLLATE latin1_general_ci,
  PRIMARY KEY (`id_historico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orgao`
--

CREATE TABLE `orgao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `sigla` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `endereco` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `orgao` int(11) DEFAULT '1',
  `setorPai` int(11) DEFAULT '1',
  `sigla` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `endereco` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `artigo` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `dono` int(11) DEFAULT NULL,
  `funcionarios` text COLLATE latin1_general_ci,
  `restricao` varchar(1) COLLATE latin1_general_ci DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor_func_per`
--

CREATE TABLE `setor_func_per` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setor` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `abreviacao` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `inicio` int(11) DEFAULT NULL,
  `ano` int(4) DEFAULT NULL,
  `publicado` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `cabecalho` text COLLATE latin1_general_ci,
  `rodape` text COLLATE latin1_general_ci,
  `layout` text COLLATE latin1_general_ci,
  `referencia` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'S',
  `processo` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `interessado` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `para` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'S',
  `redacao` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `objetivo` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_ano`
--

CREATE TABLE `tipo_ano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `ano` int(4) NOT NULL,
  `inicio` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `sobrenome` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `senha` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `confsenha` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `setor` int(11) DEFAULT '1',
  `setores` text COLLATE latin1_general_ci,
  `nivel` int(11) DEFAULT '2',
  `email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `usuario` VALUES(1, '11111111111', 'Administrador', 'Administrador', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 1, NULL, 1, 'tarsodecastro@gmail.com');
