<?php

function baseUrl() {

    $fallback = Config::get('app.fallback_locale');

    $lang = App::getLocale();

    $locale = ($lang == $fallback ? '' : '/' . $lang);

    return url() . $locale;
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

    $currencies = json_decode(File::get(storage_path('json/conversion.json')), true);

    return $currencies[$cur];
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

function checkWishlist($id, $property_id) {

    $count = \App\WishList::where('customer_id', $id)
        ->where('property_id', $property_id)
        ->count();

    return $count > 0 ? true : false;
}

function convertCurrency($amount, $cur, $target) {

    $cur = strtolower($cur);

    $target = strtolower($target);

    if($cur == $target) return number_format($amount);

    $targetAmount = $amount / currency($cur);

    return number_format($targetAmount);
}

