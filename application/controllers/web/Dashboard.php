<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class Dashboard extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_User', 'Model');
		$this->load->model('Model_Student', 'Model_Child');
		$this->load->model('Model_Article');
	}

	public function view($key = 0)
	{
		$list = $this->Model_Article->getList([], [
			'board_id' => 3,
			'open_yn' => 'Y',
		], [], [5, 0], ['created_dt' => 'desc']);

		$data['subPage'] = 'web/dashboard/index';
		$data['backLink'] = WEB_HISTORY_BACK;
		$data['list'] = $list;

		$this->viewApp($data);
	}
}
