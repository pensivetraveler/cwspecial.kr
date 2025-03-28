<?php defined('BASEPATH') or exit('No Direct script access allowed');

require_once __DIR__ . '/Common.php';

class MyWorks extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->titleList[] = 'MyWorks';
		$this->addJsVars([
			'API_URI' => '/api/articles',
			'API_PARAMS' => [
				'board_id' => 3,
				'created_id' => $this->session->userdata('user_id'),
			],
		]);
	}

	public function add()
	{
		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.js'),
			base_url('public/assets/builder/vendor/libs/quill/quill.js'),
			base_url('public/assets/builder/js/app-page-article.js'),
		];

		parent::add();
	}

	public function edit($key = 0)
	{
		$this->load->model('Model_Article');
		$articleData = $this->Model_Article->getData([], [
			'article_id' => $key,
			'created_id' => $this->loginData->user_id,
		]);
		if(!$articleData) parent::edit(0);

		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/dropzone/dropzone.js'),
			base_url('public/assets/builder/vendor/libs/quill/quill.js'),
			base_url('public/assets/builder/js/app-page-article.js'),
		];

		parent::edit($key);
	}

	public function view($key = 0)
	{
		$this->load->model('Model_Article');
		$articleData = $this->Model_Article->getData([], [
			'article_id' => $key,
			'created_id' => $this->loginData->user_id,
		]);
		if(!$articleData) parent::view(0);

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/js/app-page-article.js'),
		];

		parent::view($key);
	}
}
