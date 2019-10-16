<?php
namespace Base\Expect;

class PropertyExistsExpectation extends ExpectationBase
{
	private $lhs;
	private $property;

	public function __construct(Expectation $lhs, string $property)
	{
		$this->lhs = $lhs;
		$this->property = $property;
	}

	public function getValue()
	{
		$lhsValue = $this->lhs->getValue();
		if (!is_object($lhsValue))
		{
			throw new ExpectationFailedException(sprintf('Property "%s" cannot exist because value is not an object (it is a %s)', $this->property, gettype($lhsValue)));
		}

		if (!property_exists($lhsValue, $this->property))
		{
			throw new ExpectationFailedException(sprintf('Property "%s" not found', $this->property));
		}

		return $lhsValue->{$this->property};
	}
}
