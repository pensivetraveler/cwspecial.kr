<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class Works extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'Works';
		$this->addJsVars([
			'API_URI' => '/api/articles',
			'API_PARAMS' => [
				'board_id' => 3,
			],
		]);
	}

	public function index()
	{
		if(!$this->isLogin) redirect('/auth');

		$this->list();
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
		$tokenData = $this->validateToken();

		if(property_exists($this, 'Model')) {
			$articleData = $this->Model->getData([], [
				$this->Model->identifier => $key,
				'created_id' => $tokenData->user_id,
			]);
			if(!$articleData) {
				parent::edit(0);
			}
		}

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
