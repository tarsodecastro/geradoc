-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2017 at 10:38 AM
-- Server version: 5.5.52-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geradoc_install`
--

-- --------------------------------------------------------

--
-- Table structure for table `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `usuario_nome` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `data` datetime NOT NULL,
  `url` tinytext NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`id`, `nome`) VALUES
(1, 'DIRETOR'),
(2, 'COMANDANTE'),
(3, 'SECRETÁRIO'),
(4, 'COORDENADOR'),
(5, 'ASSESSOR');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE latin1_general_ci DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '10',
  `user_data` text COLLATE latin1_general_ci,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_documento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `texto` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


--
-- Estrutura para tabela `rel_comentario_usuario`
--

CREATE TABLE `rel_comentario_usuario` (
  `id_rel` int(11) NOT NULL AUTO_INCREMENT,
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
   PRIMARY KEY (`id_rel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contato`
--

CREATE TABLE IF NOT EXISTS `contato` (
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
  `assinatura` text COLLATE latin1_general_ci NOT NULL,
  `status` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contato`
--

INSERT INTO `contato` (`id`, `nome`, `sexo`, `cargo`, `setor`, `fone`, `celular`, `fax`, `mail1`, `mail2`, `assinatura`, `status`) VALUES
(1, 'RAIMUNDO SILVA', 'M', 1, 2, '(85)3100.0000', '', '', 'RAIMUNDO.SILVA@TESTE.COM.BR', '', '<strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL', 'A'),
(2, 'FRANCISCO SOUSA', 'M', 4, 3, '(85)0000.0000', '', '', 'FRANCISCO.SOUSA@TESTE.COM.BR', '', 'FRANCISCO SOUSA<br />COORDENADOR FINANCEIRO', 'A'),
(3, 'ANA MARIA', 'M', 5, 4, '(85)0000.0000', '', '', 'ANA.MARIA@TESTE.COM.BR', '', 'ANA MARIA<br />ASSEOSSORA JUR&Iacute;DICA', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `despacho_head`
--

CREATE TABLE IF NOT EXISTS `despacho_head` (
  `despacho_id` int(11) NOT NULL,
  `num_processo` varchar(100) NOT NULL,
  `interessado` varchar(100) NOT NULL,
  `de` varchar(100) NOT NULL,
  `para` varchar(200) NOT NULL,
  PRIMARY KEY (`despacho_id`),
  KEY `despacho_id_idx` (`despacho_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `despacho_head`
--

INSERT INTO `despacho_head` (`despacho_id`, `num_processo`, `interessado`, `de`, `para`) VALUES
(2, '0', '0', '0', 'ASSJUR');

-- --------------------------------------------------------

--
-- Table structure for table `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT '1',
  `setor` int(11) DEFAULT NULL,
  `cidade` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `data_criacao` date DEFAULT NULL,
  `destinatario` int(11) DEFAULT NULL,
  `assunto` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `anexos` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `referencia` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `redacao` longtext COLLATE latin1_general_ci,
  `remetente` int(11) DEFAULT NULL,
  `para` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `dono` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dono_cpf` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `cadeado` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S',
  `oculto` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `cancelado` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `carimbo` char(1) COLLATE latin1_general_ci DEFAULT 'N',
  `carimbo_confidencial` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `carimbo_urgente` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `carimbo_via` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `objetivo` text COLLATE latin1_general_ci,
  `documentacao` text COLLATE latin1_general_ci,
  `conclusao` text COLLATE latin1_general_ci,
  `processo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `interessado` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `analise` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `documento`
--

INSERT INTO `documento` (`id`, `tipo`, `numero`, `setor`, `cidade`, `data`, `data_criacao`, `destinatario`, `assunto`, `anexos`, `referencia`, `redacao`, `remetente`, `para`, `dono`, `dono_cpf`, `cadeado`, `oculto`, `cancelado`, `carimbo`, `carimbo_confidencial`, `carimbo_urgente`, `carimbo_via`, `objetivo`, `documentacao`, `conclusao`, `processo`, `interessado`, `analise`) VALUES
(1, 2, 1, 2, NULL, '2016-09-14', '2016-09-14', NULL, 'Exemplo de Comunicação Interna', NULL, 'Outro documento qualquer', '<p>Prezado Sr.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nec sapien arcu. Aliquam erat volutpat. Nullam mi justo, rutrum vitae aliquam a, tempus faucibus purus.</p>\n\n<p>Nullam molestie purus ex, id commodo nisi aliquet vitae. Nam lacinia est quis libero euismod varius. Praesent ullamcorper mi et porta tempus.</p>\n\n<p>Atenciosamente,</p>\n\n<p>&nbsp;</p>', 1, 'Ao Sr.<br />\n<strong>Francisco Sousa</strong><br />\nCoordenador Financeiro<br />\n&nbsp;', 'ADMINISTRADOR ', '11111111111', 'S', 'N', 'N', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, 1, 2, NULL, '2016-09-14', '2016-09-14', NULL, 'Exemplo de Despacho', NULL, '0', '<p>&nbsp;</p>\n\n<p>1. Recebi hoje;</p>\n\n<p>2. Trata o presesente processo da solicita&ccedil;&atilde; do Sr. Jos&eacute; da Silva;</p>\n\n<p>3. Encaminhe-se &agrave; Assessoria Jur&iacute;dica para elabora&ccedil;&atilde;o de parecer.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>', 1, 'ASSJUR', 'REDATOR ', '22222222222', 'S', 'N', 'N', '0', NULL, 'S', NULL, '0', '0', '0', '01234567/2013', 'José da Silva', '0'),
(3, 1, 1, 2, NULL, '2016-09-14', '2016-09-14', NULL, 'Exemplo de Ofício', NULL, 'Despacho Nº 1 - DIR/ORG', '<p>Prezado Jos&eacute; da Silva,</p>\n\n<p>Etiam hendrerit, nibh non tincidunt malesuada, elit tortor luctus tellus, sed tempus tellus nibh sit amet nulla. Vestibulum quis velit molestie, sodales mi id, elementum turpis.</p>\n\n<p>Donec ullamcorper ornare urna, quis efficitur ipsum vestibulum vel. Nullam et eros vitae lectus cursus placerat sed vel odio. Suspendisse fringilla ac tellus vitae ultrices. Integer commodo nisi non velit egestas mattis. Aliquam erat volutpat.</p>\n\n<p>Atenciosamente,</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>', 1, 'Ao Sr.<br />\nJos&eacute; da Silva', 'REDATOR ', '22222222222', 'S', 'N', 'N', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `historico`
--

CREATE TABLE IF NOT EXISTS `historico` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `id_documento` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `texto` longtext COLLATE latin1_general_ci,
  PRIMARY KEY (`id_historico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `historico`
--

INSERT INTO `historico` (`id_historico`, `id_documento`, `data`, `texto`) VALUES
(1, 1, '2016-09-14 09:17:33', '<div>Comunica&ccedil;&atilde;o Interna N&ordm; <strong>1/2016 - DIR/ORG</strong></div>\n<div style="text-align: right;">Fortaleza, 14 de setembro de 2016.</div>\n<div>Ao Sr.<br />\n<strong>Francisco Sousa</strong><br />\nCoordenador Financeiro<br />\n&nbsp;</div>\n<div><strong>Assunto:</strong> Exemplo de Comunicação Interna</div>\n<div>Outro documento qualquer</div>\n<div></div>\n<div style="text-align: justify;"><br /><p>Prezado Sr.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nec sapien arcu. Aliquam erat volutpat. Nullam mi justo, rutrum vitae aliquam a, tempus faucibus purus.</p>\n\n<p>Nullam molestie purus ex, id commodo nisi aliquet vitae. Nam lacinia est quis libero euismod varius. Praesent ullamcorper mi et porta tempus.</p>\n\n<p>Atenciosamente,</p>\n\n<p>&nbsp;</p></div>\n<div style="text-align: center;"><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>'),
(2, 2, '2016-09-14 09:20:48', '<table style="border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td align="center"><strong>Despacho N&ordm; 1/2016 - DIR/ORG</strong></td>\n</tr>\n</tbody>\n</table>\n<table style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td width="50%"><strong> N&ordm;. do processo:</strong> 01234567/2013</td>\n<td><strong>De:</strong> DIR/ORG</td>\n</tr>\n<tr>\n<td><strong>Interessado:</strong> José da Silva</td>\n<td><strong>Para:</strong> ASSJUR</td>\n</tr>\n<tr>\n<td><strong>Assunto:</strong> Exemplo de Despacho</td>\n<td><strong>Data:</strong> 14 de setembro de 2016</td>\n</tr>\n<tr>\n<td colspan="2"></td>\n</tr>\n</tbody>\n</table>\n<div style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; height: 600px; width: 100%; padding-left: 10px; padding-right: 10px; text-align: justify; line-height: 140%; display: table;"><p>1. Recebi hoje;</p>\n\n<p>2. Trata o presesente processo da solicita&ccedil;&atilde; do Sr. Jos&eacute; da Silva;</p>\n\n<p>3. Encaminhe-se &agrave; Assessoria Jur&iacute;dica para elabora&ccedil;&atilde;o de parecer.</p>\n\n<p>&nbsp;</p>\n<div style="margin-top: 37px; text-align: center;"><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>\n</div>'),
(3, 2, '2016-09-14 09:21:01', '<table style="border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td align="center"><strong>Despacho N&ordm; 1/2016 - DIR/ORG</strong></td>\n</tr>\n</tbody>\n</table>\n<table style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td width="50%"><strong> N&ordm;. do processo:</strong> 01234567/2013</td>\n<td><strong>De:</strong> DIR/ORG</td>\n</tr>\n<tr>\n<td><strong>Interessado:</strong> José da Silva</td>\n<td><strong>Para:</strong> ASSJUR</td>\n</tr>\n<tr>\n<td><strong>Assunto:</strong> Exemplo de Despacho</td>\n<td><strong>Data:</strong> 14 de setembro de 2016</td>\n</tr>\n<tr>\n<td colspan="2"></td>\n</tr>\n</tbody>\n</table>\n<div style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; height: 600px; width: 100%; padding-left: 10px; padding-right: 10px; text-align: justify; line-height: 140%; display: table;"><p>&nbsp;</p>\n\n<p>1. Recebi hoje;</p>\n\n<p>2. Trata o presesente processo da solicita&ccedil;&atilde; do Sr. Jos&eacute; da Silva;</p>\n\n<p>3. Encaminhe-se &agrave; Assessoria Jur&iacute;dica para elabora&ccedil;&atilde;o de parecer.</p>\n\n<p>&nbsp;</p>\n<div style="margin-top: 37px; text-align: center;"><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>\n</div>'),
(4, 2, '2016-09-14 09:21:16', '<table style="border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td align="center"><strong>Despacho N&ordm; 1/2016 - DIR/ORG</strong></td>\n</tr>\n</tbody>\n</table>\n<table style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td width="50%"><strong> N&ordm;. do processo:</strong> 01234567/2013</td>\n<td><strong>De:</strong> DIR/ORG</td>\n</tr>\n<tr>\n<td><strong>Interessado:</strong> José da Silva</td>\n<td><strong>Para:</strong> ASSJUR</td>\n</tr>\n<tr>\n<td><strong>Assunto:</strong> Exemplo de Despacho</td>\n<td><strong>Data:</strong> 14 de setembro de 2016</td>\n</tr>\n<tr>\n<td colspan="2"></td>\n</tr>\n</tbody>\n</table>\n<div style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; height: 600px; width: 100%; padding-left: 10px; padding-right: 10px; text-align: justify; line-height: 140%; display: table;"><p>&nbsp;</p>\n\n<p>1. Recebi hoje;</p>\n\n<p>2. Trata o presesente processo da solicita&ccedil;&atilde; do Sr. Jos&eacute; da Silva;</p>\n\n<p>3. Encaminhe-se &agrave; Assessoria Jur&iacute;dica para elabora&ccedil;&atilde;o de parecer.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n<div style="margin-top: 37px; text-align: center;"><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>\n</div>'),
(5, 3, '2016-09-14 09:23:55', '<div>Of&iacute;cio N&ordm; <strong>1/2016-DIR/ORG</strong></div>\n<div style="text-align: right;">Fortaleza, 14 de setembro de 2016.</div>\n<div>Ao Sr.<br />\nJos&eacute; da Silva</div>\n<div><strong>Assunto:</strong> Solicitação</div>\n<div><strong>Refer&ecirc;ncia:</strong> Despacho Nº 1 - DIR/ORG</div>\n<div style="text-align: justify;"><br /><p>Prezado senhor,</p>\n\n<p>Etiam hendrerit, nibh non tincidunt malesuada, elit tortor luctus tellus, sed tempus tellus nibh sit amet nulla. Vestibulum quis velit molestie, sodales mi id, elementum turpis.</p>\n\n<p>Donec ullamcorper ornare urna, quis efficitur ipsum vestibulum vel. Nullam et eros vitae lectus cursus placerat sed vel odio. Suspendisse fringilla ac tellus vitae ultrices. Integer commodo nisi non velit egestas mattis. Aliquam erat volutpat.</p>\n\n<p>Atenciosamente,</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p></div>\n<div style="text-align: center;"><br /><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>'),
(6, 3, '2016-09-14 09:24:12', '<div>Of&iacute;cio N&ordm; <strong>1/2016-DIR/ORG</strong></div>\n<div style="text-align: right;">Fortaleza, 14 de setembro de 2016.</div>\n<div>Ao Sr.<br />\nJos&eacute; da Silva</div>\n<div><strong>Assunto:</strong> Solicitação</div>\n<div><strong>Refer&ecirc;ncia:</strong> Despacho Nº 1 - DIR/ORG</div>\n<div style="text-align: justify;"><br /><p>Prezado senhor,</p>\n\n<p>Etiam hendrerit, nibh non tincidunt malesuada, elit tortor luctus tellus, sed tempus tellus nibh sit amet nulla. Vestibulum quis velit molestie, sodales mi id, elementum turpis.</p>\n\n<p>Donec ullamcorper ornare urna, quis efficitur ipsum vestibulum vel. Nullam et eros vitae lectus cursus placerat sed vel odio. Suspendisse fringilla ac tellus vitae ultrices. Integer commodo nisi non velit egestas mattis. Aliquam erat volutpat.</p>\n\n<p>Atenciosamente,</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p></div>\n<div style="text-align: center;"><br /><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>'),
(7, 3, '2016-09-14 09:24:32', '<div>Of&iacute;cio N&ordm; <strong>1/2016-DIR/ORG</strong></div>\n<div style="text-align: right;">Fortaleza, 14 de setembro de 2016.</div>\n<div>Ao Sr.<br />\nJos&eacute; da Silva</div>\n<div><strong>Assunto:</strong> Exemplo de Ofício</div>\n<div><strong>Refer&ecirc;ncia:</strong> Despacho Nº 1 - DIR/ORG</div>\n<div style="text-align: justify;"><br /><p>Prezado senhor,</p>\n\n<p>Etiam hendrerit, nibh non tincidunt malesuada, elit tortor luctus tellus, sed tempus tellus nibh sit amet nulla. Vestibulum quis velit molestie, sodales mi id, elementum turpis.</p>\n\n<p>Donec ullamcorper ornare urna, quis efficitur ipsum vestibulum vel. Nullam et eros vitae lectus cursus placerat sed vel odio. Suspendisse fringilla ac tellus vitae ultrices. Integer commodo nisi non velit egestas mattis. Aliquam erat volutpat.</p>\n\n<p>Atenciosamente,</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p></div>\n<div style="text-align: center;"><br /><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>'),
(8, 3, '2016-09-14 09:24:51', '<div>Of&iacute;cio N&ordm; <strong>1/2016-DIR/ORG</strong></div>\n<div style="text-align: right;">Fortaleza, 14 de setembro de 2016.</div>\n<div>Ao Sr.<br />\nJos&eacute; da Silva</div>\n<div><strong>Assunto:</strong> Exemplo de Ofício</div>\n<div><strong>Refer&ecirc;ncia:</strong> Despacho Nº 1 - DIR/ORG</div>\n<div style="text-align: justify;"><br /><p>Prezado Jos&eacute; da Silva,</p>\n\n<p>Etiam hendrerit, nibh non tincidunt malesuada, elit tortor luctus tellus, sed tempus tellus nibh sit amet nulla. Vestibulum quis velit molestie, sodales mi id, elementum turpis.</p>\n\n<p>Donec ullamcorper ornare urna, quis efficitur ipsum vestibulum vel. Nullam et eros vitae lectus cursus placerat sed vel odio. Suspendisse fringilla ac tellus vitae ultrices. Integer commodo nisi non velit egestas mattis. Aliquam erat volutpat.</p>\n\n<p>Atenciosamente,</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p></div>\n<div style="text-align: center;"><br /><div style="line-height: 125%;"><strong>RAIMUNDO SILVA</strong><br />DIRETOR GERAL</div></div>');

-- --------------------------------------------------------

--
-- Table structure for table `orgao`
--

CREATE TABLE IF NOT EXISTS `orgao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `sigla` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `endereco` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orgao`
--

INSERT INTO `orgao` (`id`, `nome`, `sigla`, `endereco`) VALUES
(1, 'ÓRGÃO', 'ORG', '.');

-- --------------------------------------------------------

--
-- Table structure for table `repositorio`
--

CREATE TABLE IF NOT EXISTS `repositorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_setor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pasta` int(11) NOT NULL,
  `arquivo` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `nome` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descricao` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `data_criacao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `orgao` int(11) DEFAULT '1',
  `setorPai` int(11) DEFAULT '1',
  `sigla` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `endereco` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `artigo` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `dono` int(11) DEFAULT NULL,
  `funcionarios` text COLLATE latin1_general_ci,
  `restricao` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `repositorio` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '104857600',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `setor`
--

INSERT INTO `setor` (`id`, `nome`, `orgao`, `setorPai`, `sigla`, `endereco`, `artigo`, `dono`, `funcionarios`, `restricao`, `repositorio`) VALUES
(1, 'NOME DO ÓRGÃO', 1, 1, 'ORG', '', 'A', 1, NULL, 'N', '104857600'),
(2, 'DIREÇÃO', 1, 1, 'DIR', '', 'A', 1, NULL, 'N', '104857600'),
(3, 'COORDENADOR DE FINANÇAS', 1, 1, 'COFIN', '', 'A', 1, NULL, 'N', '104857600'),
(4, 'ASSESSORIA JURÍDICA', 1, 1, 'ASSJUR', '', 'A', 1, NULL, 'N', '104857600'),
(5, 'CÉLULA DE TECNOLOGIA', 1, 1, 'CTI', '', 'A', 1, NULL, 'N', '104857600');

-- --------------------------------------------------------

--
-- Table structure for table `setor_func_per`
--

CREATE TABLE IF NOT EXISTS `setor_func_per` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setor` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `abreviacao` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `inicio` int(11) DEFAULT NULL,
  `ano` int(4) DEFAULT NULL,
  `publicado` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tem_para` char(1) COLLATE latin1_general_ci DEFAULT 'S',
  `cabecalho` text COLLATE latin1_general_ci,
  `rodape` text COLLATE latin1_general_ci,
  `layout` text COLLATE latin1_general_ci,
  `referencia` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `para` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `redacao` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `objetivo` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `documentacao` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `conclusao` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `processo` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `interessado` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  `analise` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'N;N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id`, `nome`, `abreviacao`, `inicio`, `ano`, `publicado`, `tem_para`, `cabecalho`, `rodape`, `layout`, `referencia`, `para`, `redacao`, `objetivo`, `documentacao`, `conclusao`, `processo`, `interessado`, `analise`) VALUES
(1, 'OFÍCIO', 'OF', NULL, NULL, 'S', 'S', '', '', '<p>Of&iacute;cio N&ordm; <strong>[numero]/[ano_doc]-[setor_doc]</strong></p>\n<p style="text-align: right;">Fortaleza, [data].</p>\n<p>[para]</p>\n<p><strong>Assunto:</strong> [assunto]</p>\n<p><strong>Refer&ecirc;ncia:</strong> [referencia]</p>\n<p style="text-align: justify;"><br />[redacao]</p>\n<p style="text-align: center;"><br />[remetente_assinatura]</p>', 'S;S;Referência;0', 'S;S;Destinatário;0', 'S;S;Redação;0', 'N;N;;0', 'N;N;;0', 'N;N;;0', 'N;N;;0', 'N;N;;0', 'N;N;;0'),
(2, 'COMUNICAÇÃO INTERNA', 'CI', NULL, NULL, 'S', 'S', '', '', '<p>Comunica&ccedil;&atilde;o Interna N&ordm; <strong>[numero]/[ano_doc] - [setor_doc]</strong></p>\n<p style="text-align: right;">Fortaleza, [data].</p>\n<p>[para]</p>\n<p><strong>Assunto:</strong> [assunto]</p>\n<p>[referencia]</p>\n<p>[anexos]</p>\n<p style="text-align: justify;"><br />[redacao]</p>\n<p style="text-align: center;">[remetente_assinatura]</p>', 'S;S;Referência;0', 'S;S;Para;0', 'S;S;Redação;0', 'N;N;;0', 'N;N;;0', 'N;N;;0', 'N;N;;0', 'N;N;;0', 'N;N;;0'),
(3, 'DESPACHO', 'DESP', NULL, NULL, 'S', 'S', '', '', '<table style="border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td align="center"><strong>[tipo_doc] N&ordm; [numero]/[ano_doc] - [setor_doc]</strong></td>\n</tr>\n</tbody>\n</table>\n<table style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; border-collapse: collapse;" width="100%">\n<tbody>\n<tr>\n<td width="50%"><strong> N&ordm;. do processo:</strong> [processo]</td>\n<td><strong>De:</strong> [setor_doc]</td>\n</tr>\n<tr>\n<td><strong>Interessado:</strong> [interessado]</td>\n<td><strong>Para:</strong> [para]</td>\n</tr>\n<tr>\n<td><strong>Assunto:</strong> [assunto]</td>\n<td><strong>Data:</strong> [data]</td>\n</tr>\n<tr>\n<td colspan="2">[anexos]</td>\n</tr>\n</tbody>\n</table>\n<div style="margin-top: 15px; border: solid 1px black; background-color: #fff; color: black; height: 600px; width: 100%; padding-left: 10px; padding-right: 10px; text-align: justify; line-height: 140%; display: table;">[redacao]\n<div style="margin-top: 37px; text-align: center;">[remetente_assinatura]</div>\n</div>', 'N;N;;0', 'S;S;Para;0', 'S;S;Redação;4', 'N;N;;0', 'N;N;;0', 'N;N;;0', 'S;S;Processo;1', 'S;S;Interessado;2', 'N;N;;0');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_ano`
--

CREATE TABLE IF NOT EXISTS `tipo_ano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `ano` int(4) NOT NULL,
  `inicio` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `sobrenome` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `senha` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `confsenha` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `setor` int(11) DEFAULT '1',
  `setores` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `nivel` int(11) DEFAULT '2',
  `email` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `upload` varchar(10) COLLATE latin1_general_ci DEFAULT '2048',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `cpf`, `nome`, `sobrenome`, `senha`, `confsenha`, `setor`, `setores`, `nivel`, `email`, `upload`) VALUES
(1, '11111111111', 'ADMINISTRADOR', 'Administrador', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 1, '2', 1, 'admin@geradoc.com.br', '2048'),
(2, '22222222222', 'REDATOR', NULL, 'eab9e1f8e8c7421c149be0fd8cae0114', NULL, 0, '2', 2, 'redator@geradoc.com.br', '2048');

-- --------------------------------------------------------

--
-- Table structure for table `workflow`
--

CREATE TABLE IF NOT EXISTS `workflow` (
  `id_workflow` int(11) NOT NULL AUTO_INCREMENT,
  `id_documento` int(11) NOT NULL,
  `id_setor_destino` int(11) NOT NULL,
  `id_remetente` int(11) NOT NULL,
  `id_recebedor` int(11) DEFAULT NULL,
  `data_envio` datetime NOT NULL,
  `data_recebimento` datetime DEFAULT NULL,
  `data_recusa` datetime DEFAULT NULL,
  PRIMARY KEY (`id_workflow`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `workflow`
--

INSERT INTO `workflow` (`id_workflow`, `id_documento`, `id_setor_destino`, `id_remetente`, `id_recebedor`, `data_envio`, `data_recebimento`) VALUES
(1, 1, 3, 1, NULL, '2016-09-14 09:18:11', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
