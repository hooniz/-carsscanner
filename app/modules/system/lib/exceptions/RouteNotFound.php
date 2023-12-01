<?php

namespace App\Modules\System\Exceptions;

use Exception;
use Throwable;

class RouteNotFound extends Exception implements Interfaces\OutableExceptionInterface
{
	public function __construct($message = "", $code = 0, Throwable $previous = null)
	{
		$this->show($message);
		$this->logWrite($message, $code);
		parent ::__construct($message, $code, $previous);
	}

	public function show(string $message): void
	{
		echo 'Что-то пошло не так но мы скоро починим';
		// TODO: Implement show() method.
	}

	public function logWrite(string $message, int $code): void
	{
		echo 'logging...';
		// TODO: Implement logWrite() method.
	}
}