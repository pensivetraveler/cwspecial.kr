<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Articles extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Article', 'Model');

		$this->setProperties($this->Model);

		$this->defaultList = [
			'board_id' => 1,
			'del_yn' => 'N',
		];
	}
}
