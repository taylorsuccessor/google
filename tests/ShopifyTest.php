<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


use App\controller\Shopify;

final class ShopifyTest extends TestCase
{


    public   function testShopify_1(){
$shopify=new Shopify();
        $shopify->test();
        $this->assertTrue(Config::get('true')) ;
        $this->assertEquals(1,1);
    }






}

