<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Auth extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_User', 'Model');

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

		$user = $this->Model->getData([], ['id' => $params['id']]);
		if(!custom_password_verify($user->password, $params['password'], true)) $this->response(['code' => PASSWORD_IS_NOT_MATCHED, 'data' => []]);

		if ($this->input->post('autologin')) {
			$vericode = array('$', '/', '.');
			$hash = str_replace(
				$vericode,
				'',
				password_hash(random_string('alnum', 10) . element('user_id', (array)$user) . ctimestamp() . element('id', (array)$user), PASSWORD_BCRYPT)
			);

			$this->Model_User_Autologin->addData([
				'user_id' => element('user_id', (array)$user),
				'aul_key' => $hash,
				'aul_ip' => $this->input->ip_address(),
				'aul_datetime' => cdate('Y-m-d H:i:s'),
			]);

			$cookie_name = 'autologin';
			$cookie_value = $hash;
			$cookie_expire = 2592000; // 30일간 저장
			set_cookie($cookie_name, $cookie_value, $cookie_expire);
		}

		$this->session->set_userdata('user_id', $user->user_id);

		$this->response([
			'code' => DATA_AVAILABLE,
			'msg' => DATA_PROCESSED,
			'data' => [
				'aul_key' => $cookie_value ?? '',
			],
		]);
	}
}