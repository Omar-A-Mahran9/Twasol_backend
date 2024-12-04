<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('index', function($trail){
    $trail->push('', route('vendor.home'));
});

Breadcrumbs::for('home', function($trail){
    $trail->push(__('Home'), route('vendor.home'));
});

// Vendor > Products
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Products'), route('vendor.products.index'));
});

// Vendor > Orders
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Orders'), route('vendor.orders.index'));
});

// Vendor > Order > Show
Breadcrumbs::for('order-show', function ($trail) {
    $trail->parent('orders');
    $trail->push(__('Orders'), '#');
});

// Vendor > Cities
Breadcrumbs::for('branches', function ($trail) {
    $trail->parent('home');
    $trail->push(__('branches'), route('vendor.branches.index'));
});

// Vendor > Profile
Breadcrumbs::for('vendor-profile', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Vendor profile'), route('vendor.profile-info'));
});
