<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'portfolio' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost:3307' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',,B~Orm[C`pb.f=g=Cb<#tBJTsi{:LT4MDn:5PJKRyW[n{=-)?V,OO`w4Ndl)A C' );
define( 'SECURE_AUTH_KEY',  'ZAT].IwJ_n)%Dt;kw=sWuK+r3@[o!%K+ bL^/*bKm=WL.TsOC e|~cF^&NKtnnGx' );
define( 'LOGGED_IN_KEY',    ',hfv2rZ#4z{<B8*#|!6:(PFO$Y]YZw/qNFI$Yw^u.HU :`7Eo}t.$|L/~mD3Xkef' );
define( 'NONCE_KEY',        'QW[,!Z%.NN77H`opKkZ?W&GVm@6w}%E,}QU. p#B{*tGw*Kw;.f$H{;uTDkxR~vY' );
define( 'AUTH_SALT',        '=$8tP?ZFs $nC`E>f] +-a9Ulk|0#)&Yqh;`K%.,w,Cci9aD781DO(R]dtTyVeH8' );
define( 'SECURE_AUTH_SALT', 'OPBUJd9N-eT?A~q.q7,x}:16n-=0qyG*5d#;u3Vx7e&1%J/{cnEl0Zf!$3x9jBNW' );
define( 'LOGGED_IN_SALT',   'uxQ0of5jt0yk<D7X/U)IV|0hqP&]dLss_[;LNj7#y9Gbq2U,(b+eiX/q*k+(:Y!2' );
define( 'NONCE_SALT',       ']B&]E<Emqa*+WjK/>/Ivr Rs/x|iYYvl(;<^B<:]$OrDu_2dUrVNC740b7F@vBSw' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
