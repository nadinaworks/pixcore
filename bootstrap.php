<?php
function load_all_files($directory)
{
    foreach (scandir($directory) as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        if (is_dir($directory . DIRECTORY_SEPARATOR . $file)) {
            load_all_files($directory . DIRECTORY_SEPARATOR . $file);
        } else {

            echo $directory . DIRECTORY_SEPARATOR . $file;
            require_once $directory . DIRECTORY_SEPARATOR . $file;
        }
    }
}

include_once __DIR__ . DIRECTORY_SEPARATOR . 'PixCorePixCoreFormField.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'Interfaces/PixCoreFormManagerInterface.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'Interfaces/PixCoreFormRendererInterface.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'PixCoreFormBuilder.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'PixCoreFormOptionsManager.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'AdminPixCoreFormRenderer.php';

