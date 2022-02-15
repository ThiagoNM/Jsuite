
<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateRolesTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('roles', function (Blueprint $table) {
//             $table->integer('id')->increments()->primary();
//             $table->string('name')->unique();
//         });

//         Schema::table('users', function (Blueprint $table) {
//             $table->integer('role_id');
//         });

//         Schema::table('users', function (Blueprint $table) {
//             $table->foreign('role_id')->references('id')->on('roles');
//         });

//         Artisan::call('db:seed', [
//             '--class' => 'RoleSeeder',
//             '--force' => true
//          ]);
         
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->dropForeign('role_id');
//         });

//         Schema::table('users', function (Blueprint $table) {
//             $table->dropColumn('role_id');
//         });

//         Schema::dropIfExists('roles');
//     }
// }
