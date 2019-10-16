<?php
namespace Base\Expect;

class ArrayContainsExpectation extends ExpectationBase
{
	private $lhs;
	private $value;

	public function __construct(Expectation $lhs, $value)
	{
		$this->lhs = $lhs;
		$this->value = $value;
	}

	public function getValue()
	{
		$lhsValue = $this->lhs->getValue();
		if (!is_array($lhsValue))
		{
			throw new ExpectationFailedException(sprintf('Value cannot exist in array it is not an array (it is a %s)', $this->value, gettype($lhsValue)));
		}

		if (!in_array($this->value, $lhsValue))
		{
			var_dump('Expected value: ', $this->value, is_scalar($this->value));
			if (is_scalar($this->value))
			{
				$message = sprintf('Value %s not found in array');
			}
			else
			{
				$message = 'Value not found in array.';
			}
			throw new ExpectationFailedException(message);
		}

		return $this;
	}
}
