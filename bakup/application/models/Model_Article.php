<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Model_Common.php';

class Model_Article extends Model_Common
{
	public string  $table = 'article';
	public string  $identifier = 'article_id';
	public array   $primaryKeyList = ['article_id','board_id'];
	public array   $uniqueKeyList = [];
	public array   $notNullList = ['subject','content','del_yn'];
	public array   $nullList = [];
	public array   $strList = ['subject','content','del_yn'];
	public array   $intList = ['article_id','board_id'];
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
}
