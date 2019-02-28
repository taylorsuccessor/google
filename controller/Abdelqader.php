<?php

namespace App\controller;


class Abdelqader {


	public function test() {
		$photosArray = [
			1 => [ 'V', [ 'a', 'b' ] ],
			3 => [ 'V', [ 'd', 'e' ] ],
			2 => [ 'H', [ 'a', 'c', 'u' ] ],
			0 => [ 'H', [ 'a', 'b', 't', 'p' ] ],
		];


		$slidesArray = $this->convertPhotosToSlides( $photosArray );

		$this->sortSlides($slidesArray);


		$score = 0;
		foreach ($slidesArray as $key=>$val){
			if(isset($slidesArray[$key+1])){
				$slidesArray[$key]['InterstFactor'] = $this->getInterstFactor($slidesArray[$key]['tags'],$slidesArray[$key+1]['tags'] );
				$score += $slidesArray[$key]['InterstFactor'];
			}
		}


		var_dump($slidesArray);
		var_dump($score);

	}


	public function convertPhotosToSlides($file){

		$photoIndex = 0;
		$SlideCount = 0;




	}


	public function convertPhotosToSlides1( $photosArray ) {


		$slides = [];

		$tempSlide = [];
		$tempStart = 0;

		foreach ( $photosArray as $photoIndex => $photo ) {
			if ( $photo[0] == 'H' ) {
				$slides[] = [ 'tags' => $photo[1], 'tagsNumber' => count( $photo[1] ) ];

			} elseif ( $photo[0] == 'V' ) {

				$tempSlide = array_unique( array_merge( $photo[1], $tempSlide ) );
				if ( $tempStart == 1 ) {
					$slides[] = [ 'tags' => $tempSlide, 'tagsNumber' => count( $tempSlide ) ];

					$tempStart = 0;
				} else {
					$tempStart = 1;
				}
			}
		}

		return $this->orderSlidesDesc( $slides );


	}


	public function orderSlidesDesc( $slides ) {


		uasort( $slides, function ( $a, $b ) {
			return count( $a['tagsNumber'] ) < count( $b['tagsNumber'] );
		} );

		return $slides;
	}


	public function getSimilartyArray( $slidesArray ) {

		$similarityArray = [];

		foreach ( $slidesArray as $currentSlideIndex => $currentSlide ) {

			foreach ( $slidesArray as $tempSlideIndex => $tempSlide ) {
				if ( $tempSlideIndex <= $currentSlideIndex ) {
					continue;
				}
				$similarNumber = count( array_intersect( $currentSlide['tags'], $tempSlide['tags'] ) );
				if ( $similarNumber == 0 || $similarNumber == $currentSlide['tagsNumber'] || $similarNumber == $tempSlide['tagsNumber'] ) {
					continue;
				}

				$minMax                                  = floor( min( $currentSlide['tagsNumber'], $tempSlide['tagsNumber'] ) / 2 );
				$similarityArray[ $currentSlideIndex ][] = [
					'slide'      => $tempSlideIndex,
					'similar'    => $similarNumber,
					'tagsNumber' => $tempSlide['tagsNumber'],
					'maxMin'     => $minMax,
					'closest'    => abs( $minMax -0 )

				];
			}
		}

		return $similarityArray;
	}

	private function getInterstFactor( $slide1, $slide2 ) {
		$similer = count( array_intersect( $slide1, $slide2 ) );

		if($similer==0){
			return 0;
		}

		$s1Diff  = ( count( $slide1 ) - $similer );
		$s2Diff  = ( count( $slide2 ) - $similer );

		return min( $similer, $s1Diff, $s2Diff );

	}

	public function sortSlides( &$array ) {
		for ( $j = 0; $j < count( $array ); $j ++ ) {
			for ( $i = 0; $i < count( $array ) - 1; $i ++ ) {
				if ( isset( $array[ $i + 2 ] ) ) {
					if ( $this->getInterstFactor( $array[$i]['tags'], $array[ $i + 1 ]['tags'] ) < $this->getInterstFactor( $array[ $i ]['tags'], $array[ $i + 2 ]['tags'] ) ) {
						$temp            = $array[ $i + 1 ];
						$array[ $i + 1 ] = $array[ $i ];
						$array[ $i ]     = $temp;
					}
				}
			}
		}
	}

}

