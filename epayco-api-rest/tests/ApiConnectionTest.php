<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class ApiConnectionTest extends TestCase
{
    public $baseUri = '';
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
        printf('||| API REST: OK ||| ');

        if(DB::connection()->getDatabaseName()){
            $this->assertTrue(true);
            printf(' Database connection OK |||');
        }else {
            $this->assertTrue(false);
        }
    }
}
