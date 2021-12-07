<?php

if (!function_exists('menu')) {
    /**
     * @param $menus
     * @param $parent
     * @return void
     */
    function menu($menus, $parent = null)
    {
        echo '<ol class="dd-list">';
        foreach ($menus as $menu) {
            if ($menu->parent == $parent) {
                echo '<li class="dd-item" data-id="' . $menu->pages_id . '" id="menu-' . $menu->pages_id . '">
                                <div class="dd-handle">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>' . $menu->pages->title . '</span>
                                        <div class="dd-nodrag btn-group float-right">
                               <button class="removeFromMenu btn btn-danger btn-sm" onclick="removeFromMenu(\'';
                echo $menu->pages_id . '\',\''.$menu->urlType;
                               echo '\')" data-id="" data-type="" type="button"><i class="fas fa-trash"></i></button>
                              </div>
                                    </div>
                                </div>';
                menu($menus, $menu->pages_id);
                echo '</li>';
            }
        }
        echo '</ol>';
    }
}