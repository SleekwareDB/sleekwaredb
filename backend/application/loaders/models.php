<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('getdirContents')) {
    function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != ".." && $value != "index.html") {
                getDirContents($path, $results);
                $results[] = $path;
            }
        }

        $results = array_filter($results, function ($v) {
            return !is_dir($v) === true && strpos($v, 'index.html') === false;
        });

        $results = array_map(function ($v) {
            return str_replace(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR, '', $v);
        }, $results);

        return $results;
    }
}

$modelDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR;
$listOfFiles = getdirContents($modelDir);
$aliases = [];
$models = [];

foreach ($listOfFiles as $file) {
    $alias = strtolower(str_replace('_model.php', '', $file));
    $model = strtolower(str_replace('.php', '', $file));
    if ( strpos($file, 'core/') !== false ) {
        $pathArray = explode('/', $file);
        $alias = strtolower(str_replace('_model.php', '', end($pathArray)));
        array_push($aliases, "core_".$alias);
    } else {
        array_push($aliases, $alias);
    }
    array_push($models, $model);
}

$modelLoader = array_combine($models, $aliases);
$loader = $modelLoader;

return $loader;

