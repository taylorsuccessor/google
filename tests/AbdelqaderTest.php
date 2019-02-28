<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use App\controller\Abdelqader;

final class AbdelqaderTest extends TestCase
{


    public   function testHashim_1(){




        print_r($this->getFileArray(__DIR__.'/c_medium.in'));
        $abdelqader=new Abdelqader();
        $abdelqader->test();
        $this->assertTrue(Config::get('true')) ;
        $this->assertEquals(1,1);

    }
    public function getFileArray($fileName){

        $fileContent = file_get_contents($fileName);

        $fileRows= explode("\n",$fileContent);
        $rowsArray=[];
        foreach($fileRows as $rowIndex=>$row){

            if($rowIndex ==0 || strlen($row)<2) continue;

            $rowsArray[] = str_split($row);
        }
        return $rowsArray;


    }

}

