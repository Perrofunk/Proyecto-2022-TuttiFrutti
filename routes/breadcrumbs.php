<?php

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Purchases
Breadcrumbs::for('purchases.index', function (BreadcrumbTrail $trail) {
    $trail->push('Compras', route('purchases.index'));
});
Breadcrumbs::for('purchases.create', function (BreadcrumbTrail $trail) {
    $trail->parent('purchases.index');
    $trail->push('Registrar Compra', route('purchases.create'));
});
Breadcrumbs::for('purchases.show', function (BreadcrumbTrail $trail, Purchase $purchase) {
    $trail->parent('purchases.index');
    $trail->push('Compra ID '.$purchase->id, route('purchases.show', $purchase));
});
Breadcrumbs::for('purchases.edit', function (BreadcrumbTrail $trail, Purchase $purchase) {
    $trail->parent('purchases.show', $purchase);
    $trail->push('Editar Compra', route('purchases.edit', $purchase));
});

//Purchase Details
Breadcrumbs::for('details.index', function (BreadcrumbTrail $trail, Purchase $purchase) {
    $trail->parent('purchases.show', $purchase);
    $trail->push('Detalles', route('purchases.edit', $purchase));
});

// Products
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->push('Productos', route('products.index'));
});
Breadcrumbs::for('products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('products.index');
    $trail->push('Registrar Producto', route('products.index'));
});
Breadcrumbs::for('products.show', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('products.index');
    $trail->push($product->name, route('products.show', $product));
});

// Suppliers
Breadcrumbs::for('suppliers.index', function (BreadcrumbTrail $trail) {
    $trail->push('Proveedores', route('suppliers.index'));
});
Breadcrumbs::for('suppliers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('suppliers.index');
    $trail->push('Registrar Proveedor', route('suppliers.create'));
});
Breadcrumbs::for('suppliers.show', function (BreadcrumbTrail $trail, Supplier $supplier) {
    $trail->parent('suppliers.index');
    $trail->push($supplier->name, route('suppliers.show', $supplier));
});



?>