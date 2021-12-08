<?php

if (!function_exists('navigationWidget')) {
    function navigationWidget($navigation)
    {
        function navigation($navigation, $uri, $child = null)
        {
            foreach ($navigation as $nav) :
                $p = null;
                foreach ($navigation as $item) {
                    if ($item->sefLink != 'profile' && $item->sefLink === $uri)
                        $p = $item;
                }
                if ($nav->parent_pk == $child) : ?>
                    <li class="nav-item <?= (!empty($p) && $p->parent_pk == $nav->_id) ? 'menu-is-opening menu-open' : '' ?>">
                        <a href="<?php
                        $u = explode('/', $nav->sefLink);
                        if (empty($u[1]))
                            echo route_to($u[0]);
                        else
                            echo route_to($u[0], $u[1]); ?>"
                           class="nav-link <?php if (!empty($p)) {
                               if ($nav->sefLink == $uri || $p->parent_pk == $nav->_id) echo 'active'; else echo '';
                           } ?>">
                            <i class="nav-icon <?= $nav->symbol ?>"></i>
                            <p><?= lang('Backend.' . $nav->pagename) ?><?= ($nav->hasChild == true) ? '<i class="right fas fa-angle-left"></i>' : '' ?></p>
                        </a>
                        <?php if ($nav->hasChild == true): ?>
                            <ul class="nav nav-treeview">
                                <?php navigation($navigation, $uri, $nav->_id); ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endif;
            endforeach;
        }

        return navigation($navigation, $uri);
    }
}