<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Auth extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_User', 'Model');
		$this->load->model('Model_Student', 'Model_Child');

		$this->setConfig = false;

		$this->setProperties($this->Model);

		$this->indexAPI = false;
	}

	public function dupCheck_get()
	{
		$key = $this->input->get('key');
		$value = $this->input->get('value');
		if(!$key || !$value){
			$this->response([
				'code' => EMPTY_REQUIRED_DATA,
				'data' => $this->input->get(),
			]);
		}else{
			$count = $this->Model->getCnt([$key => $value]);
			if($count) {
				$this->response([
					'code' => DATA_ALREADY_EXIST,
				]);
			}else{
				$this->response([
					'code' => DATA_AVAILABLE,
					'msg' => ID_IS_AVAILABLE,
				]);
			}
		}

	}

	public function idCheck_get()
	{
		$id = $this->input->get('id');
		if(!$id){
			$this->response([
				'code' => EMPTY_REQUIRED_DATA,
			]);
		}else{
			$count = $this->Model->getCnt(['id' => $id]);
			if($count) {
				$this->response([
					'code' => ID_ALREADY_EXIST,
				]);
			}else{
				$this->response([
					'code' => DATA_AVAILABLE,
					'msg' => ID_IS_AVAILABLE,
				]);
			}
		}
	}

	public function emailCheck_get()
	{
		$email = $this->input->get('email');
		if(!$email){
			$this->response([
				'code' => EMPTY_REQUIRED_DATA,
			]);
		}else{
			$count = $this->Model->getCnt(['email' => $email]);
			if($count) {
				$this->response([
					'code' => EMAIL_ALREADY_EXIST,
				]);
			}else{
				$this->response([
					'code' => DATA_AVAILABLE,
					'msg' => EMAIL_IS_AVAILABLE,
				]);
			}
		}
	}

	public function login_post()
	{
		$this->validateFormRules('form_login_config');

		$params = [
			'id' => $this->input->post('id'),
			'password' => $this->input->post('password'),
		];

		$count = $this->Model->getCnt(['id' => $params['id']]);
		if(!$count) $this->response(['code' => USER_NOT_EXIST,]);

		$userData = $this->Model->getData([], ['id' => $params['id']]);
		if(!custom_password_verify($userData->password, $params['password'], true)) $this->response(['code' => PASSWORD_IS_NOT_MATCHED, 'data' => []]);

		if ($this->input->post('autologin')) {
			$vericode = array('$', '/', '.');
			$hash = str_replace(
				$vericode,
				'',
				password_hash(random_string('alnum', 10) . element('user_id', (array)$userData) . ctimestamp() . element('id', (array)$userData), PASSWORD_BCRYPT)
			);

			$this->Model_User_Autologin->addData([
				'user_id' => element('user_id', (array)$userData),
				'aul_key' => $hash,
				'aul_ip' => $this->input->ip_address(),
				'aul_datetime' => cdate('Y-m-d H:i:s'),
			]);

			$cookie_name = 'autologin';
			$cookie_value = $hash;
			$cookie_expire = 2592000; // 30일간 저장
			set_cookie($cookie_name, $cookie_value, $cookie_expire);
		}

		$this->session->set_userdata([
			'user_id' => $userData->user_id,
			'token' => $this->setToken([
				'user_id' => $userData->user_id,
				'id' => $userData->id,
				'name' => $userData->name,
				'is_admin' => in_array($userData->user_cd, ['USR000', 'USR001']),
			]),
		]);

		$this->response([
			'code' => DATA_AVAILABLE,
			'data' => [
				'aul_key' => $cookie_value ?? '',
			],
		]);
	}

	public function signup_post()
	{
		$this->validateFormRules('form_signup_config');

		$this->defaultList = [
			'user_id' => '',
			'student_id' => '',
			'approve_yn' => 'N',
			'withdraw_yn' => 'N',
			'del_yn' => 'N',
		];

		$dto = $this->beforePost(0, $this->Model);
		$dtoChild = $this->beforePost(0, $this->Model_Child);
		$dtoChild[$this->Model->identifier] = $this->Model->addData($dto, false);
		$dtoChild[$this->Model_Child->identifier] = $this->Model_Child->addData($dtoChild, false);
		$dto = array_merge($dto, $dtoChild);

		$this->response([
			'code' => DATA_CREATED,
			'data' => [
				$this->Model_Child->identifier => $dto[$this->Model_Child->identifier],
				'redirectTo' => '/auth/complete',
			],
		], RestController::HTTP_CREATED);
	}

	public function findId_post()
	{
		$this->validateFormRules('form_find_id_config');

		$params = [
			'email' => $this->input->post('email'),
			'tel' => $this->input->post('tel'),
		];

		$count = $this->Model->getCnt($params);

		if(!$count) {
			$this->response(['code' => USER_NOT_EXIST,]);
		}else{
			$this->response([
				'code' => DATA_RETRIEVED,
				'data' => [
					'result' => [
						'id' => $this->Model->getData(['id'], $params),
					],
					'redirect_to' => '/admin/auth/login',
				],
			]);
		}
	}

	public function findPassword_post()
	{
		$this->validateFormRules('form_find_id_config');

		$params = [
			'id' => $this->input->post('id'),
			'email' => $this->input->post('email'),
			'tel' => $this->input->post('tel'),
		];

		$count = $this->Model->getCnt($params);

		if(!$count) {
			$this->response(['code' => USER_NOT_EXIST,]);
		}else{
			$password = $this->Model->getData(['password'], $params);
			$password = $this->encryption->decrypt($password);

			$this->response([
				'code' => DATA_RETRIEVED,
				'data' => [
					'result' => [
						'password' => $password,
					],
					'redirect_to' => '/admin/auth/login',
				],
			]);
		}
	}

	public function withdraw_post()
	{
		$tokenData = $this->validateToken();

		$this->Model->modData([
			'withdraw_yn' => 'Y',
			'withdraw_dt' => date('Y-m-d'),
		], [
			'user_id' => $tokenData->user_id,
		]);

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

		$this->response([
			'code' => DATA_PROCESSED,
		]);
	}

	public function passwordCheck_post()
	{
		$tokenData = $this->validateToken();

		$params = [
			'password' => $this->input->post('password'),
		];

		$userData = $this->Model->getData([], [
			'user_id' => $tokenData->user_id,
		]);

		if(!custom_password_verify($userData->password, $params['password'], true)) $this->response(['code' => PASSWORD_IS_NOT_MATCHED, 'data' => []]);

		$this->response([
			'code' => DATA_PROCESSED,
		]);
	}
}
