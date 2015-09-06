<?php

/**
 * @package       EndlessMonitor
 * @version       1.0
 * @author        OsipXD
 * @copyright (c) 2015, Osip Fatkullin. All Rights Reserved.
 * @link          http://endlesscode.ru/
 * @license       GNU/GPLv2
 */
if (!filter_input(INPUT_GET, 'server', FILTER_SANITIZE_STRING)) {
    die(' Empty params! ');
}

define('_EMRUN', true);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__) . DS);

require_once(ROOT . 'helpers/include.php');
defined('_HINC') or die(' System files are missing! ');

$server = filter_input(INPUT_GET, 'server', FILTER_SANITIZE_STRING);
$tmploptions = '';

if (filter_input(INPUT_GET, 'to', FILTER_SANITIZE_STRING)) {
    $tmploptions = filter_input(INPUT_GET, 'to', FILTER_SANITIZE_STRING);
}

if (filter_input(INPUT_GET, 'demo', FILTER_VALIDATE_BOOLEAN)) {
    $info = System::getDemoInfo($server);
    include(ROOT . 'tmpl/default.php');
    die;
}

if (!file_exists('config.ini.php')) {
    echo(' Configuration doesn\'t exists. ');
    die;
}
$info = System::getInfo(System::secureId($server));

/** @noinspection PhpIncludeInspection */
include(ROOT . 'tmpl/' . Config::get('system.template') . '.php');
