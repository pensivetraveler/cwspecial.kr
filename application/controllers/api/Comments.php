<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Common.php';

class Comments extends Common
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_Comment', 'Model');
		$this->load->model('Model_Message');
		$this->load->model('Model_Article');

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

	protected function afterAddData($dto)
	{
		$article = $this->Model_Article->getData([], [
			'article_id' => $dto['article_id'],
		]);
		if((int)$article->board_id !== 3) return $dto;

		$isAdmin = $this->isAdmin(['user_id' => $this->session->userdata('user_id')]);

		if(!$dto['parent_id']) {
			// 댓글
			if((int)$article->created_id !== (int)$this->session->userdata('user_id')) {
				// 댓글 작성자가, 글 작성자가 아닌 경우
				if($isAdmin) {
					// 관리자가 댓글 단 경우 -> 피드백
					$this->db->group_by('created_id');
					$commentList = $this->Model->getList(['created_id'], [
						'article_id' => 11,
						'depth' => 0,
					]);
					foreach ($commentList as $comment) {
						if((int)$comment->created_id === (int)$this->session->userdata('user_id')) continue;
						if((int)$comment->created_id === (int)$article->created_id) continue;
						$this->Model_Message->addData([
							'user_id' => $comment->created_id,
							'article_id' => $dto['article_id'],
							'comment_id' => $dto['comment_id'],
							'content' => '내가 댓글을 단 게시글에 피드백이달렸어요.',
						]);
					}
					$this->Model_Message->addData([
						'user_id' => $article->created_id,
						'article_id' => $dto['article_id'],
						'comment_id' => $dto['comment_id'],
						'content' => '내 게시글에 피드백이 달렸어요.',
					]);
				}else{
					// 타 사용자가 댓글 단 경우 -> 댓글
					$this->Model_Message->addData([
						'user_id' => $article->created_id,
						'article_id' => $dto['article_id'],
						'comment_id' => $dto['comment_id'],
						'content' => '내 게시글에 새 댓글이 달렸어요.',
					]);
				}
			}
		}else{
			$parentComment = $this->Model->getData([], [
				'article_id' => $dto['article_id'],
				'parent_id' => $dto['parent_id'],
			]);

			// 답글
			if((int)$parentComment->created_id !== (int)$this->session->userdata('user_id')) {
				// 답글 대상 댓글 작성자와 답글 작성자가 서로 다른 경우
				$this->Model_Message->addData([
					'user_id' => $parentComment->created_id,
					'article_id' => $dto['article_id'],
					'comment_id' => $dto['comment_id'],
					'content' => '내 댓글에 새 답글이 달렷어요.',
				]);
			}
		}

		return $dto;
	}
}
