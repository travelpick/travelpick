<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'travel2u_germes');

/** Имя пользователя MySQL */
define('DB_USER', 'travel2u_germes');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '123');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '(HT@=[b633{psBgrnA*9QK1yVXXvw4`~:Bi@KX{Otl(EU:P>(K90s77BP1+N!q|`');
define('SECURE_AUTH_KEY',  'jK_7]k-=Sy[qFZ4?iGx`BDOQh(+5;H<q=v%bEX;1aG4Q%)$lq** TK/<6WS]~AAK');
define('LOGGED_IN_KEY',    'jtg=#iFg$RqU1h8n5ILi!7u]zm<p15d<=1f96G%qyqD-~|ofg+xP;@ppI(o=|RL<');
define('NONCE_KEY',        'R=|^dOaL-Q0q>~vLQfI;1$MQY#1u8sq:MIROvg#QwJiH|n-k2szIK0<z0L09Pn<=');
define('AUTH_SALT',        'M>e=j`b,r:^?7t?<;j5|.!$HMR!bpW|LLYRRx&#$R1=@IzGUMaBGra?!PMNo@}o{');
define('SECURE_AUTH_SALT', 'O5?~C<Q}4 r,wZzsGHQM].[Saskux%WMVa4,E4?=)%FP^4*>,`+WqQBU,zM#Sqxt');
define('LOGGED_IN_SALT',   '`OF As5jxBITP9}@+]G<Tw0mt]:rFbH~dJ0fdz^T`&r4=$8btybJ~Y3v?@bMq|*3');
define('NONCE_SALT',       'Ok=1i=F.=XxEF=hc.k0MG8R_2cOQJ$q_@8SyM]:SRvqaT$NO3wSnj1O.5]7+DG=v');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'tp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
