
CREATE DATABASE IF NOT EXISTS `kabum` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `kabum`;

CREATE TABLE `tb_cliente` (
  `id_cliente` bigint(20) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tb_endereco` (
  `id_endereco` bigint(20) NOT NULL,
  `logradouro` varchar(80) DEFAULT NULL,
  `logradouro_numero` varchar(80) DEFAULT NULL,
  `logradouro_complemento` varchar(80) DEFAULT NULL,
  `logradouro_bairro` varchar(80) DEFAULT NULL,
  `logradouro_cep` varchar(80) DEFAULT NULL,
  `logradouro_cidade` varchar(80) DEFAULT NULL,
  `logradouro_estado` varchar(80) DEFAULT NULL,
  `id_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tb_usuario` (
  `id_usuario` bigint(20) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `CPF` (`cpf`);

ALTER TABLE `tb_endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `id_usuario` (`id_usuario`);

ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `login` (`login`);

ALTER TABLE `tb_cliente`
  MODIFY `id_cliente` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tb_endereco`
  MODIFY `id_endereco` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tb_usuario`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tb_endereco`
  ADD CONSTRAINT `tb_endereco_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE CASCADE;
COMMIT;

