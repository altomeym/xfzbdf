<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class AttributeTableNewDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::Now();
        
        DB::table('attributes')->insert([
            [
                'id' => 1,
                'name' => 'Package',
                'attribute_type_id' => 3,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        DB::table('attribute_values')->insert([
            [
                'id' => 1,
                'value' => 'Basic',
                'attribute_id' => 1,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'id' => 2,
                'value' => 'Standard',
                'attribute_id' => 1,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'id' => 3,
                'value' => 'Premium',
                'attribute_id' => 1,
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
