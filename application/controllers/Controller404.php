<?php

namespace application\controllers;


class Controller404 extends Controller
{
	
	function actionIndex()
	{
		$data = [
			'referrer' => $_SERVER['HTTP_REFERER'],
		];
		$this->view->generate('View404.php', 'ViewTemplate.php', $data);
	}

}
