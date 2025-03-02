<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common extends MY_Builder_WEB
{
	public string $token;
	public object $userData;
	public string $viewPath;
	public bool $formConfigExist;
	public array $navAuth;

	public function __construct()
	{
		$this->flag = 'admin';

		parent::__construct();

		$this->load->model('Model_User');

		$this->navAuth = [];
		$this->defaultController = 'dashboard';

		if($this->router->class !== 'auth') $this->auth();

		$this->addCSS[] = base_url('public/assets/admin/css/style.css');
	}

	protected function auth(): bool
	{
		if(!$this->session->userdata('user_id')) redirect('admin/auth');

		$user = $this->Model_User->getData([], ['user_id' => $this->session->userdata('user_id')]);
		if(!$user || $user->user_cd !== 'USR001') alert('잘못된 전급입니다.', '/');

		if($this->session->userdata('token')) {
			$this->validateToken();
		}else{
			$this->session->set_userdata('token', $this->setToken([
				'user_id' => $user->user_id,
				'id' => $user->id,
				'name' => $user->name,
				'tel' => $user->tel,
				'through' => 'admin',
			]));
		}

		$this->userData = $user;

		$this->headerData = [
			'id' => $user->id,
			'user_id' => $user->user_id,
			'name' => $user->name,
			'user_cd' => $user->user_cd,
		];

		return true;
	}

	public function list()
	{
		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/libs/datatables-bs5/datatables.bootstrap5.css'),
			base_url('public/assets/builder/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css'),
			base_url('public/assets/builder/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css'),
			base_url('public/assets/builder/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/datatables-bs5/datatables-bootstrap5.js'),
		];

		if($this->sideForm) {
			$this->addCSS[] = [
				base_url('public/assets/builder/vendor/libs/tagify/tagify.css'),
				base_url('public/assets/builder/vendor/libs/@form-validation/form-validation.css'),
				base_url('public/assets/builder/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css'),
			];

			// wysiwig
			$this->addCSS[] = [
				base_url('public/assets/builder/vendor/libs/quill/typography.css'),
				base_url('public/assets/builder/vendor/libs/quill/katex.css'),
				base_url('public/assets/builder/vendor/libs/quill/editor.css'),
			];

			$this->addJS['tail'][] = [
				base_url('public/assets/builder/vendor/libs/autosize/autosize.js'),
				base_url('public/assets/builder/vendor/libs/tagify/tagify.js'),
				base_url('public/assets/builder/vendor/libs/@form-validation/popular.js'),
				base_url('public/assets/builder/vendor/libs/@form-validation/bootstrap5.js'),
				base_url('public/assets/builder/vendor/libs/@form-validation/auto-focus.js'),
				base_url('public/assets/builder/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js'),
				base_url('public/assets/builder/vendor/libs/jquery-repeater/jquery-repeater.js'),
				base_url('public/assets/builder/vendor/libs/sortablejs/sortable.js'),
			];

			// wysiwig
			$this->addJS['tail'][] = [
				base_url('public/assets/builder/vendor/libs/quill/katex.js'),
				base_url('public/assets/builder/vendor/libs/quill/quill.js'),
			];
		}

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/js/app-page-list.js'),
		];

		parent::list();
	}

	public function view($key = 0)
	{
		$this->addJS['tail'][] = [
			base_url('public/assets/builder/js/app-page-view.js'),
		];

		parent::view($key);
	}

	public function add()
	{
		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/libs/tagify/tagify.css'),
			base_url('public/assets/builder/vendor/libs/@form-validation/form-validation.css'),
		];

		// wysiwig
		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/libs/quill/typography.css'),
			base_url('public/assets/builder/vendor/libs/quill/katex.css'),
			base_url('public/assets/builder/vendor/libs/quill/editor.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/autosize/autosize.js'),
			base_url('public/assets/builder/vendor/libs/tagify/tagify.js'),
			base_url('public/assets/builder/vendor/libs/@form-validation/popular.js'),
			base_url('public/assets/builder/vendor/libs/@form-validation/bootstrap5.js'),
			base_url('public/assets/builder/vendor/libs/@form-validation/auto-focus.js'),
			base_url('public/assets/builder/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js'),
			base_url('public/assets/builder/vendor/libs/jquery-repeater/jquery-repeater.js'),
			base_url('public/assets/builder/vendor/libs/sortablejs/sortable.js'),
			base_url('public/assets/builder/js/app-page-add.js'),
		];

		// wysiwig
		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/quill/katex.js'),
			base_url('public/assets/builder/vendor/libs/quill/quill.js'),
		];

		parent::add();
	}
}
