<?php

if (!function_exists('_printR')) {
    function _printR($data, string $title = "", bool $vardump = false)
    {
        echo "<strong>" . $title . "</strong><br><pre>";
        if ($vardump==true)
            print_r(var_dump($data));
        else
            print_r($data);
        echo "</pre>";
    }
}

if (!function_exists('_printRdie')) {
    function _printRdie($data, string $title = "", bool $vardump = false)
    {
        echo "<strong>" . $title . "</strong><br><pre>";
        if ($vardump==true)
            print_r(var_dump($data));
        else
            print_r($data);
            echo "</pre>";
        die();
    }
}
