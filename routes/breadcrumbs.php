<?php

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//Index
Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.index'));
}); 

// Purchases

Breadcrumbs::for('purchases.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
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
    $trail->push('Detalles', route('details.index', $purchase));
});
Breadcrumbs::for('details.show', function (BreadcrumbTrail $trail, Purchase $purchase, $detail) {
    
    $trail->parent('details.index', $purchase);
    $trail->push('Editar Detalle', route('details.show', [$purchase, $detail]));
});
Breadcrumbs::for('details.edit', function (BreadcrumbTrail $trail, Purchase $purchase, $detail) {
    $trail->parent('details.index', $purchase);
    $trail->push('Editar Detalle', route('details.edit', [$purchase, $detail]));
});
Breadcrumbs::for('details.create', function (BreadcrumbTrail $trail, Purchase $purchase) {
    $trail->parent('details.index', $purchase);
    $trail->push('Registrar Detalle', route('details.create', $purchase));
});

//Sales
Breadcrumbs::for('sales.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Ventas', route('sales.index'));
});
Breadcrumbs::for('sales.create', function (BreadcrumbTrail $trail) {
    $trail->parent('sales.index');
    $trail->push('Registrar Venta', route('sales.create'));
});
Breadcrumbs::for('sales.show', function (BreadcrumbTrail $trail, Sale $sale) {
    $trail->parent('sales.index');
    $trail->push('Venta ID '.$sale->id, route('sales.show', $sale));
});
Breadcrumbs::for('sales.edit', function (BreadcrumbTrail $trail, Sale $sale) {
    $trail->parent('sales.show', $sale);
    $trail->push('Editar Venta', route('sales.edit', $sale));
});

// Products
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
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
Breadcrumbs::for('products.edit', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('products.show', $product);
    $trail->push('Editar Producto', route('products.edit', $product));
});

// Suppliers
Breadcrumbs::for('suppliers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
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
Breadcrumbs::for('suppliers.edit', function (BreadcrumbTrail $trail, Supplier $supplier) {
    $trail->parent('suppliers.show', $supplier);
    $trail->push('Editar Proveedor', route('suppliers.edit', $supplier));
});

// User
Breadcrumbs::for('admin.profile', function (BreadcrumbTrail $trail) {
    $trail->push('Perfil', route('admin.profile'));
});
Breadcrumbs::for('admin.profile.change-password', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.profile');
    $trail->push('Cambiar Contraseña', route('admin.profile.change-password'));
});

Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Usuarios', route('users.index'));
});
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users.index');
    $trail->push($user->name.$user->surname, route('users.show', ['user'=>$user]));
});



?>