<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class Works extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'Works Management';
		$this->addJsVars([
			'API_URI' => '/api/articles',
			'API_PARAMS' => [
				'board_id' => 3,
			],
		]);
	}

	public function index()
	{
		if(!$this->session->userdata('user_id')) {
			redirect('/auth');
		}else{
			$this->list();
		}
	}

	public function add()
	{
		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.js'),
			base_url('public/assets/builder/vendor/libs/quill/quill.js'),
			base_url('public/assets/builder/js/forms-file-upload.js'),
		];

		parent::add();
	}

	public function edit($key = 0)
	{
		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.js'),
			base_url('public/assets/builder/vendor/libs/quill/quill.js'),
			base_url('public/assets/builder/js/forms-file-upload.js'),
		];

		parent::edit($key);
	}

	public function view($key = 0)
	{
		parent::view($key);
	}
}
