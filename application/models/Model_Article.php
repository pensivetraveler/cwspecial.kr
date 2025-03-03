<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Model_Common.php';

class Model_Article extends Model_Common
{
	public string  $table = 'article';
	public string  $identifier = 'article_id';
	public array   $primaryKeyList = ['article_id','board_id'];
	public array   $uniqueKeyList = [];
	public array   $notNullList = ['article_id','board_id','subject','content','del_yn','open_yn'];
	public array   $nullList = ['thumbnail','view_count'];
	public array   $strList = ['subject','content','del_yn','open_yn'];
	public array   $intList = ['article_id','board_id','view_count'];
	public array   $fileList = ['thumbnail'];

	public bool    $isAutoincrement = true;
	public bool    $isDelYn = true;
	public bool    $isCreatedDt = true;
	public bool    $isCreatedId = true;
	public bool    $isUpdatedDt = true;

	function __construct()
	{
		parent::__construct();
	}

	public function getDashboardArticleList($adminList)
	{
		if(count($adminList) > 0) {
			$adminList = implode(',', $adminList);
			$this->db->select("(SELECT COUNT(*) FROM tbl_comment WHERE tbl_comment.article_id = tbl_article.article_id AND del_yn = 'N' AND depth = 0 AND tbl_comment.created_id IN ($adminList)) AS feedback_cnt");
			$this->db->having('feedback_cnt', 0);
		}
		return $this->Model_Article->getList([], [
			'board_id' => 3,
			'open_yn' => 'Y',
		], [], [], ['created_dt' => 'desc']);
	}
}
