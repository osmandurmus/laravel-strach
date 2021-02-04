<?php

namespace App;
use App\Foo;

class Example{

    protected $foo;

    public function __construct(Foo $foo){

        $this->foo = $foo;
    }

}