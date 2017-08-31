-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Abr-2016 às 16:15
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zend_book`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `s_pessoa`
--

CREATE TABLE IF NOT EXISTS `s_pessoa` (
  `pessoa_cod` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_nome` varchar(100) NOT NULL,
  `pessoa_cpf` varchar(11) NOT NULL,
  `pessoa_email` varchar(100) NOT NULL,
  `pessoa_tel` varchar(20) NOT NULL,
  PRIMARY KEY (`pessoa_cod`),
  UNIQUE KEY `pessoa_cpf` (`pessoa_cpf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `s_pessoa`
--

INSERT INTO `s_pessoa` (`pessoa_cod`, `pessoa_nome`, `pessoa_cpf`, `pessoa_email`, `pessoa_tel`) VALUES
(1, 'Ronily', 'teste', 'teste@teste.com', '(83) 99828-5142'),
(3, 'Update', '324324234', 'teste@teste.com', '(83) 99828-5142'),
(4, 'Teste', '23423423', 'teste@teste.com', '(83) 99828-5142'),
(5, 'Marcelo', '34324234', 'teste@teste.com', '(83) 99828-5142'),
(8, 'Teste', 'ddsfdsfsdf', 'teste@teste.com', '(83) 99828-5142'),
(9, 'delete', 'delete', 'teste@teste.com', '(83) 9828 - 5128'),
(10, 'delete2', 'delete2', 'teste@teste.com', 'teste');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
