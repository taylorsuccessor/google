<?php
namespace App\controller;


class Hashim
{


    public   function test($photosArray){
//        $photosArray=[
//            1=>['V',['a','b']],
//            3=>['V',['d','e']],
//            2=>['H',['a','c', 'u']],
//            0=>['H',['a','b','t','p']],
//        ];




        $slidesArray=$this->convertPhotosToSlides($photosArray);

        $similarityArray =$this-> getSimilartyArray($slidesArray);
//      die(var_dump($similarityArray));
        $deletedSlides=[];
        $eachSlideWithNext =[];

        foreach($similarityArray as $slideIndex =>$similarSlide){
            $tagsNumber= $slidesArray[$slideIndex]['tagsNumber'];

            uasort($similarSlide, function ($a , $b){
                return  $a['closest'] > $b['closest'];
            });
            $i=0;
            while(array_key_exists($i,$similarSlide)){
                $nextSlideIndex = $similarSlide[$i]['slide'];
                if(in_array($nextSlideIndex,$deletedSlides)){$i++; continue;}
                $eachSlideWithNext[$slideIndex] = $nextSlideIndex;
                $deletedSlides []= $nextSlideIndex;

            }



        }
        $finalArrangeOfSlides = $this->getFinalArrangeOfSlidesArray($eachSlideWithNext);

        $outPutFileContent =count($finalArrangeOfSlides)."\n";

        foreach($finalArrangeOfSlides as $slideIndex){
            $outPutFileContent .= join(' ',$slidesArray[$slideIndex]['photos'])."\n";
        }

        file_put_contents('output.txt',$outPutFileContent);
    }

    public function getFinalArrangeOfSlidesArray($eachSlideWithNext){

//        $index=0;
//        foreach($eachSlideWithNext as $first=>$s){
//            $index=$first; break;
//        }

//        $finalArrangeOfSlides=[];
//        while(array_key_exists($index,$eachSlideWithNext)){
//            $finalArrangeOfSlides[]=$index;
//            $index=$eachSlideWithNext[$index];
//        }
        foreach($eachSlideWithNext as $previos=>$next){
            $finalArrangeOfSlides[]=$previos;
            $finalArrangeOfSlides[]=$next;
        }

        return $finalArrangeOfSlides;
    }

    public function convertPhotosToSlides($photosArray){


        $slides=[];

        $tempSlide=['tags'=>[],'photos'=>[]];
        $tempStart=0;

        foreach($photosArray as $photoIndex=>$photo){
            if($photo[0] == 'H'){
                $slides[]=['tags'=>$photo[1],'tagsNumber'=>count($photo[1]),'photos'=>[$photoIndex]];

            }elseif($photo[0] == 'V'){

                $tempSlide['tags']=array_unique(array_merge($photo[1],$tempSlide));

                if($tempStart == 1){
                    $tempSlide['photos'][]=$photoIndex;
                    $slides[]=['tags'=>$tempSlide,'tagsNumber'=>count($tempSlide['tags']),'photos'=> $tempSlide['photos']];

                    $tempSlide=['tags'=>[],'photos'=>[]];
                    $tempStart=0;
                }else{
                    $tempSlide['photos']=[$photoIndex];
                    $tempStart=1;
                }
            }
        }

        return $this->orderSlidesDesc($slides);


    }


    public function orderSlidesDesc($slides){


        uasort($slides, function ($a , $b){
            return count($a['tagsNumber']) < count($b['tagsNumber']);
        });

        return $slides;
    }


    public function getSimilartyArray($slidesArray){

        $similarityArray=[];

        foreach($slidesArray as $currentSlideIndex=>$currentSlide){

            foreach($slidesArray as $tempSlideIndex=>$tempSlide){
                if($tempSlideIndex <=$currentSlideIndex) continue;
                $similarNumber=count(array_intersect($currentSlide['tags'],$tempSlide['tags']));
                if($similarNumber ==0 || $similarNumber == $currentSlide['tagsNumber'] || $similarNumber == $tempSlide['tagsNumber']  ) continue;

                $maxMin =floor(min($currentSlide['tagsNumber'],$tempSlide['tagsNumber'])/2);
                $similarityArray[$currentSlideIndex][]=   [
                    'slide'=>$tempSlideIndex,
                    'similar'=>$similarNumber,
                    'tagsNumber'=>$tempSlide['tagsNumber'],
                    'maxMin'=>$maxMin,
                    'closest'=> abs( $similarNumber -$maxMin)

                ];
            }
        }

        return $similarityArray;
    }

//    private function getInterstFactor($slide1, $slide2)
//    {
//        $similer = count(array_intersect($slide1,$slide2));
//        $s1Diff = (count($slide1)-$similer);
//        $s2Diff = (count($slide2)-$similer);
//
//        return min($similer, $s1Diff, $s2Diff);
//
//    }
//
//public function sortSlides($array){
//    for($j = 0; $j < count($array); $j ++) {
//        for($i = 0; $i < count($array)-1; $i ++){
//
//            if($array[$i] > $array[$i+1]) {
//                $temp = $array[$i+1];
//                $array[$i+1]=$array[$i];
//                $array[$i]=$temp;
//            }
//        }
//    }
//}




    public   function testHashim_1(){

//        $photosArray=[
//            1=>['V',['a','b']],
//            3=>['V',['d','e']],
//            2=>['H',['a','c', 'u']],
//            0=>['H',['a','b','t','p']],
//        ];

//        $fileArray = $this->getFileArray(__DIR__.'/../tests/input/a_example.txt');
        $fileArray = $this->getFileArray(__DIR__.'/../tests/input/b_lovely_landscapes.txt');
//        $fileArray = $this->getFileArray(__DIR__.'/../tests/input/c_memorable_moments.txt');

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

            if($rowIndex ==0 || strlen($row)<3) continue;

            $oneRowArray = explode(' ',$row);

            $rowsArray[] = [ $oneRowArray[0],array_slice($oneRowArray,2)];
        }

        return $rowsArray;


    }
}

