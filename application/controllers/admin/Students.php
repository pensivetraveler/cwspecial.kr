<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/Common.php';

class Students extends Common
{
	public function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'Users Management';
		$this->href = base_url('/admin/' . $this->router->class);
		$this->viewPath = 'admin/' . $this->router->class;
		$this->sideForm = true;
	}

	protected function setProperties($data = [])
	{
		parent::setProperties([
			'API_URI' => '/api/students',
		]);
	}
}