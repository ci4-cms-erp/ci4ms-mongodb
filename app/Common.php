<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

if (!function_exists('clearFilter')) {
    function clearFilter($array)
    {
        $clear = array_filter(
            $array, function ($value) {
            return $value !== '';
        }
        );

        return array_filter(
            $clear, function ($value) {
            return $value !== null;
        }
        );
    }
}

if(!function_exists('show_404')) {
    function show_404()
    {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}
