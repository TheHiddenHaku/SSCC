<?php

class SerialShippingContainerCodeTest extends PHPUnit_Framework_TestCase
{

	/**
	 * Call protected/private method of a class.
	 *
	 * @param object &$object    Instantiated object that we will run method on.
	 * @param string $methodName Method name to call
	 * @param array  $parameters Array of parameters to pass into method.
	 *
	 * @return mixed Method return.
	 */
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}

	/** @test */
	public function it_rounds_an_integer_to_the_next_multiple_of_ten()
	{
	    $sscc = new TheHiddenHaku\SerialShippingContainerCode\SerialShippingContainerCode('800200800');
		$this->assertEquals(10, $this->invokeMethod($sscc, 'roundUpToNextMultipleOfTen', ['5']));
		$this->assertEquals(80, $this->invokeMethod($sscc, 'roundUpToNextMultipleOfTen', ['71']));
		$this->assertEquals(200, $this->invokeMethod($sscc, 'roundUpToNextMultipleOfTen', ['200']));
		$this->assertNotEquals(200, $this->invokeMethod($sscc, 'roundUpToNextMultipleOfTen', ['201']));
	}
	
	/** @test */
	public function it_resturns_a_single_digit_integer_computed_from_a_basecode()
	{
		$sscc = new TheHiddenHaku\SerialShippingContainerCode\SerialShippingContainerCode('800200800');
		$this->assertEquals(9, $this->invokeMethod($sscc, 'checkDigit', ['98002008000001234']));
	}
	
	/** @test */
	public function it_returns_a_zero_filled_value_of_nine_digits()
	{
		$sscc = new TheHiddenHaku\SerialShippingContainerCode\SerialShippingContainerCode('800200800');
		$this->assertEquals('000001234', $this->invokeMethod($sscc, 'zeroFill', ['1234']));
		$this->assertEquals('123456789', $this->invokeMethod($sscc, 'zeroFill', ['123456789']));
		$this->assertEquals('000000000', $this->invokeMethod($sscc, 'zeroFill', ['']));
	}

	/** @test */
	public function it_resturns_a_sscc_code_based_on_shipping_number()
	{
		$sscc = new TheHiddenHaku\SerialShippingContainerCode\SerialShippingContainerCode('800200800');
		$this->assertEquals('080020080000012346', $sscc->calculate(1234));
	}


}