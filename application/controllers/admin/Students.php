<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/Common.php';

class Students extends Common
{
	public function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'Students Management';
		$this->addJsVars([
			'API_URI' => '/api/students',
			'API_PARAMS' => [
			]
		]);
	}
}
