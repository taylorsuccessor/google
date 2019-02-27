<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


use App\controller\Google;

final class GoogleTest extends TestCase
{


    public   function testGoogle_1(){
        $google=new Google();
        $google->test();
        $this->assertTrue(Config::get('true')) ;
        $this->assertEquals(1,1);
    }


}

