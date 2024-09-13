<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'dbname' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'user' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'password' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9F{%53F7]>:ei6z%d>IBx+@` nQ6d}Z(k;=B^f-U]A}eo,l1FTH+*N4h3RG_}+U+' );
define( 'SECURE_AUTH_KEY',  '1B{p4/^L#(Uw}mv6A7U>nX34]JS2$+DUR bdJ(In2He7 ;Sa3:9HoY7Bp?CH;j7Y' );
define( 'LOGGED_IN_KEY',    'iH$3y@mQ, ^&@mD%k/lnr#,(nLMJ=rX<acXAhtPUAh qgpgw(]m/xiv}jepyD~D7' );
define( 'NONCE_KEY',        'Avde- a/4?_!=R0xnoDqTRle4$QriI,=]m#[Mnhgd[chaYd{;9HH>V.yOIL`4~V&' );
define( 'AUTH_SALT',        '_vX6l6,W?vSKBw1TlXp/.T`7z:VR e?5a2M-9&-hk-@h.kD8b?%g/-{w@4RKe ot' );
define( 'SECURE_AUTH_SALT', 'VvT-3y/r^}f7[P(b/6hN2dncsyZtA</_<lvc,zU^<hmwbf-F*5WS^.>Gi7o-PiUs' );
define( 'LOGGED_IN_SALT',   '#7fIk&qI{Md;)LN(AkIT;nR2?yTJxZ-n#P^X*YM12&@Wcw76vvQ(2ykRyjLM|TD/' );
define( 'NONCE_SALT',       'Z)Q$5txQKt ns[Lb]G(ZPI^]2h}/ha/38XPqSr~9X_ZYp98;$s8(v#85)VZfa*X0' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
