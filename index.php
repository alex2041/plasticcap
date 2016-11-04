<?php
/* Пути по-умолчанию для поиска файлов */
set_include_path(get_include_path()
					.PATH_SEPARATOR.'app/controllers'
					.PATH_SEPARATOR.'app/models'
					.PATH_SEPARATOR.'app/views');

/* Имена файлов: views */
define('DEFAULT_FILE', '_default.php');
define('CAPS', 'caps.php');
define('BLOG', 'blog.php');
define('POST', 'post.php');
define('LINK', 'link.php');

/* Автозагрузчик классов */
function __autoload($class){
	require_once($class.'.php');
}

/* Инициализация и запуск FrontController */
$front = FrontController::getInstance();
$front->route();

/* Вывод данных */
echo $front->getBody();