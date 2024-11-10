<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__.'/Model_Common.php';

class Model_Board extends Model_Common
{
	public string  $table = 'board';
	public string  $identifier = 'board_id';
	public array   $primaryKeyList = ['board_id'];
	public array   $uniqueKeyList = [];
	public array   $notNullList = ['board_name'];
	public array   $nullList = [];
	public array   $strList = ['board_name'];
	public array   $intList = ['board_id'];
	public array   $fileList = [];

	public bool    $isAutoincrement = true;

	function __construct()
	{
		parent::__construct();
	}
}
