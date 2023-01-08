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
        printf('||| ApiGateway OK ||| ');

        $response =  $this->request('GET', config('service.apirest.url'));
        $this->assertEquals(200, $response['code']);
        printf(' Connection with APIREST MicroService: ok ||| ');
    }
}
