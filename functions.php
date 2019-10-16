<?php
declare(strict_types=1);

namespace Base\Expect
{
	function expect($value)
	{
		return new NoExpectation($value);
	}
}
