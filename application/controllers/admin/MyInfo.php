<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class MyInfo extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'MyInfo';
		$this->addJsVars([
			'API_URI' => '/api/users',
		]);
	}

	public function index()
	{
		$tokenData = $this->validateToken();
		$this->edit($tokenData->user_id);
	}
}
