-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/01/2026 às 23:39
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estoque`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixa`
--

CREATE TABLE `caixa` (
  `id` int(11) NOT NULL,
  `movimentacao_id` int(11) NOT NULL,
  `tipo` enum('entrada','saida') NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_movimento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `caixa`
--

INSERT INTO `caixa` (`id`, `movimentacao_id`, `tipo`, `valor`, `descricao`, `data_movimento`) VALUES
(1, 1, 'saida', 180.00, 'compra de produto 1', '2025-08-29 23:50:48'),
(2, 1, 'entrada', 10.00, 'Venda nº 1 - pix', '2025-08-31 14:53:50'),
(5, 2, 'saida', 250.00, 'compra de produto 2', '2025-08-31 15:10:23'),
(9, 3, 'entrada', 10.00, 'venda de produto 1', '2025-08-31 15:42:29'),
(10, 4, 'entrada', 10.00, 'venda de produto 1', '2025-08-31 15:43:39'),
(11, 4, 'entrada', 10.00, 'Venda nº 7 - dinheiro', '2025-08-31 15:43:39'),
(12, 5, 'entrada', 25.00, 'venda de produto 1', '2025-08-31 16:04:03'),
(13, 5, 'entrada', 25.00, 'Venda nº 8 - boleto', '2025-08-31 16:04:03'),
(14, 6, 'entrada', 0.00, 'venda de produto 1', '2025-08-31 22:33:21'),
(15, 6, 'entrada', 0.00, 'Venda nº 9 - pix', '2025-08-31 22:33:21'),
(16, 7, 'entrada', 45.00, 'venda de produto 1', '2025-09-01 15:22:24'),
(17, 7, 'entrada', 45.00, 'Venda nº 10 - pix', '2025-09-01 15:22:24'),
(18, 8, 'entrada', 45.00, 'venda de produto 1', '2025-09-01 15:25:56'),
(19, 8, 'entrada', 45.00, 'Venda nº 11 - pix', '2025-09-01 15:25:56'),
(20, 9, 'entrada', 20.00, 'venda de produto 1', '2025-09-01 17:52:01'),
(21, 9, 'entrada', 20.00, 'Venda nº 12 - pix', '2025-09-01 17:52:01'),
(22, 10, 'entrada', 20.00, 'venda de produto 1', '2025-09-01 17:52:18'),
(23, 10, 'entrada', 20.00, 'Venda nº 13 - pix', '2025-09-01 17:52:18'),
(24, 11, 'entrada', 20.00, 'venda de produto 1', '2025-09-01 17:59:46'),
(25, 11, 'entrada', 20.00, 'Venda nº 14 - cartao', '2025-09-01 17:59:46'),
(26, 12, 'entrada', 55.00, 'venda de produto 1', '2025-09-01 18:05:46'),
(27, 12, 'entrada', 55.00, 'Venda nº 15 - pix', '2025-09-01 18:05:46'),
(28, 13, 'entrada', 55.00, 'venda de produto 1', '2025-09-01 18:10:00'),
(29, 13, 'entrada', 55.00, 'Venda nº 16 - pix', '2025-09-01 18:10:00'),
(30, 14, 'entrada', 10.00, 'venda de produto 1', '2025-09-01 18:24:01'),
(31, 14, 'entrada', 10.00, 'Venda nº 17 - cartao', '2025-09-01 18:24:01'),
(32, 15, 'entrada', 35.00, 'venda de produto 1', '2026-01-16 20:48:55'),
(33, 15, 'entrada', 35.00, 'Venda nº 18 - cartao', '2026-01-16 20:48:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `config_site`
--

CREATE TABLE `config_site` (
  `id` int(11) NOT NULL,
  `nome_site` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `horario_funcionamento` varchar(100) DEFAULT NULL,
  `sobre` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `config_site`
--

INSERT INTO `config_site` (`id`, `nome_site`, `logo`, `cnpj`, `endereco`, `telefone`, `whatsapp`, `email`, `facebook`, `instagram`, `twitter`, `linkedin`, `youtube`, `horario_funcionamento`, `sobre`, `created_at`, `updated_at`) VALUES
(1, 'Estok', 'uploads/files/f16caf5a-c0c6-4f5d-af66-4c782c5b4dcf.jpeg', '888.888.888-66', '<ul><li>Av  K sem <b>Número</b>, José Walter-Fortaleza- CE CEP: 60750-110</li></ul>', '85099383567', '85987654335', 'estok@email.com', 'Estok-face', 'Estok_insta', 'Twitter_estok', 'LinEstok', 'YiuEstok', 'seg a sex 7h as 12 e de 13 as 17h', 'Smos uma empresa <b>blablablalu gf f</b>g ygf gf yg gf afg fgyg f bf \r\nzbvhdbvhdbvjhbh hhjb hf<b>  fhhbfj jf</b>bfhj bjhbjfkabfjkbkjfbkfjljlf\r\nbcbs hf hfhu huehf uh', '2025-08-29 22:17:21', '2026-01-16 22:16:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque_entradas`
--

CREATE TABLE `estoque_entradas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `data_entrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `recebido` tinyint(1) DEFAULT 0,
  `usuario_id` int(11) DEFAULT NULL,
  `loja_origem_id` int(11) DEFAULT NULL,
  `loja_destino_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque_entradas`
--

INSERT INTO `estoque_entradas` (`id`, `produto_id`, `quantidade`, `valor_unitario`, `data_entrada`, `recebido`, `usuario_id`, `loja_origem_id`, `loja_destino_id`) VALUES
(1, 1, 4, 10.00, '2025-08-29 20:52:27', 1, NULL, NULL, NULL),
(2, 2, 60, 8.00, '2025-08-29 21:20:27', 1, 1, 1, 2),
(3, 2, 30, 5.00, '2025-08-31 15:57:35', 1, 1, 1, 2);

--
-- Acionadores `estoque_entradas`
--
DELIMITER $$
CREATE TRIGGER `trg_entrada_produto` AFTER INSERT ON `estoque_entradas` FOR EACH ROW BEGIN
    UPDATE produtos 
    SET quantidade = quantidade + NEW.quantidade
    WHERE id = NEW.produto_id;

    INSERT INTO estoque_movimentos (produto_id, tipo, quantidade, usuario_id)
    VALUES (NEW.produto_id, 'entrada', NEW.quantidade, NEW.usuario_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque_movimentos`
--

CREATE TABLE `estoque_movimentos` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `tipo` enum('entrada','saida') NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_movimento` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `loja_origem_id` int(11) DEFAULT NULL,
  `loja_destino_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque_movimentos`
--

INSERT INTO `estoque_movimentos` (`id`, `produto_id`, `tipo`, `quantidade`, `data_movimento`, `usuario_id`, `loja_origem_id`, `loja_destino_id`) VALUES
(1, 1, 'entrada', 4, '2025-08-29 20:52:27', NULL, NULL, NULL),
(2, 1, 'saida', 2, '2025-08-29 20:56:39', NULL, NULL, NULL),
(3, 2, 'entrada', 60, '2025-08-29 21:20:27', 1, NULL, NULL),
(4, 2, 'saida', 10, '2025-08-29 23:34:10', 1, NULL, NULL),
(5, 2, 'entrada', 30, '2025-08-31 15:57:35', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque_saidas`
--

CREATE TABLE `estoque_saidas` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `data_saida` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `recebido` tinyint(1) DEFAULT 0,
  `loja_origem_id` int(11) DEFAULT NULL,
  `loja_destino_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque_saidas`
--

INSERT INTO `estoque_saidas` (`id`, `produto_id`, `quantidade`, `motivo`, `data_saida`, `usuario_id`, `recebido`, `loja_origem_id`, `loja_destino_id`) VALUES
(1, 1, 2, 'Devolução', '2025-08-29 20:56:39', NULL, 1, NULL, NULL),
(2, 2, 10, 'Venda', '2025-08-29 23:34:10', 1, 1, 1, 2);

--
-- Acionadores `estoque_saidas`
--
DELIMITER $$
CREATE TRIGGER `trg_saida_produto` AFTER INSERT ON `estoque_saidas` FOR EACH ROW BEGIN
    UPDATE produtos 
    SET quantidade = quantidade - NEW.quantidade
    WHERE id = NEW.produto_id;

    INSERT INTO estoque_movimentos (produto_id, tipo, quantidade, usuario_id)
    VALUES (NEW.produto_id, 'saida', NEW.quantidade, NEW.usuario_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `sobre_nos` longtext DEFAULT NULL,
  `faq` longtext DEFAULT NULL,
  `politica_privacidade` longtext DEFAULT NULL,
  `termos_condicoes` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lojas`
--

CREATE TABLE `lojas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lojas`
--

INSERT INTO `lojas` (`id`, `nome`, `cnpj`, `email`, `telefone`, `endereco`, `data_cadastro`) VALUES
(1, 'L1', '777.777.888-99', 'l1@email.com', '85655434567', 'Rua Tal de tal n 1', '2025-08-29 21:18:43'),
(2, 'L2', '666.666.666-88', 'l2@email.com', '85776354255', 'Rua ja n 2', '2025-08-29 21:19:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacao_financeira`
--

CREATE TABLE `movimentacao_financeira` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `tipo_movimentacao` enum('compra','venda') NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `valor_total` decimal(12,2) GENERATED ALWAYS AS (`quantidade` * `valor_unitario`) STORED,
  `data_movimentacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `loja_origem_id` int(11) DEFAULT NULL,
  `loja_destino_id` int(11) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `movimentacao_financeira`
--

INSERT INTO `movimentacao_financeira` (`id`, `produto_id`, `tipo_movimentacao`, `quantidade`, `valor_unitario`, `data_movimentacao`, `usuario_id`, `loja_origem_id`, `loja_destino_id`, `observacao`) VALUES
(1, 1, 'compra', 60, 3.00, '2025-08-29 23:50:48', 1, 1, 2, 'ok'),
(2, 2, 'compra', 50, 5.00, '2025-08-31 15:10:23', 1, 1, 1, 'OK'),
(3, 1, 'venda', 1, 10.00, '2025-08-31 15:42:29', 1, 1, NULL, 'Ajuste venda antiga'),
(4, 1, 'venda', 1, 10.00, '2025-08-31 15:43:39', 1, 2, NULL, 'Venda nº 7'),
(5, 1, 'venda', 1, 25.00, '2025-08-31 16:04:03', 1, 1, NULL, 'Venda nº 8'),
(6, 1, 'venda', 1, 0.00, '2025-08-31 22:33:21', 1, 1, NULL, 'Venda nº 9'),
(7, 1, 'venda', 1, 45.00, '2025-09-01 15:22:24', 1, 2, NULL, 'Venda nº 10'),
(8, 1, 'venda', 1, 45.00, '2025-09-01 15:25:56', 1, 2, NULL, 'Venda nº 11'),
(9, 1, 'venda', 1, 20.00, '2025-09-01 17:52:01', 1, 1, NULL, 'Venda nº 12'),
(10, 1, 'venda', 1, 20.00, '2025-09-01 17:52:18', 1, 1, NULL, 'Venda nº 13'),
(11, 1, 'venda', 1, 20.00, '2025-09-01 17:59:46', 1, 1, NULL, 'Venda nº 14'),
(12, 1, 'venda', 1, 55.00, '2025-09-01 18:05:46', 1, 1, NULL, 'Venda nº 15'),
(13, 1, 'venda', 1, 55.00, '2025-09-01 18:10:00', 2, 2, NULL, 'Venda nº 16'),
(14, 1, 'venda', 1, 10.00, '2025-09-01 18:24:01', 2, 1, NULL, 'Venda nº 17'),
(15, 1, 'venda', 1, 35.00, '2026-01-16 20:48:55', 1, 1, NULL, 'Venda nº 18');

--
-- Acionadores `movimentacao_financeira`
--
DELIMITER $$
CREATE TRIGGER `trg_movfinance` AFTER INSERT ON `movimentacao_financeira` FOR EACH ROW BEGIN
    -- Atualiza estoque
    IF NEW.tipo_movimentacao = 'compra' THEN
        UPDATE produtos 
        SET quantidade = quantidade + NEW.quantidade
        WHERE id = NEW.produto_id;
    ELSEIF NEW.tipo_movimentacao = 'venda' THEN
        UPDATE produtos 
        SET quantidade = quantidade - NEW.quantidade
        WHERE id = NEW.produto_id;
    END IF;

    -- Registra no caixa
    INSERT INTO caixa (movimentacao_id, tipo, valor, descricao)
    VALUES (
        NEW.id,
        CASE WHEN NEW.tipo_movimentacao = 'compra' THEN 'saida' ELSE 'entrada' END,
        NEW.valor_total,
        CONCAT(NEW.tipo_movimentacao,' de produto ', NEW.produto_id)
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission`, `role_id`) VALUES
(3659, 'home/index', 1),
(3660, 'account/index', 1),
(3661, 'account/edit', 1),
(3662, 'estoqueentradas/view', 1),
(3663, 'estoqueentradas/add', 1),
(3664, 'estoqueentradas/edit', 1),
(3665, 'estoqueentradas/delete', 1),
(3666, 'estoqueentradas/importdata', 1),
(3667, 'estoquemovimentos/view', 1),
(3668, 'estoquemovimentos/add', 1),
(3669, 'estoquemovimentos/edit', 1),
(3670, 'estoquemovimentos/delete', 1),
(3671, 'estoquemovimentos/importdata', 1),
(3672, 'estoquesaidas/view', 1),
(3673, 'estoquesaidas/add', 1),
(3674, 'estoquesaidas/edit', 1),
(3675, 'estoquesaidas/delete', 1),
(3676, 'estoquesaidas/importdata', 1),
(3677, 'produtos/view', 1),
(3678, 'produtos/add', 1),
(3679, 'produtos/edit', 1),
(3680, 'produtos/delete', 1),
(3681, 'produtos/importdata', 1),
(3682, 'users/view', 1),
(3683, 'users/add', 1),
(3684, 'users/edit', 1),
(3685, 'users/delete', 1),
(3686, 'users/importdata', 1),
(3687, 'configsite/index', 1),
(3688, 'configsite/view', 1),
(3689, 'configsite/add', 1),
(3690, 'configsite/edit', 1),
(3691, 'configsite/delete', 1),
(3692, 'estoqueentradas/index', 1),
(3693, 'estoquemovimentos/index', 1),
(3694, 'estoquesaidas/index', 1),
(3695, 'lojas/index', 1),
(3696, 'lojas/view', 1),
(3697, 'lojas/add', 1),
(3698, 'lojas/edit', 1),
(3699, 'lojas/delete', 1),
(3700, 'produtos/index', 1),
(3701, 'users/index', 1),
(3702, 'caixa/index', 1),
(3703, 'caixa/view', 1),
(3704, 'caixa/add', 1),
(3705, 'caixa/edit', 1),
(3706, 'caixa/delete', 1),
(3707, 'movimentacaofinanceira/index', 1),
(3708, 'movimentacaofinanceira/view', 1),
(3709, 'movimentacaofinanceira/add', 1),
(3710, 'movimentacaofinanceira/edit', 1),
(3711, 'movimentacaofinanceira/delete', 1),
(3712, 'permissions/index', 1),
(3713, 'permissions/view', 1),
(3714, 'permissions/add', 1),
(3715, 'permissions/edit', 1),
(3716, 'permissions/delete', 1),
(3717, 'roles/index', 1),
(3718, 'roles/view', 1),
(3719, 'roles/add', 1),
(3720, 'roles/edit', 1),
(3721, 'roles/delete', 1),
(3722, 'vendas/index', 1),
(3723, 'vendas/view', 1),
(3724, 'vendas/add', 1),
(3725, 'vendas/edit', 1),
(3726, 'vendas/delete', 1),
(3727, 'vendasitens/index', 1),
(3728, 'vendasitens/view', 1),
(3729, 'vendasitens/add', 1),
(3730, 'vendasitens/edit', 1),
(3731, 'vendasitens/delete', 1),
(3732, 'caixa_ativo/index', 1),
(3733, 'resumo/index', 1),
(3734, 'lojas/lojas_view_list', 1),
(3735, 'estoqueentradas/entrada_view_list', 1),
(3736, 'estoquemovimentos/estoque_view', 1),
(3737, 'estoquesaidas/saida_view', 1),
(3738, 'movimentacaofinanceira/financa_view', 1),
(3739, 'caixa/caixa_view', 1),
(3740, 'produtos/produtos_view', 1),
(3741, 'vendas/vendas_view', 1),
(3742, 'users/users_view', 1),
(3743, 'home/index', 2),
(3744, 'account/index', 2),
(3745, 'account/edit', 2),
(3746, 'estoqueentradas/view', 2),
(3747, 'estoqueentradas/add', 2),
(3748, 'estoqueentradas/edit', 2),
(3749, 'estoquesaidas/view', 2),
(3750, 'estoquesaidas/add', 2),
(3751, 'estoquesaidas/edit', 2),
(3752, 'users/view', 2),
(3753, 'estoqueentradas/index', 2),
(3754, 'estoquemovimentos/index', 2),
(3755, 'estoquesaidas/index', 2),
(3756, 'lojas/index', 2),
(3757, 'lojas/view', 2),
(3758, 'produtos/index', 2),
(3759, 'users/index', 2),
(3760, 'vendas/index', 2),
(3761, 'vendas/view', 2),
(3762, 'vendas/add', 2),
(3763, 'vendas/edit', 2),
(3764, 'vendas/delete', 2),
(3765, 'vendasitens/index', 2),
(3766, 'vendasitens/view', 2),
(3767, 'vendasitens/add', 2),
(3768, 'vendasitens/edit', 2),
(3769, 'vendasitens/delete', 2),
(3770, 'caixa_ativo/index', 2),
(3771, 'resumo/index', 2),
(3772, 'lojas/lojas_view_list', 2),
(3773, 'estoqueentradas/entrada_view_list', 2),
(3774, 'estoquemovimentos/estoque_view', 2),
(3775, 'estoquesaidas/saida_view', 2),
(3776, 'movimentacaofinanceira/financa_view', 2),
(3777, 'caixa/caixa_view', 2),
(3778, 'produtos/produtos_view', 2),
(3779, 'vendas/vendas_view', 2),
(3780, 'users/users_view', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantidade` int(11) DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `quantidade`, `foto`, `data_atualizacao`) VALUES
(1, 'Prato Amor', 'Prato de comida normal', 10.00, 60, 'uploads/files/514f0f40-04e6-467d-8ecd-0da9e26a2068.png', '2026-01-16 20:48:56'),
(2, 'Haburgger Bigg', 'Comida Rápida hamburger', 5.00, 141, 'uploads/files/000f7295-8984-4a16-aead-dca02f5502dd.png', '2026-01-16 20:48:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('admin','estoquista','usuario') DEFAULT 'usuario',
  `endereco` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `tel`, `foto`, `password`, `roles`, `endereco`, `data_cadastro`, `user_role_id`) VALUES
(1, 'Admin', 'admin@email.com', '85000000000', NULL, '$2y$10$9seVFEbCzLkirAOHvpt2m.OYrElkipr2I1cSFz.sCT8acaPTCa/py', 'admin', 'Av Sul N 10', '2025-08-29 20:58:38', 1),
(2, 'Func', 'func@email.com', '85677648736', 'uploads/files/07380c05-29f1-4422-98b1-c049624c27e0.png', '$2y$10$tmD.QJqdzBc0YP446FT47u9SzTKKt9ME3sRfJRrPt/kH/IHBi0jgu', 'usuario', NULL, '2025-08-30 17:24:44', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `cliente_nome` varchar(150) DEFAULT 'CONSUMIDOR FINAL',
  `valor_total` decimal(12,2) DEFAULT 0.00,
  `forma_pagamento` enum('dinheiro','cartao','pix','boleto') NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `usuario_id`, `loja_id`, `cliente_nome`, `valor_total`, `forma_pagamento`, `data_venda`) VALUES
(1, 1, 1, '\'CONSUMIDOR FINAL\'', 10.00, 'pix', '2025-08-31 14:53:50'),
(7, 1, 2, '\'CONSUMIDOR FINAL\'', 20.00, 'dinheiro', '2025-08-31 15:43:39'),
(8, 1, 1, '\'CONSUMIDOR FINAL\'', 25.00, 'boleto', '2025-08-31 16:04:03'),
(9, 1, 1, '\'CONSUMIDOR FINAL\'', 30.00, 'pix', '2025-08-31 22:33:21'),
(10, 1, 2, '\'CONSUMIDOR FINAL\'', 45.00, 'pix', '2025-09-01 15:22:24'),
(11, 1, 2, '\'CONSUMIDOR FINAL\'', 45.00, 'pix', '2025-09-01 15:25:56'),
(12, 1, 1, '\'CONSUMIDOR FINAL\'', 20.00, 'pix', '2025-09-01 17:52:01'),
(13, 1, 1, '\'CONSUMIDOR FINAL\'', 20.00, 'pix', '2025-09-01 17:52:18'),
(14, 1, 1, '\'CONSUMIDOR FINAL\'', 20.00, 'cartao', '2025-09-01 17:59:46'),
(15, 1, 1, '\'CONSUMIDOR FINAL\'', 55.00, 'pix', '2025-09-01 18:05:46'),
(16, 2, 2, '\'CONSUMIDOR FINAL\'', 55.00, 'pix', '2025-09-01 18:10:00'),
(17, 2, 1, '\'CONSUMIDOR FINAL\'', 10.00, 'cartao', '2025-09-01 18:24:01'),
(18, 1, 1, '\'CONSUMIDOR FINAL\'', 35.00, 'cartao', '2026-01-16 20:48:55');

--
-- Acionadores `vendas`
--
DELIMITER $$
CREATE TRIGGER `trg_venda_caixa` AFTER INSERT ON `vendas` FOR EACH ROW BEGIN
    DECLARE novoMovId INT;

    -- cria movimentação financeira correspondente
    INSERT INTO movimentacao_financeira
        (produto_id, tipo_movimentacao, quantidade, valor_unitario, usuario_id, loja_origem_id, observacao)
    VALUES
        (1, 'venda', 1, NEW.valor_total, NEW.usuario_id, NEW.loja_id, CONCAT('Venda nº ', NEW.id));

    -- pega o ID da movimentação recém-criada
    SET novoMovId = LAST_INSERT_ID();

    -- registra no caixa com referência correta
    INSERT INTO caixa (movimentacao_id, tipo, valor, descricao)
    VALUES (novoMovId, 'entrada', NEW.valor_total, CONCAT('Venda nº ', NEW.id, ' - ', NEW.forma_pagamento));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_itens`
--

CREATE TABLE `vendas_itens` (
  `id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas_itens`
--

INSERT INTO `vendas_itens` (`id`, `venda_id`, `produto_id`, `quantidade`, `valor_unitario`, `subtotal`) VALUES
(1, 7, 2, 2, 10.00, 20.00),
(2, 8, 2, 5, 5.00, 25.00),
(3, 9, 2, 3, 5.00, 15.00),
(4, 9, 1, 1, 15.00, 15.00),
(5, 11, 2, 3, 5.00, 15.00),
(6, 11, 1, 2, 15.00, 30.00),
(7, 13, 2, 4, 5.00, 20.00),
(8, 14, 2, 4, 5.00, 20.00),
(9, 15, 2, 5, 5.00, 25.00),
(10, 15, 1, 3, 10.00, 30.00),
(11, 16, 2, 7, 5.00, 35.00),
(12, 16, 1, 1, 10.00, 10.00),
(13, 16, 1, 1, 10.00, 10.00),
(14, 17, 2, 2, 5.00, 10.00),
(15, 18, 2, 2, 10.00, 20.00),
(16, 18, 1, 1, 5.00, 5.00),
(17, 18, 2, 2, 5.00, 10.00);

--
-- Acionadores `vendas_itens`
--
DELIMITER $$
CREATE TRIGGER `trg_venda_item` AFTER INSERT ON `vendas_itens` FOR EACH ROW BEGIN
    -- Declara variáveis primeiro
    DECLARE total_venda DECIMAL(12,2);

    -- Atualiza o estoque
    UPDATE produtos
    SET quantidade = quantidade - NEW.quantidade
    WHERE id = NEW.produto_id;

    -- Calcula o total da venda
    SELECT SUM(subtotal)
    INTO total_venda
    FROM vendas_itens
    WHERE venda_id = NEW.venda_id;

    -- Atualiza o valor total da venda
    UPDATE vendas
    SET valor_total = total_venda
    WHERE id = NEW.venda_id;
END
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caixa_movfinance` (`movimentacao_id`);

--
-- Índices de tabela `config_site`
--
ALTER TABLE `config_site`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `estoque_entradas`
--
ALTER TABLE `estoque_entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `fk_entrada_loja_origem` (`loja_origem_id`),
  ADD KEY `fk_entrada_loja_destino` (`loja_destino_id`);

--
-- Índices de tabela `estoque_movimentos`
--
ALTER TABLE `estoque_movimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `fk_mov_loja_origem` (`loja_origem_id`),
  ADD KEY `fk_mov_loja_destino` (`loja_destino_id`);

--
-- Índices de tabela `estoque_saidas`
--
ALTER TABLE `estoque_saidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `fk_saida_loja_origem` (`loja_origem_id`),
  ADD KEY `fk_saida_loja_destino` (`loja_destino_id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movimentacao_financeira`
--
ALTER TABLE `movimentacao_financeira`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movfinance_produto` (`produto_id`),
  ADD KEY `fk_movfinance_usuario` (`usuario_id`),
  ADD KEY `fk_movfinance_loja_origem` (`loja_origem_id`),
  ADD KEY `fk_movfinance_loja_destino` (`loja_destino_id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `loja_id` (`loja_id`);

--
-- Índices de tabela `vendas_itens`
--
ALTER TABLE `vendas_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_id` (`venda_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `config_site`
--
ALTER TABLE `config_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `estoque_entradas`
--
ALTER TABLE `estoque_entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estoque_movimentos`
--
ALTER TABLE `estoque_movimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `estoque_saidas`
--
ALTER TABLE `estoque_saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `movimentacao_financeira`
--
ALTER TABLE `movimentacao_financeira`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3781;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `vendas_itens`
--
ALTER TABLE `vendas_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `caixa`
--
ALTER TABLE `caixa`
  ADD CONSTRAINT `fk_caixa_movfinance` FOREIGN KEY (`movimentacao_id`) REFERENCES `movimentacao_financeira` (`id`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `estoque_entradas`
--
ALTER TABLE `estoque_entradas`
  ADD CONSTRAINT `estoque_entradas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `estoque_entradas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_entrada_loja_destino` FOREIGN KEY (`loja_destino_id`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `fk_entrada_loja_origem` FOREIGN KEY (`loja_origem_id`) REFERENCES `lojas` (`id`);

--
-- Restrições para tabelas `estoque_movimentos`
--
ALTER TABLE `estoque_movimentos`
  ADD CONSTRAINT `estoque_movimentos_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `estoque_movimentos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_mov_loja_destino` FOREIGN KEY (`loja_destino_id`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `fk_mov_loja_origem` FOREIGN KEY (`loja_origem_id`) REFERENCES `lojas` (`id`);

--
-- Restrições para tabelas `estoque_saidas`
--
ALTER TABLE `estoque_saidas`
  ADD CONSTRAINT `estoque_saidas_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `estoque_saidas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_saida_loja_destino` FOREIGN KEY (`loja_destino_id`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `fk_saida_loja_origem` FOREIGN KEY (`loja_origem_id`) REFERENCES `lojas` (`id`);

--
-- Restrições para tabelas `movimentacao_financeira`
--
ALTER TABLE `movimentacao_financeira`
  ADD CONSTRAINT `fk_movfinance_loja_destino` FOREIGN KEY (`loja_destino_id`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `fk_movfinance_loja_origem` FOREIGN KEY (`loja_origem_id`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `fk_movfinance_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `fk_movfinance_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`loja_id`) REFERENCES `lojas` (`id`);

--
-- Restrições para tabelas `vendas_itens`
--
ALTER TABLE `vendas_itens`
  ADD CONSTRAINT `vendas_itens_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendas_itens_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
