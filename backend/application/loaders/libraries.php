<?php
defined('BASEPATH') or exit('No direct script access allowed');

$predefine_libraries = ['session', 'user_agent', 'encryption'];

// DO NOT DELETE OR EDIT THIS LINE
if (!function_exists('getDirContents')) {
    function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if (
                $value != "." && $value != ".." && $value != "index.html"
            ) {
                getDirContents($path, $results);
                $results[] = $path;
            }
        }

        $results = array_filter($results, function ($v) {
            return !is_dir($v) === true && strpos($v, 'index.html') === false;
        });

        $results = array_map(function ($v) {
            return str_replace(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR, '', $v);
        }, $results);

        return $results;
    }
}

if (!function_exists('library_loader')) {
    function library_loader(array $predefine_libraries)
    {
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR;
        $listOfLibraries = getDirContents($path);
        $libraries = [];
        foreach ($listOfLibraries as $lib) {
            $splitter = explode('/', $lib);
            $filename = end($splitter);
            $library = strtolower(str_replace('.php', '', $filename));
            array_push($libraries, $library);
        }
        return array_merge($predefine_libraries, $libraries);
    }
}
$data = library_loader($predefine_libraries);
return $data;
// DO NOT DELETE OR EDIT THIS LINE

