<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Dashboard extends Common
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Article');
		$this->load->model('Model_User');

		$this->titleList[] = 'Home';
		$this->href = base_url('/admin/'.$this->router->class);
		$this->viewPath = 'admin/'.$this->router->class;
	}

	public function index()
	{
		$adminList = array_map(function ($curr) {
			return $curr->user_id;
		}, $this->Model_User->getList(['user_id'], [
			'user_cd' => 'USR001'
		]));

		$list = $this->Model_Article->getDashboardArticleList($adminList);

		$data['subPage'] = $this->viewPath.'/index';
		$data['backLink'] = WEB_HISTORY_BACK;
		$data['list'] = $list;

		$this->viewApp($data);
	}
}
