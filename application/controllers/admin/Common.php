<?php defined('BASEPATH') or exit('No direct script access allowed');

class Common extends MY_Controller_ADM
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_User');

		$this->defaultController = 'dashboard';

		$this->auth();
	}
}
