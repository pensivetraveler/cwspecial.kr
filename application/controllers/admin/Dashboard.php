<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Dashboard extends Common
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Article');

		$this->titleList[] = 'Home';
		$this->href = base_url('/admin/'.$this->router->class);
		$this->viewPath = 'admin/'.$this->router->class;
	}

	public function index()
	{
		$list = $this->Model_Article->getList([], [
			'board_id' => 3,
			'open_yn' => 'Y',
		], [], [0, 5], ['created_dt' => 'desc']);

		$data['subPage'] = $this->viewPath.'/index';
		$data['backLink'] = WEB_HISTORY_BACK;
		$data['list'] = $list;

		$this->viewApp($data);
	}
}
