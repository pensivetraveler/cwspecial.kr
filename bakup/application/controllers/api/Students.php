<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Students extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Student', 'Model');
		$this->load->model('Model_User', 'Model_Parent');
	}
}
