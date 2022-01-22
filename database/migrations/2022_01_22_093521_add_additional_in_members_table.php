<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalInMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (
            !Schema::hasColumn('members', 'old') &&
            !Schema::hasColumn('members', 'education') &&
            !Schema::hasColumn('members', 'height_body') &&
            !Schema::hasColumn('members', 'weight_body')
        ) {
            Schema::table('members', function (Blueprint $table) {
                $table->string('old', 5)->nullable();
                $table->string('education', 10)->nullable();
                $table->string('height_body', 5)->nullable();
                $table->string('weight_body', 5)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (
            Schema::hasColumn('members', 'old') &&
            Schema::hasColumn('members', 'education') &&
            Schema::hasColumn('members', 'height_body') &&
            Schema::hasColumn('members', 'weight_body')
        ) {
            Schema::table('members', function (Blueprint $table) {
                $table->dropColumn('old');
            });

            Schema::table('members', function (Blueprint $table) {
                $table->dropColumn('education');
            });

            Schema::table('members', function (Blueprint $table) {
                $table->dropColumn('height_body');
            });

            Schema::table('members', function (Blueprint $table) {
                $table->dropColumn('weight_body');
            });
        }
    }
}
