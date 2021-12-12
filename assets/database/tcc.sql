-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Dez-2021 às 18:21
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id`, `login`, `senha`) VALUES
(11, 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` varchar(14) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `numero` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `login`, `senha`, `nome`, `numero`) VALUES
('2147483647', 'userNogueira', '202cb962ac59075b964b07152d234b70', 'Nogueira', '(55)999517980'),
('97547215634587', 'userFronteira', '202cb962ac59075b964b07152d234b70', 'Fronteira', '(55)999626534');

-- --------------------------------------------------------

--
-- Estrutura da tabela `linha`
--

CREATE TABLE `linha` (
  `id` int(11) NOT NULL,
  `mapa` varchar(1000) NOT NULL,
  `tempo` time NOT NULL,
  `passagens` double NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `empresa_id` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `linha`
--

INSERT INTO `linha` (`id`, `mapa`, `tempo`, `passagens`, `status`, `empresa_id`) VALUES
(1000, 'https://www.google.com/maps/d/u/0/embed?mid=1m-FedpFBbY2pRt7xRmkC4YhEphWsaqkq', '00:31:00', 3.75, 'Em andamento', '2147483647'),
(2968, 'MyMaps', '00:30:00', 3.75, 'Em andamento', '2147483647'),
(3001, 'https://www.google.com/maps/d/u/0/embed?mid=1tASnUobh2i-VygVt4rqGuOXMkxevf0bF', '01:00:00', 3.2, 'Linha finalizada', '97547215634587');

-- --------------------------------------------------------

--
-- Estrutura da tabela `linha_has_ponto`
--

CREATE TABLE `linha_has_ponto` (
  `linha_id` int(11) NOT NULL,
  `ponto_id` int(11) NOT NULL,
  `manha` time NOT NULL,
  `tarde` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `linha_has_ponto`
--

INSERT INTO `linha_has_ponto` (`linha_id`, `ponto_id`, `manha`, `tarde`) VALUES
(1000, 10, '06:00:00', '12:00:00'),
(1000, 11, '06:05:00', '12:05:00'),
(1000, 13, '06:10:00', '12:10:00'),
(1000, 14, '06:12:00', '12:15:00'),
(1000, 15, '06:20:00', '12:20:00'),
(1000, 16, '06:25:00', '12:25:00'),
(1000, 18, '06:30:00', '12:30:00'),
(1000, 19, '06:35:00', '12:35:00'),
(3001, 22, '08:00:00', '15:03:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `onibus`
--

CREATE TABLE `onibus` (
  `id` int(7) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `empresa_id` varchar(14) NOT NULL,
  `linha_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `onibus`
--

INSERT INTO `onibus` (`id`, `nome`, `empresa_id`, `linha_id`) VALUES
(2000, 'João XIII', '2147483647', 1000),
(4500, 'Terminal', '97547215634587', 3001);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ponto`
--

CREATE TABLE `ponto` (
  `id` int(11) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `localizacao` varchar(1000) NOT NULL,
  `rua_cep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ponto`
--

INSERT INTO `ponto` (`id`, `endereco`, `localizacao`, `rua_cep`) VALUES
(10, 'Av. Tiaraju, 561', 'https://www.google.com.br/maps/@-29.7959354,-55.7592265,3a,87.9y,57.6h,81.24t/data=!3m6!1e1!3m4!1s4RteK_5JQOI8Xf4q_w2T4A!2e0!7i13312!8i6656', 97546550),
(11, 'Av. Tiaraju, 1164', 'https://www.google.com.br/maps/@-29.7924303,-55.7637676,3a,75y,41.29h,79.43t/data=!3m6!1e1!3m4!1sNwktnwOoHXpaxMtvQUaw8Q!2e0!7i13312!8i6656', 97546550),
(13, 'Av. Tiaraju, 895', 'https://www.google.com.br/maps/@-29.7901368,-55.7663463,3a,75y,22.02h,72.49t/data=!3m6!1e1!3m4!1sMlffKu5iPtf4GO2qrRWSNw!2e0!7i13312!8i6656', 97546550),
(14, 'Av. Tiaraju, 549', 'https://www.google.com.br/maps/@-29.7887997,-55.7677763,3a,75y,46.17h,67.6t/data=!3m6!1e1!3m4!1sQQqGXXgni5GfIvaPnSmjuQ!2e0!7i13312!8i6656', 97546550),
(15, 'Av. Tiaraju, 153', 'https://www.google.com.br/maps/@-29.7887918,-55.7684629,3a,75y,235.66h,72.61t/data=!3m6!1e1!3m4!1sZJa6CxsXkIUGTkYxTdMtdQ!2e0!7i16384!8i8192', 97546550),
(16, 'Av. Tiaraju, 958', 'https://www.google.com.br/maps/@-29.7906664,-55.7664465,3a,75y,246.96h,78.96t/data=!3m6!1e1!3m4!1sYfbQeqVIQPCJj_4WU5iKBw!2e0!7i16384!8i8192', 97546550),
(18, 'Av. Tiaraju, 1096', 'https://www.google.com.br/maps/@-29.7927462,-55.7639963,3a,75y,174.12h,82.02t/data=!3m6!1e1!3m4!1ssEotnT7A2Ge70_rI-BTr7Q!2e0!7i16384!8i8192', 97546550),
(19, 'Av. Tiaraju, Saleiro', 'https://www.google.com.br/maps/@-29.7962625,-55.7592263,3a,75y,239.7h,67.48t/data=!3m6!1e1!3m4!1sTWfQzwnDb-TlomKSy5rjQA!2e0!7i13312!8i6656', 97546550),
(22, 'R. Cel. Cabrita, 44', 'https://www.google.com.br/maps/@-29.7828487,-55.7893477,3a,48.9y,94.9h,75.42t/data=!3m6!1e1!3m4!1s9DMj5yp3aoXjWWSaWEnIyQ!2e0!7i13312!8i6656', 97541100),
(26, ' R. Barão do Cerro Largo, 932', 'https://www.google.com.br/maps/@-29.7854208,-55.7945256,3a,75y,181.07h,84.69t/data=!3m7!1e1!3m5!1ssTA2HFOCTHc-x-jueWJUvA!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3DsTA2HFOCTHc-x-jueWJUvA%26cb_client%3Dmaps_sv.tactile.gps%26w%3D203%26h%3D100%26yaw%3D287.37515%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192', 97560000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ruasavenidas`
--

CREATE TABLE `ruasavenidas` (
  `cep` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ruasavenidas`
--

INSERT INTO `ruasavenidas` (`cep`, `nome`) VALUES
(97541100, 'R. Cel. Cabrita'),
(97546550, 'Av. Tiaraju'),
(97547215, 'Rua Gentil Francisco Carlesso'),
(97560000, 'Rua Barão do Cerro Largo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Índices para tabela `linha`
--
ALTER TABLE `linha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_idFK_idx` (`empresa_id`);

--
-- Índices para tabela `linha_has_ponto`
--
ALTER TABLE `linha_has_ponto`
  ADD PRIMARY KEY (`linha_id`,`ponto_id`),
  ADD KEY `fk_linha_has_ponto_linha1_idx` (`linha_id`),
  ADD KEY `fk_linha_has_ponto_ponto1_idx` (`ponto_id`);

--
-- Índices para tabela `onibus`
--
ALTER TABLE `onibus`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ponto`
--
ALTER TABLE `ponto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rua_cep_fk_idx` (`rua_cep`);

--
-- Índices para tabela `ruasavenidas`
--
ALTER TABLE `ruasavenidas`
  ADD PRIMARY KEY (`cep`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `ponto`
--
ALTER TABLE `ponto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `linha`
--
ALTER TABLE `linha`
  ADD CONSTRAINT `empresa_idFK` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `linha_has_ponto`
--
ALTER TABLE `linha_has_ponto`
  ADD CONSTRAINT `fk_linha_has_ponto_linha1` FOREIGN KEY (`linha_id`) REFERENCES `linha` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_linha_has_ponto_ponto1` FOREIGN KEY (`ponto_id`) REFERENCES `ponto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `ponto`
--
ALTER TABLE `ponto`
  ADD CONSTRAINT `rua_cep_fk` FOREIGN KEY (`rua_cep`) REFERENCES `ruasavenidas` (`cep`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
