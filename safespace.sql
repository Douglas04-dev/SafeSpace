CREATE DATABASE IF NOT EXISTS `safespace`;
USE `safespace`;

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuarios`)
);

CREATE TABLE `profissionais` (
  `idProfissional` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` char(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `crp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `especialidade` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `link` varchar (500) default null,
  PRIMARY KEY (`idProfissional`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `crp_UNIQUE` (`crp`)
);



CREATE TABLE `fotos_perfil` (
  `idFoto` INT NOT NULL AUTO_INCREMENT,
  `idDono` INT NOT NULL,
  `tipo_dono` ENUM('usuario', 'profissional') NOT NULL,
  `caminho_arquivo` VARCHAR(255) NOT NULL,
  `data_upload` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFoto`)
);


CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  conteudo TEXT NOT NULL,
  data_post DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(idUsuarios)
);

ALTER TABLE posts ADD COLUMN titulo VARCHAR(100) DEFAULT NULL;




