-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/06/2025 às 16:36
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `exemplar`
--

CREATE TABLE `exemplar` (
  `id_exemplar` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `codigo_exemplar` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'disponível',
  `localizacao` varchar(100) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exemplar`
--

INSERT INTO `exemplar` (`id_exemplar`, `id_livro`, `codigo_exemplar`, `status`, `localizacao`, `criado_em`) VALUES
(1, 1, 'EX00001', 'disponível', 'não definido', '2025-06-17 14:03:39'),
(2, 2, 'EX00002', 'Indisponivel', 'não definido', '2025-06-17 14:12:38'),
(3, 3, 'EX00003', 'Indisponivel', 'não definido', '2025-06-17 14:18:57'),
(4, 4, 'EX00004', 'Indisponivel', 'não definido', '2025-06-17 14:19:46'),
(5, 5, 'EX00005', 'Indisponivel', 'não definido', '2025-06-17 14:20:45'),
(6, 6, 'EX00006', 'Indisponivel', 'não definido', '2025-06-17 14:23:49'),
(7, 7, 'EX00007', 'Indisponivel', 'não definido', '2025-06-17 14:24:06'),
(8, 8, 'EX00008', 'Indisponivel', 'não definido', '2025-06-17 14:24:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `id_livro` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `editora` varchar(255) DEFAULT NULL,
  `ano_publicacao` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`id_livro`, `titulo`, `autor`, `editora`, `ano_publicacao`, `criado_em`) VALUES
(1, '123', 'egsdrg', 'cxbnvc', 1999, '2025-06-17 14:03:18'),
(2, 'senzala', 'ribeiro', 'dsgdg', 235421, '2025-06-17 14:12:38'),
(3, 'senzala', 'ribeiro', 'dsgdg', 235421, '2025-06-17 14:18:57'),
(4, 'senzala', 'ribeiro', 'dsgdg', 235421, '2025-06-17 14:19:46'),
(5, 'senzala', 'ribeiro', 'dsgdg', 235421, '2025-06-17 14:20:45'),
(6, 'senzala', 'ribeiro', 'dsgdg', 235421, '2025-06-17 14:23:49'),
(7, 'senzala', 'ribeiro', 'dsgdg', 235421, '2025-06-17 14:24:06'),
(8, 'senzala', 'ribeiro', 'dsgdg', 235421, '2025-06-17 14:24:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `criado_em`) VALUES
(1, 'Admin', 'admin@biblioteca.com', '1234', '2025-06-17 14:01:37'),
(2, 'Ana Thais Pereira de Paiva', 'thiagopaiva2201@gmail.com', '$2y$10$3dTAvcnSIn7x7/5EcDoZeuK.WXFw1bzQuGvYWLbArDDhICIqd4cS6', '2025-06-17 14:28:18');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `exemplar`
--
ALTER TABLE `exemplar`
  ADD PRIMARY KEY (`id_exemplar`),
  ADD UNIQUE KEY `codigo_exemplar` (`codigo_exemplar`),
  ADD KEY `fk_exemplar_livro` (`id_livro`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id_livro`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `exemplar`
--
ALTER TABLE `exemplar`
  MODIFY `id_exemplar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `exemplar`
--
ALTER TABLE `exemplar`
  ADD CONSTRAINT `fk_exemplar_livro` FOREIGN KEY (`id_livro`) REFERENCES `livro` (`id_livro`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
