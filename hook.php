<?php

$yiiPath = 'path_to_yii_framework';
$assetsPath = 'path_to_assets_folder';

require_once('inc.php');
header('Content-Type: text/plain');
if (file_exists('key.php'))
{
    $key = require('key.php');
    if ($key['current'] === $_SERVER['QUERY_STRING'])
    {
        // Let's assume this script is on root directory of the project
        _exec('pwd');
        _exec('git pull');
        _exec('git submodule update');

        // Run migrations
        _exec($yiiPath . '/yiic migrate --interactive=0');

        // Clean up assets
        _exec('/bin/rm -rf ' . $assetsPath);
        mkdir($assetsPath);
    }
}

_log(var_export($_POST, true));

