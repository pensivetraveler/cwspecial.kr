<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Model_Common.php';

class Model_Student extends Model_Common
{
	public string  $table = 'student';
	public string  $identifier = 'student_id';
	public array   $primaryKeyList = ['student_id','user_id'];
	public array   $uniqueKeyList = ['code'];
	public array   $notNullList = ['student_id','code','grade',];
	public array   $nullList = ['disabilities_yn','aac_yn'];
	public array   $strList = ['code','disabilities_yn','aac_yn'];
	public array   $intList = ['grade','student_id','user_id',];
	public array   $fileList = [];

	public bool    $isAutoincrement = true;

	function __construct()
	{
		parent::__construct();
	}

	function getList($select = [], $where = [], $like = [], $limit = [], $orderBy = [], $filter = [])
	{
		$this->db
			->select('user.*')
			->join('user', 'user.user_id=student.user_id', 'left');
		return parent::getList($select, $where, $like, $limit, $orderBy, $filter);
	}

	function getData($select = [], $where = [])
	{
		$this->db
			->select('user.*')
			->join('user', 'user.user_id=student.user_id', 'left');
		return parent::getData($select, $where);
	}

	function getCnt($where = [], $like = [], $filter = [])
	{
		$this->db
			->select('user.*')
			->join('user', 'user.user_id=student.user_id', 'left');
		return parent::getCnt($where, $like, $filter);
	}
}
