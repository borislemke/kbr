<?php

// Set navbar for each user role_id

switch ($admin->role_id) {
    case 1:
        $navigation = Config::get('navbar');
        break;
    case 2:
        $navigation = Config::get('navbar_manager');
        break;
    case 3:
        $navigation = Config::get('navbar_superagent');
        break;
    case 4:
        $navigation = Config::get('navbar_agent');
        break;
    
    default:
        $navigation = Config::get('navbar_agent');
        break;
}

$first = TRUE;

$link = str_replace(url('/admin') . '/', '', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

$link = strtok($link, '?');

function childIsActive($children, $link) {

    foreach($children as $child => $c) {

        if($child == $link) echo ' active';
    }
}

$nav_category = (isset($_GET['category'])) ? $_GET['category'] : '' ;

switch ($nav_category) {
    case 'villa':
        $nav_category = 'villas';
        break;
    case 'land':
        $nav_category = 'lands';
        break;
    case 'villa-rental':
        $nav_category = 'villa rental';
        break;
    
    default:
        $nav_category = '';
        break;
}

?>

<ul id="navbar-main" class="flexbox">

    <?php foreach($navigation as $nav => $navlinks): ?>
    <li class="navbar-main-item"><a href class="navbar-main-link<?php childIsActive($navlinks, $link) ?> <?=($link == 'properties' && $nav == $nav_category) ? 'active' : ''; ?>"><?= str_replace('_', ' ', $nav) ?></a></li>
    <?php $first = FALSE; endforeach ?>
</ul>

<div id="navbar-wrapper">

    <?php foreach($navigation as $nav => $navlinks): ?>
    <ul class="navbar-ul flexbox <?php childIsActive($navlinks, $link) ?> <?=($link == 'properties' && $nav == $nav_category) ? 'active' : ''; ?>">
        <?php foreach($navlinks as $linkUrl => $linkName): ?>
        <li class="navbar-item"><a class="<?= $linkUrl == $link ? 'active' :''; ?><?=($link == 'properties' && $nav == $nav_category && (isset($_GET['status']) ? $_GET['status'] : '') == $linkName) ? 'active' : ''; ?>" href="{{ URL::to('/') }}/admin/<?= $linkUrl ?>"><?= $linkName ?></a></li>
        <?php endforeach ?>
    </ul>
    <?php endforeach ?>
</div>
