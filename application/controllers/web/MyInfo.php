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

	public function edit($key = 0)
	{
		$this->load->model('Model_Student');
		$student_id = $this->Model_Student->getData(['student_id'], [
			'user_id' => $this->loginData->user_id,
		]);
		parent::edit($student_id);
	}
}
