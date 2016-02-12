<?php

function baseUrl() {

    $fallback = Config::get('app.fallback_locale');

    $lang = App::getLocale();

    $locale = ($lang == $fallback ? '' : '/' . $lang);

    return url() . $locale;
}

// 30x 29 x 43
function convertToInches($data) {

    $string = preg_replace('/\s+/', '', $data);

    $string = strtolower($string);

    $numbers = explode('x', $string);

    if(count($numbers) != 3) return 'Invalid size';

    $n = array();

    foreach($numbers as $num) {

        $num = $num * 0.39;

        $n[] = number_format($num, 1);
    }

    return $n[0] . ' x ' . $n[1] . ' x ' . $n[2];
}

function humanize($value) {

    if($value > 1000000000) {

        $head = $value / 1000000000;

        $head = number_format((float)$head, 1, '.', '');

        return $head . 'b';

    } elseif($value > 1000000) {

        $head = $value / 1000000;

        $head = number_format((float)$head, 1, '.', '');

        return $head . 'm';

    } elseif($value > 1000) {

        $head = $value / 1000;

        $head = number_format((float)$head, 1, '.', '');

        return $head . 'k';

    } else {

        return $value;
    }
}

function social() {

    return json_decode(File::get(storage_path('json/social_accounts.json')));
}

function currency($cur) {

    return json_decode(File::get(storage_path('json/conversion.json')));
}

function renderCategory($categories, $count = 0)
{
    $space = '';

    $t = $count;

    for ($i=0; $i< $t; $i++) {
        $space .= '&nbsp;&nbsp;&nbsp;&nbsp;';
    }

    foreach ($categories as $category) {

        if ($category->parent) {
            if ($category->id == $category->parent->id) break;
        }

        echo '<m-option value="' . $category->id .'">'. $space . $category->name() .'</m-option>';

        if ($category->childs) {

            renderCategory($category->childs, ++$count);

        }

    }
}

function rootCategory($category)
{
    if ($category->parent) rootCategory($category->parent);
    else return $category;
}

function propertyStatus($status) {

    switch ($status) {
        case -2:
            return 'MODERATION';
        case -1:
            return 'HIDDEN';
        case 0:
            return 'UNAVAILABLE';
        case 1:
            return 'AVAILABLE';
        
        default:
            return 'UNAVAILABLE';
    }

}

function statusToInteger($status) {

    switch ($status) {
        case 'request':
            return -2;
        case 'hidden':
            return -1;
        case 'unavailable':
            return 0;
        case 'available':
            return 1;
        
        default:
            return 0;
    }

}

