<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class ArticlePrefer extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Article_Prefer', 'Model');
		$this->load->model('Model_User');
		$this->load->model('Model_Message');
		$this->load->model('Model_Article');
		$this->load->model('Model_Comment');

		$this->setProperties($this->Model);
	}

	protected function beforeGet()
	{
		$tokenData = $this->validateToken();

		$dto = parent::beforeGet(); // TODO: Change the autogenerated stub

		$dto['where']['user_id'] = $tokenData->user_id;

		return $dto;
	}

	protected function beforePut($key, $model = null)
	{
		$tokenData = $this->validateToken();

		$dto = parent::beforePut($key, $model); // TODO: Change the autogenerated stub

		$dto['user_id'] = $tokenData->user_id;

		return $dto;
	}

	protected function afterPut($key, $dto)
	{
		$articleData = $this->Model_Article->getData([], [
			'article_id' => $dto['article_id'],
		]);

		if((int)$articleData->created_id !== (int)$dto['user_id']) {
			$this->Model_Message->addData([
				'user_id' => $articleData->created_id,
				'article_id' => $dto['article_id'],
				'comment_id' => '',
				'content' => '내 게시글에 피드백이 달렸어요.',
			]);

			$this->db->group_by('created_id');
			$commentList = $this->Model_Comment->getList(['created_id'], [
				'article_id' => 11,
				'depth' => 0,
			]);
			foreach ($commentList as $comment) {
				if((int)$comment->created_id === (int)$dto['user_id']) continue;
				if((int)$comment->created_id === (int)$articleData->created_id) continue;
				$this->Model_Message->addData([
					'user_id' => $comment->created_id,
					'article_id' => $dto['article_id'],
					'comment_id' => '',
					'content' => '내가 댓글을 단 게시글에 피드백이 달렸어요.',
				]);
			}
		}

		parent::afterPut($key, $dto); // TODO: Change the autogenerated stub
	}
}
