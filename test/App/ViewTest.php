<?php

namespace ProgramerHakim\Project\PHP\MVC\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender()
    {
        View::render('Home/index', [
            'Programer Hakim'             //title diambil dari header
        ]);
        $this->expectOutputRegex('[Programer Hakim]'); //title diambil dari header
        $this->expectOutputRegex('[html]'); //html diambil dari Home/index
        $this->expectOutputRegex('[body]'); //body diambil dari Home/index
        $this->expectOutputRegex('[Login]'); //body diambil dari Home/index
        $this->expectOutputRegex('[Register]'); //body diambil dari Home/index
    }
}
