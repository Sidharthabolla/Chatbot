<?php

define('MYSQL_USER', 'siddu');
define('MYSQL_PASS', 'test_server');
define('MYSQL_HOST', 'localhost');
define('MYSQL_DB', 'Questionnaire');

$GLOBALS['dbh_mysql'] = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS);
