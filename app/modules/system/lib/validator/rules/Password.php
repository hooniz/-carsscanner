<?php

namespace App\Modules\System\Validator\Rules;

class Password implements RuleInterface
{
	private const PASSWORD_PATTERN = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}+$/u';

	/**
	 * @param string $value
	 * @return bool
	 */
	public function check(string $value): bool
	{
		$passwordRegex = new Regex(self::PASSWORD_PATTERN);
		return $passwordRegex->check($value);
	}
}