<?php
namespace TheHiddenHaku\SerialShippingContainerCode;

class SerialShippingContainerCode {

	private $gs1Code;

	public function __construct( $gs1Code )
	{
		$this->gs1Code = $gs1Code;
	}

	public function calculate( $id )
	{

		$id = $this->zerofill( $id );
		$extensionDigit = rand( 1, 9) ;
		$baseCode = $extensionDigit . $this->gs1Code . $id;
		$checkDigit = $this->checkDigit( $baseCode );

		return $baseCode . $checkDigit;
	}

	private function zerofill( $id )
	{
		$maxProgressiveLength = strlen( $this->gs1Code ) == 7 ? 9 : 7;

		return str_pad( $id, $maxProgressiveLength, '0', STR_PAD_LEFT );

	}

	private function checkDigit( $basecode )
	{
		$digits = str_split( $basecode );
		$sum = 0;
		foreach ( $digits as $k => $v ) {
			$pos = $k + 1;
			$multiplier = 3;
			if ($pos % 2 == 0) {
				$multiplier = 1;
			}
			$sum += $v * $multiplier;
		}
		echo $sum . PHP_EOL;
		return $this->roundUpToNextMultipleOfTen( $sum ) - $sum;
	}

	private function roundUpToNextMultipleOfTen( $n )
	{
		return $n % 10 === 0 ? $n : ceil ( $n / 10 ) * 10;
	}

}
