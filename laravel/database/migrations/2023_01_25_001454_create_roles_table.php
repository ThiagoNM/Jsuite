<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')                  
                  ->nullable();
            $table->foreign('role_id')
                  ->references('id')->on('roles')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });

        // Call seeder
        Artisan::call('db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true // <--- add this line
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('roles');
    }
}