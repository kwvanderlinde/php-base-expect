<?php
namespace Base\Expect;

class ArrayKeyExistsExpectation extends ExpectationBase
{
	private $lhs;
	private $key;

	public function __construct(Expectation $lhs, string $key)
	{
		$this->lhs = $lhs;
		$this->key = $key;
	}

	public function getValue()
	{
		$lhsValue = $this->lhs->getValue();
		if (!is_array($lhsValue))
		{
			throw new ExpectationFailedException(sprintf('Key "%s" cannot exist because value is not an array (it is a %s)', $this->key, gettype($lhsValue)));
		}

		if (!array_key_exists($this->key, $lhsValue))
		{
			throw new ExpectationFailedException(sprintf('Key "%s" not found', $this->key));
		}

		return $lhsValue[$this->key];
	}
}
