<?php

Breadcrumbs::for('page.index', function ($trail) {
    $trail->push('Главная', route('page.index'));
});

Breadcrumbs::for('page.about', function ($trail) {
	$trail->parent('page.index');
    $trail->push('О нас', route('page.about'));
});

Breadcrumbs::for('page.cart', function ($trail) {
	$trail->parent('page.index');
    $trail->push('Корзина', route('page.cart'));
});

Breadcrumbs::for('page.delivery-payment', function ($trail) {
	$trail->parent('page.index');
    $trail->push('Доставка и оплата', route('page.delivery-payment'));
});

Breadcrumbs::for('page.products-services', function ($trail) {
	$trail->parent('page.index');
    $trail->push('Товары и услуги', route('page.products-services'));
});

Breadcrumbs::for('page.promo-action', function ($trail) {
	$trail->parent('page.index');
    $trail->push('Акции', route('page.promo-action'));
});

Breadcrumbs::for('page.contacts', function ($trail) {
	$trail->parent('page.index');
    $trail->push('Контакты', route('page.contacts'));
});

Breadcrumbs::for('page.order', function ($trail) {
	$trail->parent('page.cart');
    $trail->push('Оформить заказ', route('page.order'));
});

Breadcrumbs::for('page.thank-you', function ($trail) {
    $trail->parent('page.order');
    $trail->push('Благодарим за заказ', route('page.thank-you'));
});

Breadcrumbs::for('page.search', function ($trail) {
	$trail->parent('page.index');
    $trail->push('Поиск', route('page.search'));
});

Breadcrumbs::for('page.records', function ($trail) {
	$trail->parent('page.index');
    $trail->push('Новости', route('page.records'));
});

Breadcrumbs::for('page.records-category', function ($trail, $recordsCategory) {
    $trail->parent('page.records');
    $trail->push($recordsCategory->title, route('page.records-category', $recordsCategory->id));
});

Breadcrumbs::for('page.record', function ($trail, $record) {
    if($record->category()->first()) {
		$trail->parent('page.records-category', $record->category()->first());
    } else {
    	$trail->parent('page.records');
	}
    $trail->push($record->title, route('page.record', $record->id));
});

Breadcrumbs::for('page.products-category', function ($trail, $productsCategory) {
    $trail->parent('page.products-services');
    $trail->push($productsCategory->title, route('page.products-category', $productsCategory->id));
});

Breadcrumbs::for('page.product', function ($trail, $product) {
    if($product->category()->first()) {
		$trail->parent('page.products-category', $product->category()->first());
    } else {
    	$trail->parent('page.products-services');
	}
    $trail->push($product->title, route('page.product', $product->id));
});