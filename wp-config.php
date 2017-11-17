<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'riviera');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'aQ4Eo/%UmDt!Fr:%i-{p^?XLp*x_QefQ?unnH4-#|K|3M[j~u(x^{[w?G_xD$c0!');
define('SECURE_AUTH_KEY',  'c$34dFU,:_%&)VkT/wRdP?fI-j!$=szYfa_9&&#L.V#iy&fAd5wkbO2T(iOFHWfF');
define('LOGGED_IN_KEY',    'u9j&=;~c+?ci7/0ud2YdPP]swsZ5EHT4<cARd_nzU<Jq:(:xjiBE*fb-epolwF!M');
define('NONCE_KEY',        '0^&ZGWyFqDPNSo09BMQ8MTbOoP>n?fq*,bF[EZlxxt(gH#bJyr%+IKaFxV4{<*]x');
define('AUTH_SALT',        '%hpm##h*lvpj:a=/}JMJ})yRY^.[j)uIX3*pBf&Q[(,PbL-$#9{[R43hYb@bKXPv');
define('SECURE_AUTH_SALT', 'D)`YnUyG7<n}HIgjd.iNGMeVydSLFwNh5SN>.ceHY!o#Ozzw%A^rK+k+WdUW9bS:');
define('LOGGED_IN_SALT',   '%Ql9Xr2Iewb`t(VTd,_ywq+?1OrWn|-t&WlSeZNWNAg#vi)]%8aHxSeg>u&2xY1u');
define('NONCE_SALT',       'YswRN?:+<O)lKP~>Vp$oT/VzOof 5PFNrLzlV|Siu{H,8`vPDSiH5,~HHB#l-#~{');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'riviera_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
