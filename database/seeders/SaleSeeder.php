<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::factory(3)->has(SaleDetail::factory()->count(3), 'details')->create();
        foreach (Sale::all() as $sale) {
            $detailTotal=0;
            foreach (SaleDetail::where('sale_id', $sale->id)->get() as $saleDetail){
                $detailTotal += $saleDetail->price*$saleDetail->quantity;
                $saleDetail->update([
                    'price'=>$saleDetail->product->price
                ]);
            };
            $sale->update([
                'total'=>$detailTotal
            ]);
        }
        
    }
}
