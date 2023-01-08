<?php

namespace App\Events;

class TestEvent extends Event
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return ['mi-canal'];
    }

    public function broadcastAs()
    {
        return 'mi-evento';
    }
}
