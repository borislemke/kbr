<?php

// Set navbar for each user role_id
if ($admin->role_id == 3) {
    $navigation = Config::get('navbaragent');
} else {
    $navigation = Config::get('navbar');
}

$first = TRUE;

$link = str_replace(url('/admin') . '/', '', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

$link = strtok($link, '?');

function childIsActive($children, $link) {

    foreach($children as $child => $c) {

        if($child == $link) echo ' active';
    }
}

?>

<ul id="navbar-main" class="flexbox">

    <?php foreach($navigation as $nav => $navlinks): ?>
    <li class="navbar-main-item"><a href class="navbar-main-link<?php childIsActive($navlinks, $link) ?>"><?= str_replace('_', ' ', $nav) ?></a></li>
    <?php $first = FALSE; endforeach ?>
</ul>

<div id="navbar-wrapper">

    <?php foreach($navigation as $nav => $navlinks): ?>
    <ul class="navbar-ul flexbox <?php childIsActive($navlinks, $link) ?>">
        <?php foreach($navlinks as $linkUrl => $linkName): ?>
        <li class="navbar-item"><a class="<?= $linkUrl == $link ? 'active' :''; ?>" href="{{ URL::to('/') }}/admin/<?= $linkUrl ?>"><?= $linkName ?></a></li>
        <?php endforeach ?>
    </ul>
    <?php endforeach ?>
</div>
