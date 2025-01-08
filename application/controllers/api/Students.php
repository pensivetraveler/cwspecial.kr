<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Students extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Student', 'Model');
		$this->load->model('Model_User', 'Model_Parent');

		$this->setProperties($this->Model);

		$this->defaultList = [
			'user_cd' => 'USR002',
			'del_yn' => 'N',
			'approve_yn' => 'Y',
			'withdraw_yn' => 'N',
		];
	}

	protected function viewAfter($data)
	{
		$data->withdraw_dt = $data->withdraw_yn === 'N'?'':$data->withdraw_dt;
		return parent::viewAfter($data);
	}

	protected function addData($dto, $bool)
	{
		$dtoParent = $this->beforePost(0, $this->Model_Parent);

		if(array_key_exists('withdraw_dt', $dtoParent)) {
			if(!empty($dtoParent['withdraw_dt'])){
				$dtoParent['withdraw_yn'] = 'Y';
			}else{
				$dtoParent['withdraw_dt'] = null;
				$dtoParent['withdraw_yn'] = 'N';
			}
		}

		$dto[$this->Model_Parent->identifier] = $this->Model_Parent->addData($dtoParent, $bool);

		parent::addData($dto, $bool);
	}

	protected function modData($key, $dto, $bool)
	{
		$dtoParent = $this->beforePost($key, $this->Model_Parent);

		if(array_key_exists('withdraw_dt', $dtoParent)) {
			if(!empty($dtoParent['withdraw_dt'])){
				$dtoParent['withdraw_yn'] = 'Y';
			}else{
				$dtoParent['withdraw_dt'] = null;
				$dtoParent['withdraw_yn'] = 'N';
			}
		}

		$this->Model_Parent->modData($dtoParent, [$this->Model_Parent->identifier => $dtoParent[$this->Model_Parent->identifier]], $bool);

		parent::modData($key, $dto, $bool);
	}
}
