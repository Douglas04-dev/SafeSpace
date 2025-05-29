CREATE DATABASE IF NOT EXISTS `safespace`;
USE `safespace`;

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
ALTER TABLE profissionais ADD COLUMN nome VARCHAR(50) NOT NULL AFTER idUsuario;

-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES 
(1,'Douglas','douglas.almeida@gmail.com','teste1@'),
(2,'Daniel','daniel.silva@gmail.com','teste1@'),
(3,'Gabrieli ','gabi.azeredo@gmail.com','teste1@'),
(4,'Neusa','neusa@gmail.com','teste1@');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissionais`
--


CREATE TABLE `profissionais` (
  `idProfissional` int(11) NOT NULL AUTO_INCREMENT,

  `cpf` char(11) NOT NULL,
    `nome` char(11) NOT NULL,
  `crp` varchar(20) NOT NULL,
  `especialidade` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`idProfissional`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `crp_UNIQUE` (`crp`),
  KEY `fk_usuario_idx` (`idUsuario`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


CREATE TABLE `fotos_perfil` (
  `idFoto` INT NOT NULL AUTO_INCREMENT,
  `idDono` INT NOT NULL,
  `tipo_dono` ENUM('usuario', 'profissional') NOT NULL,
  `caminho_arquivo` VARCHAR(255) NOT NULL,
  `data_upload` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFoto`)
);
