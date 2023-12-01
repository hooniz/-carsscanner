<?php

namespace App\Modules\System\User;

use App\Modules\System\DataBase\Queries\InsertQuery;
use App\Modules\System\DataBase\Queries\SelectQuery;
use App\Modules\System\DataBase\Queries\UpdateQuery;
use App\Modules\System\Request\Request;
use App\Modules\System\Session\Session;
use App\Modules\System\Validator\Rules\Email;
use App\Modules\System\Validator\Rules\Password;
use App\Modules\System\Validator\Rules\Regex;
use App\Modules\System\Validator\Validator;

class User
{

	protected const LOGIN_BY = 'email';

	public function register(Request $request): array
	{
		$userData = array_change_key_case($request->getPostParameters(), CASE_LOWER);

		$errors = [];

		$fields = [
			'email' => $userData['email'],
			'password' => $userData['password'],
			'sensor' => $userData['sensor']
		];

		$rules = [
			'email' => [
				new Email()
			],
			'password' => [
				new Password()
			],
			'sensor' => [
				new Regex('/^[0-9]{3}[A-Z]{3}[0-9]{2}$/')
			]
		];

		$validation = Validator::run($fields, $rules);
		if(in_array(false, $validation))
		{
			foreach ($validation as $validatedField => $validateResult)
			{
				if(!$validateResult)
				{
					$errors[$validatedField] = "Невалидное поле - {$validatedField}";
				}
			}
		}

		if($userData['password'] !== $userData['repeated_password'])
		{
			$errors[] = "Пароли не совпадают";
		}

		$sensor = (new SelectQuery())
			->setTableName('sensors')
			->setSelect(['id'])
			->setWhere([
				'condition' => 'code = :code'
			])
			->setParams([
				'code' => $userData['sensor']
			])->execution();
		$sensorId = $sensor->getResult()['id']??false;
		if(!$sensorId)
		{
			$errors[] = "Датчика с таким идентификатором не существует!";
		}

		if(!$errors)
		{
			$car = (new InsertQuery())
				->setTableName('cars')
				->setFields(['manufacturedYear', 'model', 'engineType', 'fuelType'])
				->setValues([':manufacturedYear', ':model', ':engineType', ':fuelType'])
				->setParams([
					'manufacturedYear' => $userData['year'],
					'model' => $userData['car'],
					'engineType' => $userData['engine_type'],
					'fuelType' => $userData['fuel_type'] ? $userData['fuel_type'] : 92
				])
				->execution();

			$user = (new InsertQuery())
				->setTableName('users')
				->setFields(['email', 'password', 'adEmailingAgreement', 'car', 'sensor'])
				->setValues([':email', ':password', ':adEmailingAgreement', ':car', ':sensor'])
				->setParams([
					'email' => $userData['email'],
					'password' => password_hash($userData['password'], PASSWORD_BCRYPT),
					'adEmailingAgreement' => isset($userData['mailing_agreement'])? (int) $userData['mailing_agreement']:0,
					'car' => $car->getLastInsertedId(),
					'sensor' => $sensorId,
				])
				->execution();

			if(!$user->getError())
			{
				$userId = $user->getLastInsertedId();
				$role = (new InsertQuery())
					->setTableName('roles')
					->setFields(['user'])
					->setValues([':user'])
					->setParams([
						'user' => $userId
					])
					->execution();

				return [];
			}
			$errors[] = "Пользователь с таким Email или таким сенсором уже зарегистрирован!";
		}
		return [
			'errors' => $errors
		];
	}

	public function authorize(Request $request): array
	{
		$userData = array_change_key_case($request->getPostParameters(), CASE_LOWER);

		$errors = [];

		$user = (new SelectQuery())
			->setTableName('users')
			->setSelect(['id', self::LOGIN_BY, 'password'])
			->setWhere([
				'condition' => self::LOGIN_BY . ' = :' . self::LOGIN_BY
			])
			->setParams([
				self::LOGIN_BY => $userData[self::LOGIN_BY]
			])->execution();
		$user = $user->getResult();

		if(!$user)
		{
			$errors[] = "Пользователь с таким email не найден!";
			return [
				'errors' => $errors
			];
		}
		if(!password_verify($userData['password'], $user['password']))
		{
			$errors[] = "Неправильный пароль!";
			return [
				'errors' => $errors
			];
		}
		$sessionUserData = [
			'email' => $user['email'],
			'id' => $user['id']
		];
		Session::set('USER', $sessionUserData);
		$lastLoginUpdate = (new UpdateQuery())
			->setTableName('users')
			->setValues([
				'LastLogin' => ':LastLogin'
			])
			->setWhere([
				'condition' => 'id = :id'
			])
			->setParams([
				'LastLogin' => date('Y-m-d H:i:s'),
				'id' => $user['id']
			])
			->execution();
		if($lastLoginUpdate->getError())
		{
			$errors[] = "Упс... Что-то пошло не так(";
			return [
				'errors' => $errors
			];
		}
		return [];
	}

	public function isAuthorized(): bool
	{
		return !is_null(Session::get('USER'));
	}

	public function getId()
	{
		if($this->isAuthorized())
		{
			return Session::get('USER')['id'];
		}
		return null;
	}
}