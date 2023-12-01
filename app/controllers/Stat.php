<?php

namespace App\Controllers;

use App\Modules\CarScanner\Sensor\Sensor;
use App\Modules\System\Container\Container;
use App\Modules\System\Controller\ControllerInterface;
use App\Modules\System\User\User;
use App\Modules\System\View\View;

class Stat implements ControllerInterface
{
	public function getStatistic()
	{
		if(!Container::getInstance()->get(User::class)->isAuthorized())
		{
			header('Location: /');
			die();
		}
		$sensor = new Sensor();
		$userId = Container::getInstance()->get(User::class)->getId();
		$values = $sensor->getSensorStatistic($userId);
		$messages = $sensor->getMessagesByStatistic($values);
		$user = \App\Modules\CarScanner\User\User::getUserById($userId);
		$view = Container::getInstance()->get(View::class);
		$view->show('stat', [
			'values' => $values,
			'messages' => $messages,
			'user' => $user
		], true);
	}
}