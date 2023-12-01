<?php

use App\Modules\System\Router\Route;

return [
	new Route('example/{id}/{code}', 'Example', 'example', 'GET'),
	new Route('/', 'Main', 'index'),
	new Route('/signup/', 'User', 'signup'),
	new Route('/signin/', 'User', 'login'),
	new Route('/main/', 'Stat', 'getStatistic'),
	new Route('/logout/', 'User', 'logout'),
	new Route('/question', 'Question', 'addQuestion'),
	new Route('/profile', 'Profile', 'getProfile'),
	new Route('/admin', 'Admin', 'start'),
	new Route('/admin/getUserStat', 'Admin', 'getStat', 'GET'),
	new Route('/admin/editProp', 'Admin', 'editProp', 'POST'),
	new Route('/edit/', 'User', 'edit', 'GET'),
	new Route('/admin/addValues', 'Admin', 'addValues', 'POST'),
];