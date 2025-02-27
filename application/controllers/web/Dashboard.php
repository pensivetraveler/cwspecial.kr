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

	public function index()
	{
		if(!$this->isLogin) redirect('/auth');

		$user_id = $this->session->userdata('user_id');
		$userData = $this->Model_User->getData([], ['user_id' => $user_id]);
		if(!$userData) {
			$this->session->sess_destroy();
			redirect('/auth/login');
		}

		if($userData->approve_yn === 'Y'){
			$list = $this->Model_Article->getList([], [
				'board_id' => 3,
			], [], [0, 5], ['created_dt' => 'desc']);

			$data['subPage'] = 'web/dashboard/index';
			$data['backLink'] = WEB_HISTORY_BACK;
			$data['list'] = $list;

			$this->viewApp($data);
		}else{
			$data['subPage'] = 'web/auth/complete';
			$data['backLink'] = WEB_HISTORY_BACK;

			$this->viewApp($data);
		}
	}
}
