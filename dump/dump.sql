CREATE DATABASE IF NOT EXISTS `zig`;
USE `zig`;


CREATE TABLE IF NOT EXISTS `perfis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO `perfis` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', '2020-06-21 13:00:15', '0000-00-00 00:00:00'),
	(2, 'Administrador', '2020-07-10 09:07:34', '0000-00-00 00:00:00'),
	(4, 'Vendedor', '2020-04-25 00:53:32', '0000-00-00 00:00:00'),
	(5, 'Gerente', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

CREATE TABLE IF NOT EXISTS `clientes_segmentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;


INSERT INTO `clientes_segmentos` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Restaurante', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Hamburgueria', '2020-05-28 10:28:08', '2020-05-28 10:28:09'),
	(3, 'Pizzaria', '2020-05-28 10:28:52', '2020-05-28 10:28:53'),
	(4, 'Outros...', '2020-06-02 00:00:26', '2020-06-02 00:00:27'),
	(5, 'Arte e Antiguidades', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(6, 'Artigos Religiosos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(7, 'Assinaturas e Revistas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(8, 'Automóveis e Veículos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(9, 'Bebês e Cia', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(10, 'Blu-Ray', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(11, 'Brindes / Materiais Promocionais', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(12, 'Brinquedos e Games', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(13, 'Casa e Decoração', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(14, 'CDs', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(15, 'Colecionáveis', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(16, 'Compras Coletivas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(17, 'Construção e Ferramentas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(18, 'Cosméticos e Perfumaria', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(19, 'Cursos e Educação', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(20, 'Discos de Vinil', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(21, 'DVDs', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(22, 'Eletrodomésticos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(23, 'Eletrônicos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(24, 'Emissoras de Rádio', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(25, 'Emissoras de Televisão', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(26, 'Empregos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(27, 'Empresas de Telemarketing', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(28, 'Esporte e Lazer', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(29, 'Fitas K7 Gravadas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(30, 'Flores, Cestas e Presentes', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(31, 'Fotografia', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(32, 'HD-DVD', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(33, 'Igrejas / Templos / Instituições Religiosas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(34, 'Indústria, Comércio e Negócios', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(35, 'Infláveis Promocionais', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(36, 'Informática', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(37, 'Ingressos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(38, 'Instrumentos Musicais', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(39, 'Joalheria', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(40, 'Lazer', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(41, 'LD', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(42, 'Livros', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(43, 'MD', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(44, 'Moda e Acessórios', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(45, 'Motéis', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(46, 'Música Digital', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(47, 'Natal', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(48, 'Negócios e Oportunidades', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(49, 'Outros Serviços', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(50, 'Outros Serviços de Avaliação', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(51, 'Papelaria e Escritório', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(52, 'Páscoa', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(53, 'Pet Shop', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(54, 'Saúde', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(55, 'Serviço Advocaticios', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(56, 'Serviço de Distribuição de Jornais / Revistas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(57, 'Serviços Administrativos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(58, 'Serviços Artísticos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(59, 'Serviços de Abatedouros / Matadouros', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(60, 'Serviços de Aeroportos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(61, 'Serviços de Agências', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(62, 'Serviços de Aluguel / Locação', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(63, 'Serviços de Armazenagem', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(64, 'Serviços de Assessorias', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(65, 'Serviços de Assistência Técnica / Instalações ', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(66, 'Serviços de Associações', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(67, 'Serviços de Bancos de Sangue', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(68, 'Serviços de Bibliotecas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(69, 'Serviços de Cartórios', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(70, 'Serviços de Casas Lotéricas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(71, 'Serviços de Confecções', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(72, 'Serviços de Consórcios', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(73, 'Serviços de Consultorias', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(74, 'Serviços de Cooperativas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(75, 'Serviços de Despachante', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(76, 'Serviços de Engenharia', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(77, 'Serviços de Estacionamentos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(78, 'Serviços de Estaleiros', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(79, 'Serviços de Exportação / Importação', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(80, 'Serviços de Geólogos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(81, 'Serviços de joalheiros', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(82, 'Serviços de Leiloeiros', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(83, 'Serviços de limpeza', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(84, 'Serviços de Loja de Conveniência', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(85, 'Serviços de Mão de Obra', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(86, 'Serviços de Órgão Públicos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(87, 'Serviços de Pesquisas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(88, 'Serviços de Portos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(89, 'Serviços de Saúde / Bem Estar', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(90, 'Serviços de Seguradoras', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(91, 'Serviços de Segurança', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(92, 'Serviços de Sinalização', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(93, 'Serviços de Sindicatos / Federações', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(94, 'Serviços de Traduções', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(95, 'Serviços de Transporte', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(96, 'Serviços de Utilidade Pública', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(97, 'Serviços em Agricultura / Pecuária / Piscicultura', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(98, 'Serviços em Alimentação', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(99, 'Serviços em Arte', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(100, 'Serviços em Cine / Foto / Som', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(101, 'Serviços em Comunicação', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(102, 'Serviços em Construção', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(103, 'Serviços em Ecologia / Meio Ambiente', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(104, 'Serviços em Eletroeletrônica / Metal Mecânica', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(105, 'Serviços em Festas / Eventos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(106, 'Serviços em Informática', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(107, 'Serviços em Internet', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(108, 'Serviços em Jóias / Relógios / Óticas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(109, 'Serviços em Telefonia', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(110, 'Serviços em Veículos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(111, 'Serviços Esotéricos / Místicos', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(112, 'Serviços Financeiros', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(113, 'Serviços Funerários', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(114, 'Serviços Gerais', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(115, 'Serviços Gráficos / Editoriais', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(116, 'Serviços para Animais', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(117, 'Serviços para Deficientes', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(118, 'Serviços para Escritórios', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(119, 'Serviços para Roupas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(120, 'Serviços Socias / Assistenciais', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(121, 'Sex Shop', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(122, 'Shopping Centers', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(123, 'Tabacaria', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(124, 'Tarifas Bancárias', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(125, 'Tarifas Telefônicas', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(126, 'Telefonia', '2021-01-11 16:10:15', '0000-00-00 00:00:00'),
	(127, 'Turismo', '2021-01-11 16:10:15', '0000-00-00 00:00:00');


CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `id_segmento` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_empresas_clientes_segmentos` (`id_segmento`),
  CONSTRAINT `FK_empresas_clientes_segmentos` FOREIGN KEY (`id_segmento`) REFERENCES `clientes_segmentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `empresas` (`id`, `nome`, `email`, `telefone`, `celular`, `id_segmento`, `created_at`, `updated_at`) VALUES
	(1, 'Empresa Zig', 'zig_teste@gmail.com', '(71) 983604899', '(71) 983604899', 1, '2022-10-05 20:26:21', '2021-12-01 21:12:46');


CREATE TABLE IF NOT EXISTS `sexos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `sexos` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Masculino', '2020-02-21 14:08:58', '0000-00-00 00:00:00'),
	(2, 'Feminino', '2020-02-21 14:09:09', '0000-00-00 00:00:00');


CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_empresa` int NOT NULL DEFAULT '0',
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `remember_token` varchar(60) DEFAULT NULL,
  `remember_expire_date` timestamp NULL DEFAULT NULL,
  `id_sexo` int DEFAULT NULL,
  `id_perfil` int DEFAULT NULL,
  `imagem` LONGBLOB DEFAULT NULL,
  `status` int DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_sexo` (`id_sexo`),
  KEY `FK_usuarios_perfis` (`id_perfil`),
  KEY `FK_usuarios_clientes` (`id_empresa`),
  CONSTRAINT `FK_usuarios_clientes` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  CONSTRAINT `FK_usuarios_perfis` FOREIGN KEY (`id_perfil`) REFERENCES `perfis` (`id`),
  CONSTRAINT `FK_usuarios_sexo` FOREIGN KEY (`id_sexo`) REFERENCES `sexos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

INSERT INTO `usuarios` (`id`, `id_empresa`, `nome`, `email`, `password`, `remember_token`, `remember_expire_date`, `id_sexo`, `id_perfil`, `imagem`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'Valdiney França', 'admin@admin.com', '3b5df72898847f008454f4ed60280d6bdffc890d', '07ebe9576b57d89c3c98cecde6c339a6f8233002', '2022-12-11 09:48:26', 1, 1, 'public/imagem/perfil_usuarios/1665188858.jpg', 1, '2022-11-11 09:48:26', '2022-11-11 09:48:26', '0000-00-00 00:00:00');

CREATE TABLE IF NOT EXISTS `recuperacao_de_senha` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `hash` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `clientes_tipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `clientes_tipos` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Pessoa Fisica', '2020-05-28 10:24:51', '2020-05-28 10:24:52'),
	(2, 'Pessoa Juridica', '2020-05-28 10:25:05', '2020-05-28 10:25:06');

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_empresa` int NOT NULL,
  `id_cliente_tipo` int NOT NULL,
  `id_cliente_segmento` int DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnpj` varchar(50) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_clientes_tipos_clientes` (`id_cliente_tipo`),
  KEY `FK_clientes_clientes_segmentos` (`id_cliente_segmento`),
  KEY `FK_clientes_empresas` (`id_empresa`),
  CONSTRAINT `FK_clientes_clientes_segmentos` FOREIGN KEY (`id_cliente_segmento`) REFERENCES `clientes_segmentos` (`id`),
  CONSTRAINT `FK_clientes_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  CONSTRAINT `FK_clientes_tipos_clientes` FOREIGN KEY (`id_cliente_tipo`) REFERENCES `clientes_tipos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `clientes_enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_empresa` int NOT NULL DEFAULT '0',
  `id_cliente` int NOT NULL DEFAULT '0',
  `cep` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `complemento` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_clientes_enderecos_empresas` (`id_empresa`),
  KEY `FK_clientes_enderecos_clientes` (`id_cliente`),
  CONSTRAINT `FK_clientes_enderecos_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `FK_clientes_enderecos_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tipos_pdv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `tipos_pdv` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Padrão', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Diferencial', '2020-05-23 17:02:09', '2020-05-23 17:02:09');

CREATE TABLE IF NOT EXISTS `config_pdv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_empresa` int NOT NULL,
  `id_tipo_pdv` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_config_pdv_clientes` (`id_empresa`),
  KEY `FK_config_pdv_tipo_pdv` (`id_tipo_pdv`),
  CONSTRAINT `FK_config_pdv_clientes` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  CONSTRAINT `FK_config_pdv_tipo_pdv` FOREIGN KEY (`id_tipo_pdv`) REFERENCES `tipos_pdv` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `config_pdv` (`id`, `id_empresa`, `id_tipo_pdv`, `created_at`, `updated_at`) VALUES
	(3, 1, 2, '2022-09-21 21:45:47', '2022-09-21 21:45:47');

CREATE TABLE IF NOT EXISTS `log_acessos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL DEFAULT '0',
  `id_empresa` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_log_usuarios` (`id_usuario`),
  KEY `FK_log_clientes` (`id_empresa`),
  CONSTRAINT `FK_log_clientes` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  CONSTRAINT `FK_log_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1062 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `meios_pagamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `legenda` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `meios_pagamentos` (`id`, `legenda`, `created_at`, `updated_at`) VALUES
	(1, 'Dinheiro', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Crédito', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'Débito', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'Boleto', '2021-01-14 12:03:35', '0000-00-00 00:00:00'),
	(5, 'Pix', '2021-12-27 15:06:48', '0000-00-00 00:00:00');

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_empresa` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `preco` double NOT NULL DEFAULT '0',
  `descricao` text,
  `imagem` LONGBLOB DEFAULT NULL,
  `ativar_quantidade` int NOT NULL DEFAULT '0' COMMENT 'SIM = 1, NÃO = 0',
  `quantidade` int DEFAULT '0',
  `mostrar_em_vendas` int DEFAULT '1' COMMENT 'SIM =1, NÃO = 0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_produtos_clientes` (`id_empresa`),
  CONSTRAINT `FK_produtos_clientes` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_meio_pagamento` int NOT NULL,
  `id_empresa` int NOT NULL,
  `id_produto` int DEFAULT NULL,
  `preco` double DEFAULT '0',
  `quantidade` int DEFAULT NULL,
  `valor` double NOT NULL DEFAULT '0',
  `valor_recebido` double DEFAULT NULL COMMENT 'Este valor é preenchido somente quando a opção de pagamento for dinheiro',
  `troco` double DEFAULT NULL COMMENT 'Este campo é preenchido quando houver troco durante a venda',
  `data_compensacao` date DEFAULT NULL,
  `codigo_venda` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vendas_meios_de_pagamento` (`id_meio_pagamento`),
  KEY `FK_vendas_usuarios` (`id_usuario`),
  KEY `FK_vendas_clientes` (`id_empresa`),
  CONSTRAINT `FK_vendas_clientes` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  CONSTRAINT `FK_vendas_meios_de_pagamento` FOREIGN KEY (`id_meio_pagamento`) REFERENCES `meios_pagamentos` (`id`),
  CONSTRAINT `FK_vendas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=latin1;

ALTER TABLE vendas
ADD quantidade_parcela INT DEFAULT 0,
ADD valor_parcela DOUBLE DEFAULT NULL;

ALTER TABLE vendas
ADD COLUMN id_cliente INT NULL,
ADD CONSTRAINT fk_id_cliente
    FOREIGN KEY (id_cliente)
    REFERENCES clientes(id);

ALTER TABLE produtos
ADD COLUMN unidade varchar(30) NULL;

ALTER TABLE produtos
ADD preco_custo DECIMAL(10,2);

ALTER TABLE produtos
ADD data_fim_desconto timestamp NULL DEFAULT NULL,
ADD data_inicio_desconto timestamp NULL DEFAULT NULL,
ADD valor_desconto DECIMAL(10,2);

ALTER TABLE produtos
ADD em_desconto INT DEFAULT 0;

ALTER TABLE vendas
ADD valor_desconto DECIMAL(10,2);

