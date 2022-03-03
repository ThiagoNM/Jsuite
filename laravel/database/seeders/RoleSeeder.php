<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
        array(
            'id' => "0",
            'name' => 'admin'
        ),
        array(
            'id' => "1",
            'name' => 'basic'
        ),
        array(
            'id' => "2",
            'name' => 'tech'
        ),
        array(
            'id' => "3",
            'name' => 'coord'
        )
        ));
    }
}
