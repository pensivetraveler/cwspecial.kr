<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common extends MY_Controller_ADM
{
	public string $token;
	public object $userData;
	public string $viewPath;
	public bool $formConfigExist;
	public array $navAuth;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_User');

		$this->navAuth = [];
		$this->defaultController = 'dashboard';

		if($this->router->class !== 'auth') $this->auth();
	}

	protected function auth(): bool
	{
//		if(!$this->session->userdata('user_id')) redirect('admin/auth');
//
//		$this->db
//			->select('admin.*')
//			->join('admin', 'admin.user_id = user.user_id', 'right');
//		$user = $this->Model_User->getData([], ['user_id' => $this->session->userdata('user_id')]);
//		if(!$user) alert('잘못된 전급입니다.', base_url('admin/auth'));
//
//		if($this->session->userdata('token')) {
//			$this->validateToken();
//		}else{
//			$this->session->set_userdata('token', $this->setToken([
//				'user_id' => $user->user_id,
//				'id' => $user->id,
//				'name' => $user->name,
//				'tel' => $user->tel,
//				'through' => 'admin',
//			]));
//		}
//
//		$this->userData = $user;
//
//		$this->headerData = [
//			'id' => $user->id,
//			'user_id' => $user->user_id,
//			'admin_id' => $user->admin_id,
//			'name' => $user->name,
//			'user_cd' => $user->user_cd,
//			'admin_cd' => $user->admin_cd,
//		];
//
//		$this->db
//			->select('menu.*')
//			->join('menu', 'menu.menu_id = admin_auth.menu_id');
//		$this->navAuth = $this->Model_Admin_Auth->getList([], ['admin_id' => $user->admin_id]);
//
		return true;
	}
}
