<?php

namespace App\Controllers;

use App\Modules\System\Container\Container;
use App\Modules\System\Controller\ControllerInterface;
use App\Modules\System\User\User;
use App\Modules\System\View\View;

class Main implements ControllerInterface
{

	public function index()
	{
		$this->redirectIfAuthorized();
		$view = Container::getInstance()->get(View::class);
		$view->show('main', [], true);
	}

	protected function redirectIfAuthorized(): void
	{
		if(Container::getInstance()->get(User::class)->isAuthorized())
		{
			header('Location: /main/');
			die();
		}
	}
}