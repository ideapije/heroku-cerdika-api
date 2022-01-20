<?php

namespace Modules\Membership\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'member' => [
                'index articles',
                'show article',
                'index my medical records',
                'create my medical record',
                'edit my medical record',
                'show my medical record',
                'index events',
                'show event',
                'join event'
            ],
            'admin' => [
                'index users',
                'create user',
                'edit user',
                'toggle user',
                'index articles',
                'show article',
                'edit article',
                'publish article',
                'show visitor',
                'index medical records',
                'create medical record',
                'edit medical record',
                'show medical record',
                'index events',
                'create event',
                'edit event',
                'show event',
                'publish event'
            ]
        ];
        DB::beginTransaction();
        try {
            collect($roles)->each(function ($values, $key) {
                collect($values)->each(function ($value) {
                    Permission::firstOrCreate([
                        'name' => $value,
                        'guard_name' => 'web'
                    ]);
                });
                Role::findOrCreate($key)->givePermissionTo($values);
            });
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
