<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('roles', 20)->after('password');
            $table->string('no_telepon', 13)->after('roles');
            $table->string('is_active', 2)->default(0)->after('no_telepon');
            $table->softDeletes()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roles');
            $table->dropColumn('no_telepon');
            $table->dropColumn('is_active');
            $table->dropSoftDeletes();
        });
    }
}
