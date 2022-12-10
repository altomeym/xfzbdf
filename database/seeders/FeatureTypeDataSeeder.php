<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class FeatureTypeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_types')->insert([
            [
                'id' => 1,
                'type' => 'Text',
            ],[
                'id' => 2,
                'type' => 'Select',
            ],[
                'id' => 3,
                'type' => 'Checkbox',
            ],
        ]);
    }
}
