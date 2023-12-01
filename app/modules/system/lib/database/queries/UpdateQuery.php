<?php

namespace App\Modules\System\DataBase\Queries;

use Exception;

class UpdateQuery extends Query
{
	protected array $values = [];

	public function setValues(array $values): self
	{
		$this->values = $values;
		return $this;
	}

	protected function generateSql(): self
	{
		$this->sql = "UPDATE {TABLE} SET {VALUES} {WHERE}";
		try {
			$this->replaceTableName();
			$this->replaceValues();
			$this->replaceWhere();
			var_dump($this->sql);
		}catch (Exception $exception)
		{
			echo $exception->getMessage();
			die();
		}
		return $this;
	}

	protected function replaceValues(): self
	{
		$valuesPlaceholder = '{VALUES}';
		foreach($this->values as $field => $value)
		{
			$this->sql = str_replace($valuesPlaceholder, "`{$field}` = {$value} {$valuesPlaceholder}", $this->sql);
		}
		$this->deletePlaceholder($valuesPlaceholder);
		return $this;
	}
}