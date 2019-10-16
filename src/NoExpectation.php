<?php
namespace Base\Expect;

class NoExpectation extends ExpectationBase implements Expectation
{
	private $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}
}
