<?php
namespace TheHiddenHaku\SerialShippingContainerCode;

class SerialShippingContainerCode {

	private $gs1Code;
	/**
	 * @var int
	 */
	private $extensionDigit;

	/**
	 * SerialShippingContainerCode constructor.
	 * @param     $gs1Code
	 * @param int $extensionDigit
	 */
	public function __construct( $gs1Code, $extensionDigit = 0 )
	{
		$this->gs1Code = $gs1Code;
		$this->extensionDigit = $extensionDigit;
	}

	/**
	 * @param $id
	 * @return string
	 */
	public function calculate( $id )
	{

		$id = $this->zeroFill( $id );
		$baseCode = $this->extensionDigit . $this->gs1Code . $id;
		$checkDigit = $this->checkDigit( $baseCode );

		return $baseCode . $checkDigit;
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	private function zeroFill( $id )
	{
		$maxProgressiveLength = strlen( $this->gs1Code ) == 7 ? 9 : 7;

		return str_pad( $id, $maxProgressiveLength, '0', STR_PAD_LEFT );

	}

	/**
	 * @param $basecode
	 * @return mixed
	 */
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

		return $this->roundUpToNextMultipleOfTen( $sum ) - $sum;
	}

	/**
	 * @param $n
	 * @return mixed
	 */
	private function roundUpToNextMultipleOfTen( $n )
	{
		return $n % 10 === 0 ? $n : ceil ( $n / 10 ) * 10;
	}

}
