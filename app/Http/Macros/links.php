<?php

// Html::urlToPrint() => Generate the url for print a pdf
// Html::urlToCreate() => Generate the url for create item (Is an alias of the helper route_for_tools())
// Html::urlToCreateWithKey() => Generate the url for create item with params (I think this macro is redundant...)
// Html::urlToEdit() => Generate the url for edit an item (Is an alias of the helper route_for_tools())
// Html::urlToOption() => Generate the url for options (Is an alias of the helper route_for_tools())

/**
 * Generate the url for print a pdf
 *
 * @param  string $section
 * @return string
 */
Html::macro('urlToPrint', function($section)
{
    //Select the url form tools or regular
    $route = route_for_tools('pdf', $section);
    $title = '&p_title=' . urlencode(trans_title($section, 'plural'));
    $description = '&p_description=' . urlencode(trans_description($section));

    return $route . url_params() . $title . $description;
});

/**
 * Generate the url for create item
 *
 * @param  object $section
 * @return string
 */
Html::macro('urlToCreate', function($section)
{
    return route_for_tools('create', $section);
});

/**
 * Generate the url for create item with params
 *
 * @param  object $section
 * @return string
 */
Html::macro('urlToCreateWithKey', function($section, $key)
{
    return route('dashboard.tools.' . $section . '.create', ['_key' => $key]);
});

/**
 * Generate the url for edit an item
 *
 * @param  string $section
 * @return string
 */
Html::macro('urlToEdit', function($section)
{
    return route_for_tools('edit', $section);
});

/**
 * Generate the url for options
 *
 * @param  string $section
 * @return string
 */
Html::macro('urlToOption', function($section)
{
    return route_for_tools('option', $section);
});
