<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Model_Common.php';

class Model_User extends Model_Common
{
	public string  $table = 'user';
	public string  $identifier = 'user_id';
	public array   $primaryKeyList = ['user_id'];
	public array   $uniqueKeyList = ['id'];
	public array   $notNullList = ['user_cd','id','password','name','tel','approve_yn','del_yn','withdraw_yn',];
	public array   $nullList = ['email','withdraw_dt'];
	public array   $strList = ['user_cd','id','password','name','email','tel','approve_yn','del_yn','withdraw_yn','withdraw_dt',];
	public array   $intList = ['user_id',];
	public array   $fileList = [];

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