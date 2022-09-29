<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\PaymentType;
use App\Models\Post;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\User;
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
        // Storage::deleteDirectory('public/imagenes');
        // Storage::makeDirectory('public/imagenes');

        Storage::deleteDirectory('public/imagenes');
        Storage::makeDirectory('public/imagenes');

        $this->call(UserTypeSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);
        
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);
        $this->call(ProductSeeder::class);



        //Proveedores
        $suppliers = Supplier::factory(5)->create();
        foreach ($suppliers as $supplier) {
            Compra::factory(3)->create([
                'supplier_id'=>$supplier->id
            ]);
        }
    
        //Compras, pertenecen a un proveedor
        $compras=Compra::all();
        foreach ($compras as $compra){
            DetalleCompra::factory(3)->state(new Sequence(
                fn ($sequence) => ['compra_id'=>$compra->id,
                'product_id'=>Product::all()->random(1)->first()->id]
                // ['compra_id'=>$compra->id,
                // 'product_id'=>Product::all()->random(3)->first()->id],
                // ['compra_id'=>$compra->id,
                // 'product_id'=>Product::all()->random(3)->first()->id],
                // ['compra_id'=>$compra->id,
                // 'product_id'=>Product::all()->random(3)->first()->id]
                ))->create();
            $detalleCompras = DetalleCompra::where('compra_id', $compra->id)->get();
            $totalDetalle=0;
            foreach ($detalleCompras as $detalleCompra){

                $compraIndividual = $detalleCompra->costo_unitario;

                $cantidadIndividual = $detalleCompra->cantidad;

                $totalDetalle += $compraIndividual*$cantidadIndividual;
            };
            $compra->update([
                'total'=> $totalDetalle
            ]);
        
        }
        // Compra::factory(6)->create([
        //     'supplier_id'=>rand(1, 3)
        // ]);
        
        //Tipos de Usuario
            //Cliente / Clients
                //Depende de:
                    //Zona / Zone
                    $this->call(ZoneSeeder::class);
                    //Direccion / Address
                    $this->call(AddressSeeder::class);
                        
                        $this->call(ClientSeeder::class);
            //Empleado / Employee
                $this->call(EmployeeSeeder::class);
            //Admin
                $this->call(AdminSeeder::class);

            
            //Ventas
        
            //Tipo de Pago / Payment_type
            $this->call(PaymentTypeSeeder::class);

    }
}
