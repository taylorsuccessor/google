<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


use App\controller\Google;

use App\controller\Hashim;

final class HashimTest extends TestCase
{


    public   function testHashim_1(){

        $photosArray=[
            1=>['V',['a','b']],
            3=>['V',['d','e']],
            2=>['H',['a','c', 'u']],
            0=>['H',['a','b','t','p']],
        ];

      $fileArray = $this->getFileArray(__DIR__.'/input/a_example.txt'));
        $hashim=new Hashim();
        $hashim->test($fileArray);

//        $this->assertTrue(Config::get('true')) ;
//        $this->assertEquals(1,1);

    }
    public function getFileArray($fileName){

        $fileContent = file_get_contents($fileName);

        $fileRows= explode("\n",$fileContent);
        $rowsArray=[];
        foreach($fileRows as $rowIndex=>$row){

            if($rowIndex ==0 ) continue;

            $oneRowArray = explode(' ',$row);

            $rowsArray[] = [ $oneRowArray[0],array_slice(2,$oneRowArray)];
        }
        return $rowsArray;


    }

}

