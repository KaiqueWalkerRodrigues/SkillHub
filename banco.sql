-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: skillhub
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aulas`
--

DROP TABLE IF EXISTS `aulas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aulas` (
  `id_aula` int NOT NULL AUTO_INCREMENT,
  `id_curso` int NOT NULL,
  `duracao` int NOT NULL,
  `link` text,
  PRIMARY KEY (`id_aula`),
  KEY `fk_aulas_cursos_idx` (`id_curso`),
  CONSTRAINT `fk_aulas_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aulas`
--

LOCK TABLES `aulas` WRITE;
/*!40000 ALTER TABLE `aulas` DISABLE KEYS */;
INSERT INTO `aulas` VALUES (1,1,0,'https://www.youtube.com/embed/1PfUGFOla9A?si=6HCJcbg6cGS5GJXv');
/*!40000 ALTER TABLE `aulas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `imagem` text NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Introdução ao Uso de Computadores','https://s2-techtudo.glbimg.com/8rng1sV5afk_6WZRli1PKTvoy7w=/0x0:1500x1000/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_08fbf48bc0524877943fe86e43087e7a/internal_photos/bs/2019/n/R/kdN4P7SNuOq8mq7CUo8Q/techtudo-banner.jpg','<p>Apresentar aos alunos uma visão geral sobre o que é um computador, como ele funciona e seus principais componentes.</p>');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perguntas`
--

DROP TABLE IF EXISTS `perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perguntas` (
  `id_pergunta` int NOT NULL AUTO_INCREMENT,
  `id_quiz` int NOT NULL,
  `pergunta` text NOT NULL,
  PRIMARY KEY (`id_pergunta`),
  KEY `fk_perguntas_quizzes_idx` (`id_quiz`),
  CONSTRAINT `fk_perguntas_quizzes` FOREIGN KEY (`id_quiz`) REFERENCES `quizzes` (`id_quiz`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perguntas`
--

LOCK TABLES `perguntas` WRITE;
/*!40000 ALTER TABLE `perguntas` DISABLE KEYS */;
INSERT INTO `perguntas` VALUES (1,1,'Qual é a função principal da CPU em um computador?'),(2,1,'Qual componente do computador é utilizado para inserir dados através de letras e números?'),(3,1,'Qual é a sequência correta para desligar um computador?'),(4,1,'Qual dos seguintes cuidados NÃO é necessário para a manutenção básica de um computador?'),(5,1,'O que é necessário fazer antes de ligar o computador?');
/*!40000 ALTER TABLE `perguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `id_quiz` int NOT NULL AUTO_INCREMENT,
  `id_curso` int DEFAULT NULL,
  PRIMARY KEY (`id_quiz`),
  KEY `fk_quizzes_cursos_idx` (`id_curso`),
  CONSTRAINT `fk_quizzes_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (1,1);
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respostas`
--

DROP TABLE IF EXISTS `respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `respostas` (
  `id_resposta` int NOT NULL AUTO_INCREMENT,
  `id_pergunta` int NOT NULL,
  `resposta` text NOT NULL,
  `correta` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_resposta`),
  KEY `fk_respostas_perguntas_idx` (`id_pergunta`),
  CONSTRAINT `fk_respostas_perguntas` FOREIGN KEY (`id_pergunta`) REFERENCES `perguntas` (`id_pergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respostas`
--

LOCK TABLES `respostas` WRITE;
/*!40000 ALTER TABLE `respostas` DISABLE KEYS */;
INSERT INTO `respostas` VALUES (1,1,'Exibir imagens e vídeos.',0),(2,1,'Processar informações e executar instruções.',1),(3,1,'Armazenar arquivos e documentos.',0),(4,1,'Conectar o computador à internet.',0),(5,2,'Monitor',0),(6,2,'CPU',0),(7,2,'Teclado',1),(8,2,'Mouse',0),(9,3,'Fechar todos os programas e desconectar da energia.',0),(10,3,'Pressionar o botão de energia até o computador desligar.',0),(11,3,'Acessar o menu \'Iniciar\' e selecionar \'Desligar\'.',1),(12,3,'Desligar o estabilizador e depois o computador.',0),(13,4,'Limpar o monitor, teclado e mouse regularmente.',0),(14,4,'Desligar o computador corretamente pelo menu \'Iniciar\'.',0),(15,4,'Manter o computador sempre ligado para evitar falhas.',1),(16,4,'Usar protetores contra surtos elétricos.',0),(17,5,'Ligar o monitor primeiro.',0),(18,5,'Verificar se todas as conexões estão corretas e ligar o estabilizador ou nobreak.',1),(19,5,'Apertar o botão do mouse.',0),(20,5,'Desconectar todos os cabos para evitar sobrecarga.',0);
/*!40000 ALTER TABLE `respostas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(80) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpf` char(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'kaique.souza','SkggAh44MvTP6','Kaique Rodrigues','37498968878');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_quizzes`
--

DROP TABLE IF EXISTS `usuarios_quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_quizzes` (
  `id_usuario_quiz` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_quiz` int NOT NULL,
  `nota` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario_quiz`),
  KEY `fk_usuarios_quizzes_usuarios_idx` (`id_usuario`),
  KEY `fk_usuarios_quizzes_quizzes_idx` (`id_quiz`),
  CONSTRAINT `fk_usuarios_quizzes_quizzes` FOREIGN KEY (`id_quiz`) REFERENCES `quizzes` (`id_quiz`),
  CONSTRAINT `fk_usuarios_quizzes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_quizzes`
--

LOCK TABLES `usuarios_quizzes` WRITE;
/*!40000 ALTER TABLE `usuarios_quizzes` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_quizzes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-09  9:47:51
