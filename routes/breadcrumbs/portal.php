<?php


use Diglactic\Breadcrumbs\Breadcrumbs;


use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('<i class="fa fa-home"></i>', route('portal.dashboard'));
});

Breadcrumbs::for('One', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta['name'] ?? '' , route('portal.dashboard'));
});








