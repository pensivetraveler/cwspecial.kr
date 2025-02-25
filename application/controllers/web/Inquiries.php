<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class Inquiries extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'Inquiries';
		$this->addJsVars([
			'API_URI' => '/api/articles',
			'API_PARAMS' => [
				'board_id' => 2,
				'created_id' => $this->session->userdata('user_id'),
			],
		]);
	}

	public function index()
	{
		if(!$this->isLogin) redirect('/auth');

		if (!$this->session->userdata('user_id')) {
			redirect('/auth');
		} else {
			$this->list();
		}
	}

}
