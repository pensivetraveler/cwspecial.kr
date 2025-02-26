<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class MyInfo extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'MyInfo';
		$this->addJsVars([
			'API_URI' => '/api/students',
		]);
	}

	public function index()
	{
		if(!$this->isLogin) redirect('/auth');

		$tokenData = $this->validateToken();
		$this->load->model('Model_Student');
		$student_id = $this->Model_Student->getData(['student_id'], [
			'user_id' => $tokenData->user_id,
		]);
		$this->edit($student_id);
	}
}
