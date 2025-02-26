<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Model_Common.php';

class Model_Article_Prefer extends Model_Common
{
	public string  $table = 'article_prefer';
	public string  $identifier = '';
	public array   $primaryKeyList = ['article_id','user_id'];
	public array   $uniqueKeyList = [];
	public array   $notNullList = ['article_id','user_id','prefer_cd'];
	public array   $nullList = [];
	public array   $strList = ['prefer_cd'];
	public array   $intList = ['article_id','user_id'];
	public array   $fileList = [];

	public bool    $isCreatedDt = true;

	function __construct()
	{
		parent::__construct();
	}
}
