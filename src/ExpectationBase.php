<?php
namespace Base\Expect;

abstract class ExpectationBase implements Expectation, \ArrayAccess
{
	public function toBeA(string $type)
	{
		$value = $this->getValue();
		$function = 'is_' . $type;

		if (!function_exists($function))
		{
			throw new \Exception('Not a type function: ' . $function);
		}

		if (!$function($value))
		{
			throw new ExpectationFailedException(sprintf('Expected value of type %s, but got %s', $type, gettype($value)));
		}
	}

	public function toBe($rhs)
	{
		$lhs = $this->getValue();

		if ($lhs === $rhs)
		{
			return;
		}

		// TODO Use Sebastian Bergmann comparators for good output.
		throw new ExpectationFailedException(sprintf('Value not same. Expected %s but got %s', $rhs, $lhs));
	}

	public function toNotBe($rhs)
	{
		$lhs = $this->getValue();

		if ($lhs !== $rhs)
		{
			return;
		}

		// TODO Use Sebastian Bergmann comparators for good output.
		throw new ExpectationFailedException('Value is same');
	}

	public function toEqual($rhs)
	{
		$lhs = $this->getValue();

		if ($lhs == $rhs)
		{
			return;
		}

		// TODO Use Sebastian Bergmann comparators for good output.
		throw new ExpectationFailedException('Value not equal');
	}

	public function toNotEqual($rhs)
	{
		$lhs = $this->getValue();

		if ($lhs != $rhs)
		{
			return;
		}

		// TODO Use Sebastian Bergmann comparators for good output.
		throw new ExpectationFailedException('Value is equal');
	}

	public function __get(string $name)
	{
		return new PropertyExistsExpectation($this, $name);
	}

	public function offsetExists($key)
	{
		throw new \Exception('Not implemented');
	}

	public function offsetGet($key)
	{
		return new ArrayKeyExistsExpectation($this, $key);
	}

	public function offsetSet($key, $value)
	{
		throw new \Exception('Not implemented');
	}

	public function offsetUnset($key)
	{
		throw new \Exception('Not implemented');
	}

	public function count()
	{
		return new CountExpectation($this);
	}

	public function contains(...$values)
	{
		if (count($values) > 1)
		{
			foreach ($values as $value)
			{
				$this->contains($value);
			}
			return;
		}
		$value = reset($values);

		$lhsValue = $this->getValue();
		if (!is_array($lhsValue))
		{
			throw new ExpectationFailedException(sprintf('Value cannot exist in array it is not an array (it is a %s)', $value, gettype($lhsValue)));
		}

		if (!in_array($value, $lhsValue))
		{
			if (is_scalar($value))
			{
				$message = sprintf('Value %s not found in array', $value);
			}
			else if (is_null($value))
			{
				$message = 'Value null not found in array';
			}
			else
			{
				$message = 'Value not found in array.';
			}
			throw new ExpectationFailedException($message);
		}

		return $this;
	}
}
