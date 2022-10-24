<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Image;
use App\Models\PaymentType;
use App\Models\Post;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\ImageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Storage::deleteDirectory('public/storage');
        // Storage::makeDirectory('public/imagenes');

        Storage::deleteDirectory('public/imagenes');
        Storage::makeDirectory('public/imagenes');

        //Zona / Zone
        $this->call(ZoneSeeder::class);
        //Direccion / Address
        $this->call(AddressSeeder::class);

        $this->call(UserTypeSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);
        
        $this->call(ProductSeeder::class);


        // $products = Product::all();
        foreach (Product::all() as $product) {
            Image::factory(1)->create([
                'imageable_id'=>$product->id,
                'imageable_type'=>Product::class
            ]);
        }


        //Proveedores / Suppliers
        $suppliers = Supplier::factory(5)->create();
        foreach ($suppliers as $supplier) {
            Purchase::factory(3)->create([
                'supplier_id'=>$supplier->id
            ]);
        }
    
        //Compras / Purchases, pertenecen a un proveedor
        
        foreach (Purchase::all() as $purchase){
            PurchaseDetail::factory(3)->state(new Sequence(
                fn ($sequence) => ['purchase_id'=>$purchase->id,
                'product_id'=>Product::all()->random(1)->first()->id]
                ))->create();
            $purchaseDetails = PurchaseDetail::where('purchase_id', $purchase->id)->get();
            $detailTotal=0;
            foreach ($purchaseDetails as $purchaseDetail){

                $price = $purchaseDetail->product->price;
                $quantity = $purchaseDetail->quantity;

                $detailTotal += $price*$quantity;
                $purchaseDetail->update([
                    'price'=>$purchaseDetail->product->price
                ]);
            };
            $purchase->update([
                'total'=> $detailTotal
            ]);
        
        }
        // Compra::factory(6)->create([
        //     'supplier_id'=>rand(1, 3)
        // ]);
        
        //Tipos de Usuario
            //Cliente / Clients
                //Depende de:
                    
                        
            //             $this->call(ClientSeeder::class);
            // //Empleado / Employee
            //     $this->call(EmployeeSeeder::class);
            // //Admin
            //     $this->call(AdminSeeder::class);

            
            //Ventas
        
            //Tipo de Pago / Payment_type
            $this->call(PaymentTypeSeeder::class);

            $this->call(SaleSeeder::class);

    }
}
