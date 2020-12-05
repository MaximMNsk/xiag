<?php

namespace application\controllers;


class Controller404 extends Controller
{
	
	function actionIndex()
	{
		$data = [
			'referrer' => (array_key_exists('HTTP_REFERER', $_SERVER)) ? $_SERVER['HTTP_REFERER'] : '',
		];
		$this->view->generate('View404.php', 'ViewTemplate.php', $data);
	}

}
