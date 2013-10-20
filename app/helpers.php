<?php

function array_until($stopPoint, $arr)
{
    $index = array_search($stopPoint, $arr);

    if ($index === false) {
        throw new InvalidArgumentException('Invalid parameter specified.');
    }

    return array_slice($arr, 0, $index);
}

function my_link_to($url, $body, $parameters = null) {
    $url = url($url);

    $attributes = $parameters ? HTML::attributes($parameters) : '';

    return "<a href='{$url}'{$attributes}>{$body}</a>";
}