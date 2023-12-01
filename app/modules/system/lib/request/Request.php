<?php

namespace App\Modules\System\Request;

class Request
{
	protected array $post = [];
	protected array $get = [];

	public function __construct()
	{
		foreach ($_POST as $key => $parameter)
		{
			if(is_string($parameter))
			{
				$this->post[$key] = htmlspecialchars($parameter);
			}else
			{
				$this->post[$key] = $parameter;
			}
		}
		foreach ($_GET as $key => $parameter)
		{
			$this->get[$key] = htmlspecialchars($parameter);
		}
	}

	public function getPostParameter(string $key, $default = null)
	{
		return $this->post[$key] ?? $default;
	}

	public function getPostParameters($default = null): array
	{
		return $this->post ?? $default;
	}

	public function getQueryParameter(string $key, $default = null)
	{
		return $this->get[$key] ?? $default;
	}

	public function getQueryParameters($default = null): array
	{
		return $this->get ?? $default;
	}
}