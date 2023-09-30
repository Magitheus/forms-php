-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 24-Ago-2023 às 12:10
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `revista`
--
CREATE DATABASE IF NOT EXISTS `revista` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `revista`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_postagem`
--

CREATE TABLE IF NOT EXISTS `categoria_postagem` (
  `id_cat_postagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_poatagem` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_cat_postagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id_comentario` int(11) NOT NULL,
  `conteudo` varchar(200) NOT NULL,
  `data` datetime NOT NULL,
  `moderacao` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - aguardando; 1 - aguardando',
  `id_postagem` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

CREATE TABLE IF NOT EXISTS `postagem` (
  `id_postagem` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `conteudo` text NOT NULL,
  `foto` varchar(37) DEFAULT NULL,
  `data` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_postagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` char(40) NOT NULL,
  `foto` varchar(37) DEFAULT NULL,
  `tipo_usuario` tinyint(4) NOT NULL DEFAULT '3' COMMENT '1 - ADM; 2 - jornalista; 3 - usuario comum',
  `bloqueado` int(11) NOT NULL DEFAULT '0' COMMENT '0 - livre; 1 - bloqueado',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
