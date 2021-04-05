<?php

// Html::tabs() => Generate the tab system
// Stub function => macro_tabs_stub_li();
// Stub function => macro_tabs_stub_container();

/**
 * Generate the tab system
 *
 * @param array $items
 * @param string $li [Default value]
 * @param string $container [Default value]
 * @param integer $orden [The bucle index]
 * @return string
 */
Html::macro('tabs', function(array $items, $li = '', $container = '', $orden = 0, $javascript = '')
{
    foreach($items as $item) {

        if($item['show']) {

            //Set the item id
            $id = md5($item['title']);

            //Tab status
            $action = ($orden === 0) ? ['active', 'show'] : ['', ''];

            //Generate the <li> fields
            $li .= sprintf(macro_tabs_stub_li(), $action[0], $id, 'link-' . $id, $item['title']);

            //Generate the <container> field
            $container .= sprintf(macro_tabs_stub_container(), $action[0], $action[1], $id, $item['content']);
        }

        $orden++;
    }

    return sprintf('<ul class="nav nav-tabs" id="tab-container">%s</ul><div class="tab-content" id="tabs">%s</div>', $li, $container);
});

/**
 * Macro tab stub: li
 *
 * @return string
 */
if (!function_exists('macro_tabs_stub_li')) {
    function macro_tabs_stub_li()
    {
        return
            '<li class="nav-item">' .
                '<a class="nav-link nav-tab-item %s" data-toggle="tab" href="#%s" id="%s" aria-expanded="true">%s</a>' .
            '</li>';
    }
}

/**
 * Macro tab stub: li
 *
 * @return string
 */
if (!function_exists('macro_tabs_stub_container')) {
    function macro_tabs_stub_container()
    {
        return
            '<div class="tab-pane fade %s %s p-3" id="%s" aria-expanded="true">' .
                '%s' .
            '</div>';
    }
}
