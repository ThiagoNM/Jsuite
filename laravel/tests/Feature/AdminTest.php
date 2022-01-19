<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
 
class AdminTest extends TestCase
{
   /**
    * Test user admin exists
    *
    * @return void
    */
   public function test_exists()
   {
       $count = DB::table('users')
            ->where('username', '=', 'admin')
            ->count();
       $this->assertEquals($count, 1);
   }
}
