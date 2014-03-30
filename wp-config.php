<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'corefit1_wor3');

/** MySQL database username */
define('DB_USER', 'corefit1_226');

/** MySQL database password */
define('DB_PASSWORD', '5sb6U1K0');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'dAnH=(ym)AW[U$Y%W&>wUSCeu}}P{SFdd-Q[TF|OFIdPreNYu/k}+X/q|T&{Rp-y=P*g{dOP/uJCsT$dx+SKzBROPdn)E?!h;LAMLPBDPJ_/)LbeXX}]&i+uqnBX)e_%');
define('SECURE_AUTH_KEY', '|ug)e-TRu<@jwF}F{%c!o@fT-aVAjlUVVYG!^d-S!r-x*H|c>Fv@r<VK=L/k<nZkuJJu?lsj}A[s]VID&TwVhND<lcfqS;$GYGc)azgsC&MuPdZjQYZ>$DzugrrVEV))');
define('LOGGED_IN_KEY', 'h)%?ftX<b+[KF}RwNE)oMWTVuyoBWCYY+vuq;BNOj/!tO<_zoN([|-Ey%JT>*Z;<op@lwD!@%Aj?ssZ$)BkP=v[]BQ)sS=NYrB<h_*fr-szpn^]DAq/x}iR/DX;<<Itl');
define('NONCE_KEY', 'k)/?MC=uFYp/lVIarC^J>YyvaJIO[xN&E}crNj)}ytn*HKX$=!MlXe*xtGYR;Bi_a}F&O)?W[]CG>lDaOR+ax?_@Bq_cTjQ[(%|Nud!Y=BWGsi^{q+r}blaDEIohhU/R');
define('AUTH_SALT', 'd<%pkrfR!(l[*P[?N<cCyS%dx@UgeDq[}z%zalMQ>H(PvWn!Kr(v>u?ALjm+nmlM|a(FJ@M+r!zlvN|oov/gbIVx&*(y+?bn[OwHEHyv!zXB/Tl!XYTBifS>n(Rv<%ov');
define('SECURE_AUTH_SALT', '|^fncPRc)ds;cH>X;-wRDjSxEkk{CJhES/mHB<q+Ul!aQ/GQArg%Z=D@n+Y+bsmKXSZHHM)WpwxSIQGf]ALeYr&=wsLX@N&yh+P>vnobmmC-fA]t?=MD_k!pcmH(<@sB');
define('LOGGED_IN_SALT', 'xdguzdGf%s&gIDd/Y!<Jrc[$odVSG_OH*Tye}jv[k=dHv>znbN?xdHG/v(<H@(d&?@>t[CiWko+l@Sm&wR*$drq}*blL]yZYvAtzvHDG$C?aZ_LgPhQn;;)_-AeeFiNz');
define('NONCE_SALT', 'hkbfJN<cM-w-%[-NZP(DQJ;F^[b/(VtUmUzDoc(^UqvPNl[<CoeQYs$RhW[VXUpgIy<;o>IMW)f&Vsl?L^saz/rUujUZU%/QFGSZhhi=?mzhU*lE|+eltMg*FEI<_/X=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_buit_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
