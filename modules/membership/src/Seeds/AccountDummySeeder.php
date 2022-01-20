<?php

namespace Modules\Membership\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Membership\Account;

class AccountDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            factory(Account::class, 100)->create();
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
