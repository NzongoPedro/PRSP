<?php

namespace App\controller;

use App\Model\Counter as counter;

class CounterController
{
    public static function counter($id_posto)
    {

        return counter::counters($id_posto);
    }

    public static function contadorGeral()
    {
        return counter::contadorGeral();
    }
}
