<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/Common.php';

class Notices extends Common
{
	public function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'Notices Management';
		$this->addJsVars([
			'API_URI' => '/api/articles',
			'API_PARAMS' => [
				'board_id' => 1,
			]
		]);
	}
}
