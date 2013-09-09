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


include_once __DIR__.DIRECTORY_SEPARATOR.'FormField.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'FormType.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'Interfaces/FormManagerInterface.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'Interfaces/FormRendererInterface.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'FormBuilder.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'FormOptionsManager.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'AdminFormRenderer.php';

