<?php

// Html::dropdown() => Generate the menu dropdown link with active status

/**
 * Generate the menu dropdown link with active status
 *
 * @return string
 */
Html::macro('dropdown', function($text, $active = false)
{
    $active = $active ? ' active' : '';

    return sprintf('<a class="nav-link app-nav__item dropdown-toggle%s" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">%s</a>',
        $active,
        $text
    );
});
