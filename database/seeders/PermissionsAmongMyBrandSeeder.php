<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PermissionsAmongMyBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::Now();
        $modules = DB::table('modules')->where('access', '!=', 'Super Admin')->where('name','Among My Brand')->get();

        foreach ($modules as $module) {
            $actions = explode(',', $module->actions);

            foreach ($actions as $action) {
                $slug = strtolower($action).'_'.Str::snake($module->name);

                if (! DB::table('permissions')->where('slug', $slug)->first()) {
                    DB::table('permissions')->insert(
                        [
                            'module_id' => $module->id,
                            'name' => Str::title($action),
                            'slug' => $slug,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                }
            }
        }

        // Demo permission_role on pivot table
        $permissions = DB::table('permissions')->pluck('module_id', 'id');

        foreach ($permissions as $permission_id => $module_id) {
            $module = DB::table('modules')->where('id', $module_id)->first();

            if ($module->access != 'Merchant') {
                if (! DB::table('permission_role')->where([
                    ['permission_id', '=', $permission_id],
                    ['role_id', '=', \App\Models\Role::ADMIN],
                ])->first()) {
                    DB::table('permission_role')->insert([
                        'permission_id' => $permission_id,
                        'role_id' => \App\Models\Role::ADMIN,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            if ($module->access != 'Platform') {
                if (! DB::table('permission_role')->where([
                    ['permission_id', '=', $permission_id],
                    ['role_id', '=', \App\Models\Role::MERCHANT],
                ])->first()) {
                    DB::table('permission_role')->insert([
                        'permission_id' => $permission_id,
                        'role_id' => \App\Models\Role::MERCHANT,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
        // DB::table('permissions')->insert([
        //     'module_id' => \App\Models\Module::where('name','Among My Brand')->first()->id,
        //     'name' => 'View',
        //     'slug' => 'view_among_my_brand',
        //     'created_at' => Carbon::Now(),
        //     'updated_at' => Carbon::Now(),
        // ]);
        // DB::table('permissions')->insert([
        //     'module_id' => \App\Models\Module::where('name','Among My Brand')->first()->id,
        //     'name' => 'Add',
        //     'slug' => 'add_among_my_brand',
        //     'created_at' => Carbon::Now(),
        //     'updated_at' => Carbon::Now(),
        // ]);
        // DB::table('permissions')->insert([
        //     'module_id' => \App\Models\Module::where('name','Among My Brand')->first()->id,
        //     'name' => 'Edit',
        //     'slug' => 'edit_among_my_brand',
        //     'created_at' => Carbon::Now(),
        //     'updated_at' => Carbon::Now(),
        // ]);
        // DB::table('permissions')->insert([
        //     'module_id' => \App\Models\Module::where('name','Among My Brand')->first()->id,
        //     'name' => 'delete',
        //     'slug' => 'delete_among_my_brand',
        //     'created_at' => Carbon::Now(),
        //     'updated_at' => Carbon::Now(),
        // ]);
    }
}
