<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TestBoard extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexBoard()
    {
        $this->get('/boards');
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'message' => [
                'id',
                'user_id',
                'name',
                'created_at',
                'updated_at'
            ]
        ]);
    }
}
