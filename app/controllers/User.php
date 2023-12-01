<?php

namespace App\Controllers;

use App\Modules\System\Container\Container;
use App\Modules\System\Controller\ControllerInterface;
use App\Modules\System\DataBase\Queries\SelectQuery;
use App\Modules\System\Request\Request;
use App\Modules\System\Session\Session;
use App\Modules\System\View\View;

class User implements ControllerInterface
{
	public function login()
	{
		$this->redirectIfAuthorized();

		/**
		 * @var $request Request
		 */
		$request = Container::getInstance()->get(Request::class);
		$view = Container::getInstance()->get(View::class);

		$user = [];
		if($request->getPostParameter('email') || $request->getPostParameter('password'))
		{
			$user = Container::getInstance()->get(\App\Modules\System\User\User::class)->authorize($request);
			if(!isset($user['errors']))
			{
				header('Location: /main/');
				die();
			}
		}

		$view->show('signin', [
			'email' => $request->getPostParameter('email'),
			'errors' => $user['errors']??[]
		], true);
	}

	public function signup()
	{
		$this->redirectIfAuthorized();

		/**
		 * @var $request Request
		 */
		$request = Container::getInstance()->get(Request::class);
		$view = Container::getInstance()->get(View::class);
		$user = [];
		if($request->getPostParameter('email') && $request->getPostParameter('password'))
		{
			$user = Container::getInstance()->get(\App\Modules\System\User\User::class)->register($request);
			if(!isset($user['errors']))
			{
				header('Location: /signin/');
				die();
			}
			$user['values'] = $request->getPostParameters();
		}

		$cars = (new SelectQuery())
			->setTableName('models')
			->setSelect(['id', 'country', 'name'])
			->execution();
		$user['cars'] = $cars->getResult();
		$cars = [];
		foreach ($user['cars'] as $car)
		{
			$cars[$car['country']][] = [
				'name' => $car['name'],
				'id' => $car['id']
			];
		}
		$user['cars'] = $cars;
		$view->show('signup', $user, true);
	}

	public function logout()
	{
		if(Session::has('USER'))
		{
			Session::unset('USER');
		}
		header('Location: /');
		die();
	}

	protected function redirectIfAuthorized(): void
	{
		if(Container::getInstance()->get(\App\Modules\System\User\User::class)->isAuthorized())
		{
			header('Location: /main/');
			die();
		}
	}

	public function edit()
	{
		$user = Container::getInstance()->get(\App\Modules\System\User\User::class)->getId();
		if ($user)
		{
			$view = Container::getInstance()->get(View::class);
			$view->show('edit', [
				'user' => Container::getInstance()->get(\App\Modules\System\User\User::class)->getId()
			], true);
		}
	}
}