<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class Notices extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'Notices';
		$this->addJsVars([
			'API_URI' => '/api/articles',
			'API_PARAMS' => [
				'board_id' => 1,
			],
		]);
	}

	public function index()
	{
		if(!$this->isLogin) redirect('/auth');

		$this->list();
	}

}
