<?php
namespace Base\Expect;

interface Expectation
{
	/**
	 * Executes the expectation and returns the value if it does not fail.
	 */
	function getValue();
}
