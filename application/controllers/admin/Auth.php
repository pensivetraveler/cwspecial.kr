<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/Common.php';

class Auth extends Common
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
		if($this->session->userdata('user_id') && $this->session->userdata('token')) redirect('admin/dashboard');

		$this->formColumns = $this->setFormColumns('login');
		$this->addJsVars([
			'API_URI' => '/api/auth',
			'API_URI_ADD' => 'login',
			'IDENTIFIER' => $this->setIdentifier(),
			'FORM_DATA' => $this->setFormData(),
			'FORM_REGEXP' => $this->config->item('regexp'),
			'AFTER_LOGIN_URI' => '/admin/dashboard',
		], true);

		$this->addCSS[] = [
			base_url('public/assets/builder/vendor/css/pages/page-auth.css'),
			base_url('public/assets/builder/vendor/libs/@form-validation/form-validation.css'),
			base_url('public/assets/builder/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/vendor/libs/@form-validation/popular.js'),
			base_url('public/assets/builder/vendor/libs/@form-validation/bootstrap5.js'),
			base_url('public/assets/builder/vendor/libs/@form-validation/auto-focus.js'),
			base_url('public/assets/builder/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js'),
		];

		$this->addJS['tail'][] = [
			base_url('public/assets/builder/js/app-page-auth.js'),
		];

		$data['subPage'] = 'admin/auth/login';
		$data['backLink'] = WEB_HISTORY_BACK;
		$data['formData'] = restructure_admin_form_data($this->jsVars['FORM_DATA'], $this->sideForm?'side':'page');

		$this->viewApp($data);
    }

    public function logout()
    {
        if (!$this->session->userdata('user_id')) redirect('admin/auth');

        $this->Model_User_Autologin->delData([
            'user_id' => $this->session->userdata('user_id'),
        ]);

        delete_cookie('autologin');

        $this->session->sess_destroy();
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('token');

        // 세션 쿠키 삭제
        if (isset($_COOKIE[$this->config->item('sess_cookie_name')])) {
            setcookie($this->config->item('sess_cookie_name'), '', time() - 3600, '/');
        }

        redirect('admin/auth');
    }
}
