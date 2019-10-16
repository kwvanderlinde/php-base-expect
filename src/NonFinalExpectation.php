<?php
namespace Base\Expect;

/**
 * Interface covering all expectations that can be further chained.
 */
abstract class NonFinalExpectation
{
	function toBe($other)
	{
		return new BeExpectation($this, $other);
	}

	function toEqual($other)
	{
		return new EqualExpectation($this, $other);
	}
}
