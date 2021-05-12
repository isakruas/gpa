<?php
 

$host_check = array(

	'127.0.0.1',

    '::1',

    'localhost'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $host_check)) {
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'ogerai81_user');
	define('DB_PASSWORD', '97hC%02Mbkq');
	define('DB', 'ogerai81_astrofotografia');

} else {

	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '235711');
	define('DB', 'gqa');
}

?>