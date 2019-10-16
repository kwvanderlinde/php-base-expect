<?php
namespace Base\Expect;

class CountExpectation extends ExpectationBase
{
	private $lhs;

	public function __construct(Expectation $lhs)
	{
		$this->lhs = $lhs;
	}

	public function getValue()
	{
		$lhsValue = $this->lhs->getValue();

		return count($lhsValue);
	}
}
