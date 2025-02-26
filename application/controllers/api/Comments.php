<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Comments extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Comment', 'Model');

		$this->setProperties($this->Model);

		$this->defaultList = [
			'del_yn' => 'N',
		];
	}

	protected function list($data = [])
	{
		$data = $this->listBefore($data);

		$data['where']['depth'] = 0;

		$list = $this->Model->getList(
			$data['select'] ?? [],
			$data['where'] ?? [],
			$data['like'] ?? [],
			$data['limit'] ?? [],
			$data['order_by'] ?? [],
			$data['filter'] ?? [],
		);

		foreach ($list as $item) {
			$item->creater = $this->Model_User->getData([
				'name', 'id'
			], [
				'user_id' => $item->created_id,
			]);;

			$item->mine_yn = (int)$this->session->userdata('user_id') === (int)$item->created_id;
			$replyList = $this->Model->getList([], [
				'parent_id' => $item->comment_id,
				'depth' => 1,
			], [], [], [
				'created_dt' => 'desc'
			]);
			foreach ($replyList as $reply) {
				$reply->mine_yn = (int)$this->session->userdata('user_id') === (int)$reply->created_id;
				$reply->creater = $this->Model_User->getData([
					'name', 'id'
				], [
					'user_id' => $reply->created_id,
				]);
			}
			$item->reply_list = $replyList;
		}

		$this->response([
			'code' => DATA_RETRIEVED,
			'data' => $this->listAfter($list),
			'extra' => $data['extraFields'] ?? [],
		]);
	}
}
