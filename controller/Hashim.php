<?php
namespace App\controller;


class Hashim
{


    public   function test(){
        $photosArray=[
            1=>['V',['a','b']],
            3=>['V',['d','e']],
            2=>['H',['a','c', 'u']],
            0=>['H',['a','b','t','p']],
        ];




        $slidesArray=$this->convertPhotosToSlides($photosArray);

        $similarityArray =$this-> getSimilartyArray($slidesArray);

        $deletedSlides=[];

        foreach($similarityArray as $slideIndex =>$similarSlide){
            $tagsNumber= $slidesArray[$slideIndex]['tagsNumber'];

            uasort($similarSlide, function ($a , $b){
                return  $a['maxMin'] - $b['similar']< 0;
            });

            foreach($similarSlide as $oneMatchSlide){
                if($oneMatchSlide['similar'])
            }

        }

    }



    public function convertPhotosToSlides($photosArray){


        $slides=[];

        $tempSlide=[];
        $tempStart=0;

        foreach($photosArray as $photoIndex=>$photo){
            if($photo[0] == 'H'){
                $slides[]=['tags'=>$photo[1],'tagsNumber'=>count($photo[1])];

            }elseif($photo[0] == 'V'){

                $tempSlide=array_unique(array_merge($photo[1],$tempSlide));
                if($tempStart == 1){
                    $slides[]=['tags'=>$tempSlide,'tagsNumber'=>count($tempSlide)];

                    $tempStart=0;
                }else{
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

               $minMax =floor(min($currentSlide['tagsNumber'],$tempSlide['tagsNumber'])/2);
                $similarityArray[$currentSlideIndex][]=   [
                    'slide'=>$tempSlideIndex,
                    'similar'=>$similarNumber,
                    'tagsNumber'=>$tempSlide['tagsNumber'],
                    'maxMin'=>$minMax,
                    'closest'=>abs($minMax - )

                ];
            }
        }

        return $similarityArray;
    }

    private function getInterstFactor($slide1, $slide2)
    {
        $similer = count(array_intersect($slide1,$slide2));
        $s1Diff = (count($slide1)-$similer);
        $s2Diff = (count($slide2)-$similer);

        return min($similer, $s1Diff, $s2Diff);

    }

public function sortSlides($array){
    for($j = 0; $j < count($array); $j ++) {
        for($i = 0; $i < count($array)-1; $i ++){

            if($array[$i] > $array[$i+1]) {
                $temp = $array[$i+1];
                $array[$i+1]=$array[$i];
                $array[$i]=$temp;
            }
        }
    }
}

}

