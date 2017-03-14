<?php
// set a constant that holds the project's folder path, like "/var/www/html/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// Another for within the Application folder.
define('APP', ROOT . 'Application' . DIRECTORY_SEPARATOR);
//Below could probably be removed, but if I reuse this at work I'll need them in.
if (PHP_VERSION_ID < 50400) {
    // Add features that were introduced in PHP 5.4
    if (!function_exists('http_response_code')) {
        function http_response_code($reponse_code = null) {
            return http_response_code::httpResponseCode($reponse_code);
        }
    }
    if (!function_exists('getimagesizefromstring')) { // Used in PDF report generator
        function getimagesizefromstring($data, &$imageinfo = array()) {
            $uri = 'data://application/octet-stream;base64,' . base64_encode($data);
            return getimagesize($uri, $imageinfo);
        }

    }
}
