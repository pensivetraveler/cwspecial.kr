<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Model_Common.php';

class Model_Student extends Model_Common
{
	public string  $table = 'student';
	public string  $identifier = 'student_id';
	public array   $primaryKeyList = ['student_id','user_id'];
	public array   $uniqueKeyList = ['code'];
	public array   $notNullList = ['code','grade',];
	public array   $nullList = ['disabilities_yn','aac_yn'];
	public array   $strList = ['code','disabilities_yn','aac_yn'];
	public array   $intList = ['grade',];
	public array   $fileList = [];

	public bool    $isAutoincrement = true;

	function __construct()
	{
		parent::__construct();
	}
}
