<?php
namespace Base\Expect;

class ExpectationFailedException extends \Exception implements \Base\Exceptions\Contingency
{
	public function __construct(string $message, \Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}
}
