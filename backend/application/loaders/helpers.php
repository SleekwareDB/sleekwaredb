<?php
defined('BASEPATH') or exit('No direct script access allowed');

$predefine_helpers = ['url', 'html', 'form', 'cookie'];

// DO NOT DELETE OR EDIT THIS LINE
if (!function_exists('getdirContents')) {
    function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != ".." && $value != "index.html"
            ) {
                getDirContents($path, $results);
                $results[] = $path;
            }
        }

        $results = array_filter($results, function ($v) {
            return !is_dir($v) === true && strpos($v, 'index.html') === false;
        });

        $results = array_map(function ($v) {
            return str_replace(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR, '', $v);
        }, $results);

        return $results;
    }
}

if (!function_exists('helper_loader')) {
    function helper_loader(array $predefine_helpers)
    {
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR;
        $listOfHelpers = getDirContents($path);
        $helpers = [];
        foreach ($listOfHelpers as $lib) {
            $splitter = explode('/', $lib);
            $filename = end($splitter);
            $library = strtolower(str_replace('_helper.php', '', $filename));
            array_push($helpers, $library);
        }
        return array_merge($predefine_helpers, $helpers);
    }
}
$data = helper_loader($predefine_helpers);
return $data;
// DO NOT DELETE OR EDIT THIS LINE
