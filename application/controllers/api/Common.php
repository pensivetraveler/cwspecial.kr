<?php defined('BASEPATH') or exit('No direct script access allowed');

class Common extends MY_Builder_API
{
	function __construct()
	{
		parent::__construct();
	}

	protected function auth()
	{

	}

	protected function listBefore($data)
	{
		$data = parent::listBefore($data);

		$extraFields = [];

		if($this->input->get('format') === 'datatable') {
			$extraFields['draw'] = (int)$this->input->get('draw');
			// ��ü ���ڵ� ��
			$extraFields['recordsTotal'] = $this->Model->getCnt(
				$data['where'] ?? [],
				$data['like'] ?? [],
			);
			// �˻����Ͱ� ����� ���ڵ� ��
			if( isset($data['filter']) ) {
				$extraFields['recordsFiltered'] = $this->Model->getCnt(
					$data['where'] ?? [],
					$data['like'] ?? [],
					$data['filter'] ?? [],
				);
			}else{
				$extraFields['recordsFiltered'] = $extraFields['recordsTotal'];
			}

			$limit = (int)$this->input->get('limit')?:10;
			$offset = (int)$this->input->get('pageNo')*$limit;
			$this->db->limit($limit, $offset);
		}

		$data['extraFields'] = $extraFields;

		return $data;
	}

	protected function viewAfter($data)
	{
		$data = parent::viewAfter($data);

		if(property_exists($data, 'created_dt') && !empty($data->created_dt)) {
			$data->recent_dt = $data->created_dt;
			if(property_exists($data, 'updated_dt') && !empty($data->updated_dt)) {
				$data->recent_dt = $data->updated_dt;
			}
		}

		if(property_exists($data, 'created_id') && !empty($data->created_id)) {
			$data->created_id = $this->Model_User->getData([], ['user_id' => $data->created_id])->id;
		}

		if(property_exists($data, 'updated_id') && !empty($data->updated_id)) {
			$data->updated_id = $this->Model_User->getData([], ['user_id' => $data->updated_id])->id;
		}

		return $data;
	}

	public function checkDuplicate_get()
	{
		$dto = $this->input->get();
		if($this->checkDuplicate([$dto['field'] => $dto['value']])){
			$this->response([
				'code' => DATA_ALREADY_EXIST,
				'dto' => $dto,
			]);
		}else{
			$this->response([
				'code' => DATA_AVAILABLE,
				'dto' => $dto,
			]);
		}
	}

	public function options_get()
	{

	}

	public function reorder_patch()
	{
		$new_index = $this->input->get('new_index') ?? null;
		$file_id = $this->input->get('file_id') ?? null;

		if(!$new_index || !$file_id) {
			$this->response([
				'code' => EMPTY_REQUIRED_DATA,
			]);
		}
	}

	public function deleteFile_patch($key = 0)
	{
		$type = $this->input->get('type') ?? null;
		$file_id = $this->patch('file_id') ?? null;
		if(!$type || !$file_id) $this->response(['code' => EMPTY_REQUIRED_DATA]);

		$this->delFileData(['file_id' => $file_id]);

		$this->response([
			'code' => DATA_DELETED,
		]);
	}

	public function deleteRepeater_patch($key = 0)
	{
		$this->response([
			'code' => DATA_DELETED,
		]);
	}

	function isMyData_get($key, $model = null)
	{
		$tokenData = $this->validateToken();

		if(!property_exists($this, 'Model')) {
			if(is_null($model)) {
				$this->response([
					'code' => MODEL_IS_NOT_DEFINED,
				]);
			}
		}else{
			$model = $this->Model;
		}

		$articleData = $model->getData([], [
			$model->identifier => $key,
			'created_id' => $tokenData->user_id,
		]);

		$this->response([
			'code' => $articleData?DATA_PROCESSED:NO_PERMISSION,
		]);
	}
}
