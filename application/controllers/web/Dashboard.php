<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class Dashboard extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_User', 'Model');
		$this->load->model('Model_Student', 'Model_Child');
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		if(!$user_id) redirect('/auth/login');

		$userData = $this->Model_User->getData([], ['user_id' => $user_id]);
		if(!$userData) {
			$this->session->sess_destroy();
			redirect('/auth/login');
		}

		if($userData->approve_yn === 'Y'){
			$data['subPage'] = 'web/dashboard/index';
			$data['backLink'] = WEB_HISTORY_BACK;

			$this->viewApp($data);
		}else{
			$data['subPage'] = 'web/auth/complete';
			$data['backLink'] = WEB_HISTORY_BACK;

			$this->viewApp($data);
		}
	}
}
