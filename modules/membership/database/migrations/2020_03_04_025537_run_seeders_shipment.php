<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\Membership\Seeds\CitiesTableSeeder;
use Modules\Membership\Seeds\ProvincesTableSeeder;
use Modules\Membership\Seeds\SubdistrictsTableSeeder;

class RunSeedersShipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => ProvincesTableSeeder::class,
        ]);

        Artisan::call('db:seed', [
            '--class' => CitiesTableSeeder::class,
        ]);

        Artisan::call('db:seed', [
            '--class' => SubdistrictsTableSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('provinces')->truncate();
        DB::table('cities')->truncate();
        DB::table('subdistricts')->truncate();
    }
}
